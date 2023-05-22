<?php


namespace WPSL\PostsOrder;

use wpdb;

class PostsOrder {

	public $version = '1.5.0';
	/**
	 * @var wpdb
	 */
	private $db;

	private $file;

	/**
	 * @var mixed|null
	 */
	private $post_type;

	/**
	 * @var mixed|null
	 */
	private $term_id;

	/**
	 * @var mixed|null
	 */
	private $taxonomy;

	/**
	 * @var mixed|null
	 */
	private $postmetatype;

	public function __construct( $file ) {
		global $wpdb;
		$this->db   = $wpdb;
		$this->file = $file;

		$this->upgrade();
		$this->init();

		add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
		add_action( 'parse_tax_query', array( $this, 'tax_query' ), 1 );
		if ( ! is_admin() ) {
			add_filter( 'posts_clauses', array( $this, 'global_post_clauses' ), 20 );
			add_filter( 'posts_clauses', array( $this, 'posts_clauses' ), 22, 2 );
		}

		add_filter( 'posts_clauses', array( $this, 'admin_posts_clauses' ), 20, 2 );
		add_filter( 'admin_init', array( $this, 'save_custom_order' ), 20, 2 );

		$this->term_id   = isset( $_REQUEST['term_id'] ) ? (int) $_REQUEST['term_id'] : null;
		$this->taxonomy  = isset( $_REQUEST['taxonomy'] ) ? sanitize_text_field( $_REQUEST['taxonomy'] ) : null;
		$this->post_type = isset( $_REQUEST['post_type'] ) ? sanitize_text_field( $_REQUEST['post_type'] ) : null;

		// Queries
		add_action( 'create_term', array( $this, 'taxonomy_save_meta' ), 10, 2 );
		add_action( 'edit_term', array( $this, 'taxonomy_save_meta' ), 10, 2 );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts_action' ) );
		add_action( 'init', array( $this, 'add_form_fields' ), 9999 );
	}

	/**
	 * Add fields to the taxonomy manage admin page.
	 */
	public function add_form_fields() {
		$taxonomies = get_taxonomies();
		foreach ( $taxonomies as $taxonomy ) {

			// Add fields to taxonomy form
			add_action( "{$taxonomy}_add_form_fields", array( $this, 'taxonomy_add_form_fields' ), 10, 2 );
			add_action( "{$taxonomy}_edit_form_fields", array( $this, 'taxonomy_edit_form_fields' ), 10, 2 );

			// Add columns to taxonomy table lists
			add_filter( "manage_edit-{$taxonomy}_columns", array( $this, 'taxonomy_columns' ) );
			add_action( "manage_{$taxonomy}_custom_column", array( $this, 'taxonomy_custom_fields' ), 20, 3 );

		}
	}

	public function admin_enqueue_scripts_action() {
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'posts_order', plugins_url( '/js/posts_order.js', $this->file ), array( 'jquery-ui-sortable' ), $this->version );
	}

	/**
	 * Upgrade plugin to new version
	 *
	 * @since 1.4
	 */
	private function upgrade() {
		if ( is_admin() ) {
			$posts_order_upgrade = get_option( 'posts_order_upgrade' );
			if ( ! $posts_order_upgrade ) {
				$current_order = $this->db->get_col( "SELECT DISTINCT(meta_key) FROM " . $this->db->postmeta . " WHERE meta_key LIKE 'sort_%'" );
				foreach ( $current_order as $key ) {
					$term_id    = preg_replace( "/[^0-9]/", "", $key );
					$meta_value = array( 'orderby' => 'custom', 'order' => 'asc' );
					$term_meta  = update_term_meta( $term_id, 'term_order', $meta_value );
					$this->db->query( "UPDATE " . $this->db->postmeta . " SET meta_key = '_" . $key . "' WHERE meta_key = '" . $key . "'" );
				}
				add_option( 'posts_order_upgrade', '1' );
			}
		}
	}

	/**
	 * Init some variables
	 *
	 * @param object $query Main query
	 *
	 * @since 1.4
	 *
	 */
	public function init() {
		$orderby = array(
			'default'    => esc_html__( 'Default', 'cps' ),
			'custom'     => esc_html__( 'Custom', 'cps' ),
			'date'       => esc_html__( 'Date', 'cps' ),
			'modified'   => esc_html__( 'Modified', 'cps' ),
			'title'      => esc_html__( 'Title', 'cps' ),
			'id'         => esc_html__( 'ID', 'cps' ),
			'author'     => esc_html__( 'Author', 'cps' ),
			'slug'       => esc_html__( 'Slug', 'cps' ),
			'menu_order' => esc_html__( 'Menu Order', 'cps' ),
			'postmeta'   => esc_html__( 'Custom Field', 'cps' )
		);
		// apply filters to add new order fields
		$this->orderby = apply_filters( 'posts_order_orderby', $orderby );

		$this->order = array(
			'desc' => esc_html__( 'Descending', 'cps' ),
			'asc'  => esc_html__( 'Ascending', 'cps' )
		);

		$postmetatype = array(
			'CHAR'     => esc_html__( 'Char', 'cps' ),
			'DATE'     => esc_html__( 'Date', 'cps' ),
			'DATETIME' => esc_html__( 'Datetime', 'cps' ),
			'SIGNED'   => esc_html__( 'Integer', 'cps' )
		);
		// apply filters to add type of meta_key for cast argument
		$this->postmetatype = apply_filters( 'posts_order_meta', (array) $postmetatype );

		$this->options = get_option( 'posts_order' );
	}

	/**
	 * Filter to stop including category child posts
	 *
	 * @param object $query Main query
	 *
	 * @since 1.4
	 *
	 */
	public function tax_query( $query ) {
		if ( isset( $query->tax_query->queries[0]['include_children'] ) && ( $query->is_category() || $query->is_tax() ) ) {
			$query->tax_query->queries[0]['include_children'] = false;
		}
	}

	public function get_order( $index = '' ) {
		switch ( $index ) {
			case 'date':
				$order_by = 'post_date';
				break;
			case 'modified':
				$order_by = 'post_modified';
				break;
			case 'title':
				$order_by = 'post_title';
				break;
			case 'id':
				$order_by = 'ID';
				break;
			case 'author':
				$order_by = 'post_author';
				break;
			case 'slug':
				$order_by = 'post_name';
				break;
			case 'menu_order':
				$order_by = 'menu_order';
				break;
			default:
				$order_by = 'post_date';
				$order    = 'DESC';
				break;
		}

		return $order_by;
	}

	public function global_post_clauses( $clauses ) {

		$homepage_orderby = $this->get_order( $this->oval( 'homepage_orderby', 'default' ) );
		$homepage_order   = $this->oval( 'homepage_order', 'desc' );

		$categories_orderby = $this->get_order( $this->oval( 'categories_orderby', 'default' ) );
		$categories_order   = $this->oval( 'categories_order', 'desc' );

		if ( $homepage_orderby != 'default' && is_home() ) {
			$clauses['orderby'] = $this->db->posts . '.' . $homepage_orderby . ' ' . $homepage_order;

			return $clauses;
		}

		if ( $categories_orderby != 'default' && is_category() ) {
			$clauses['orderby'] = $this->db->posts . '.' . $categories_orderby . ' ' . $categories_order;

			return $clauses;
		}

		return $clauses;
	}

	/**
	 * Add clauses to frontend wp_queries
	 *
	 * @param array $clauses List of wp_query clauses
	 *
	 * @return array
	 * @since 1.4
	 *
	 */
	public function posts_clauses( $clauses, $query ) {
		if ( ! $query->is_main_query() && ! $query->is_tax() ) {
			return $clauses;
		}
		// Get current term
		$term = $query->get_queried_object();
		// Return cluases if term meta not exists
		if ( ! isset( $term->term_id ) ) {
			return $clauses;
		}

		// Get term meta
		$term_meta = array_merge( array(
			'orderby'      => 'default',
			'order'        => 'desc',
			'postmeta'     => null,
			'postmetatype' => null
		), (array) get_term_meta( $term->term_id, 'term_order', true ) );
		extract( $term_meta );

		// Return clauses if the sorting is set as the default
		if ( $orderby == 'default' ) {
			return $clauses;
		}
		// Check whether the returned value is in the array
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'desc';
		}

		$field = $this->get_order( $orderby );

		if ( $term->term_id ) {
			if ( $orderby != 'custom' && $orderby != 'postmeta' ) {
				$clauses['orderby'] = $this->db->posts . '.' . $field . ' ' . $order;

				return $clauses;
			} else {
				$as = 'SIGNED';
				if ( $orderby == 'custom' ) {
					$meta_key = '_sort_' . $term->term_id;
					$as       = 'SIGNED';
				}
				if ( $orderby == 'postmeta' ) {
					$meta_key = $postmeta;
					$orderby  = 'sort.meta_value';
					$as       = $postmetatype;
					if ( ! $postmeta ) {
						return $clauses;
					}
				}
				$clauses['join']    .= " LEFT JOIN " . $this->db->postmeta . " sort ON (" . $this->db->posts . ".ID = sort.post_id AND sort.meta_key = '{$meta_key}')";
				$clauses['where']   .= " AND ( sort.meta_key = '{$meta_key}' OR sort.post_id IS NULL )";
				$clauses['orderby'] = " CAST( sort.meta_value AS $as ), " . $this->db->posts . ".post_date DESC";

				return $clauses;
			}
		}

		return $clauses;
	}

	protected function oval( $index, $value = null ) {
		if ( isset( $this->options[ $index ] ) ) {
			return $this->options[ $index ];
		}

		return $value;
	}

	/**
	 * Add clauses to admin wp_query
	 *
	 * @param array $clauses List of wp_query clauses
	 *
	 * @return array
	 * @since 1.4
	 *
	 */
	public function admin_posts_clauses( $clauses, $query ): array {
		if ( ! $this->term_id || ! $this->taxonomy ) {
			return $clauses;
		}
		$clauses['join']    .= "LEFT JOIN " . $this->db->postmeta . " sort ON (" . $this->db->posts . ".ID = sort.post_id AND sort.meta_key = '_sort_" . $this->term_id . "')";
		$clauses['where']   .= "AND ( sort.meta_key = '_sort_" . $this->term_id . "' OR sort.post_id IS NULL )";
		$clauses['orderby'] = "CAST(sort.meta_value AS SIGNED), " . $this->db->posts . ".post_date DESC";

		return $clauses;
	}

	/**
	 *  Add hidden admin menu page
	 *
	 * @since 1.4
	 */
	public function admin_menu() {
		add_submenu_page(
			null,
			esc_html__( 'Order posts', 'post-sorter' ),
			esc_html__( 'Order posts', 'post-sorter' ),
			'edit_posts', 'sort-page',
			array( $this, 'admin_page' ),
			0
		);
	}

	/**
	 * Save custom order results
	 *
	 * @since 1.4
	 *
	 * @redirect
	 */
	public function save_custom_order() {
		if ( ! isset( $_POST['submit'] ) && ! isset( $_POST['remove'] ) ) {
			return;
		}
		if ( isset( $_POST['sort'] ) && is_array( $_POST['sort'] ) && check_admin_referer( 'save_sort', 'category_custom_post_order' ) ) {

			foreach ( $_POST['sort'] as $order => $post_id ) {
				$meta_key = '_sort_' . $this->term_id;
				if ( isset( $_POST['submit'] ) ) {
					update_post_meta( $post_id, $meta_key, (int) $order );
				}
				if ( isset( $_POST['remove'] ) ) {
					delete_post_meta( (int) $post_id, $meta_key );
				}
			}

			$url = 'edit.php?page=sort-page&taxonomy=' . $this->taxonomy . '&term_id=' . $this->term_id . '&post_type=' . $this->post_type;
			wp_safe_redirect( admin_url( $url ) );
			exit();
		}
	}

	/**
	 * Insert row to taxonomy edit table.
	 *
	 * @param object $term Term object
	 *
	 * @return null
	 * @since 1.4
	 *
	 */
	public function admin_page() {
		$term      = get_term_by( 'id', $this->term_id, $this->taxonomy );
		$term_link = get_term_link( $term );
		if ( ! isset( $term->name ) || ! $this->post_type ) {
			return;
		}

		$args  = array(
			'tax_query'      => array(
				'relation' => 'AND',
				array(
					'taxonomy' => $term->taxonomy,
					'field'    => 'term_id',
					'terms'    => $term->term_id,
				)
			),
			'posts_per_page' => - 1,
			'post_type'      => $this->post_type,
		);
		$query = new \WP_Query( $args );
		?>
        <div class="wrap"><h2><?php esc_html_e( 'Order posts', 'cps' ); ?></h2>
            <form method="post">
				<?php wp_nonce_field( 'save_sort', 'category_custom_post_order' ); ?>
                <h3>
					<?php esc_html_e( 'Category:', 'cps' ); ?> <a href="<?php echo esc_url( $term_link ); ?>" target="_blank"><?php echo esc_html( $term->name ); ?></a>
                </h3>
                <ul id="tpo-the-list" style="border: 1px solid #DDD; margin: 0;">
					<?php if ( $query->have_posts() ): $i = 0; ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<?php $order = get_post_meta( get_the_ID(), '_sort_' . $term->term_id, true ); ?>
							<?php if ( $order === '' ) {
								$order = $i;
							} ?>
                            <li style="margin: 0; background: #FFF; padding: 8px 8px; border-bottom: 1px solid #EEE; cursor:move;">
                                <input type="hidden" name="sort[]" value="<?php the_ID(); ?>"/>[<?php echo esc_html( $order ); ?>] <?php the_title(); ?>
                                [<?php echo get_the_date( "Y-m-d" ); ?>] (<?php echo get_post_status(); ?>)
                            </li>
							<?php $i ++; endwhile; ?>

					<?php else: ?>
                        <li><?php esc_html_e( 'No posts', 'cps' ); ?></li>
					<?php endif; ?>
                </ul>
                <p class="submit" style="margin-top: 0;">
                    <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_attr_e( 'Save', 'cps' ); ?>"/>
					<?php if ( $order ): ?>
                        <input type="submit" name="remove" id="submit" class="button button-secondary" value="<?php esc_attr_e( 'Reset order', 'cps' ); ?>"/>
					<?php endif; ?>
                    <input type="button" name="reverse" id="reverse" class="reverse button button-secondary" value="<?php esc_attr_e( 'Reverse', 'cps' ); ?>"/>
                </p>
            </form>
        </div>
		<?php
	}

	/**
	 * Filter the number of custom fields to retrieve for the drop-down
	 * in the Custom Fields meta box.
	 *
	 * @param int $limit Number of custom fields to retrieve. Default 30.
	 *
	 * @since 2.1.0
	 *
	 */
	public function get_meta_keys() {
		$sql  = "SELECT DISTINCT meta_key
			FROM " . $this->db->postmeta . "
			WHERE meta_key NOT BETWEEN '_' AND '_z'
			HAVING meta_key NOT LIKE %s
			ORDER BY meta_key
			LIMIT %d";
		$keys = $this->db->get_col( $this->db->prepare( $sql, $this->db->esc_like( '_' ) . '%', 30 ) );
		if ( $keys ) {
			natcasesort( $keys );
		}

		return $keys;
	}

	/**
	 * Insert row to taxonomy add form.
	 *
	 * @return null
	 * @since 1.4
	 *
	 */
	public function taxonomy_add_form_fields() {
		?>
        <div class="form-field">
            <label for="orderby"><?php esc_html_e( 'Order by', 'cps' ); ?></label>
            <select id="tpo_orderby" name="term_meta[orderby]">
				<?php foreach ( $this->orderby as $key => $val ): ?>
                    <option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $val ); ?></option>
				<?php endforeach; ?>
            </select>

            <select class="hidden" id="tpo_order" name="term_meta[order]">
				<?php foreach ( $this->order as $key => $val ): ?>
                    <option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $val ); ?></option>
				<?php endforeach; ?>
            </select>

            <p class="hidden" id="tpo_meta_value">
				<?php $keys = $this->get_meta_keys(); ?>
				<?php if ( $keys ) { ?>
                    <label for="tpo_post_meta_key"><?php echo esc_html( $this->orderby['postmeta'] ); ?></label>
                    <select id="tpo_post_meta_key" name="term_meta[postmeta]">
                        <option value=""><?php esc_html_e( '&mdash; Select &mdash;' ); ?></option>
						<?php
						foreach ( $keys as $key ) {
							if ( is_protected_meta( $key, 'post' ) ) {
								continue;
							}
							echo "\n<option value='" . esc_attr( $key ) . "'>" . esc_html( $key ) . "</option>";
						}
						?>
                    </select>
				<?php } ?>
                <label for="tpo_post_meta_key_type"><?php esc_html_e( 'Type', 'cps' ); ?></label>
                <select id="tpo_post_meta_key_type" name="term_meta[postmetatype]">
					<?php foreach ( $this->postmetatype as $key => $val ): ?>
                        <option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $val ); ?></option>
					<?php endforeach; ?>
                </select>
            </p>
            <p class="description"><?php esc_html_e( 'Select order field', 'cps' ); ?></p>
        </div>
		<?php
	}

	/**
	 * Insert row to taxonomy edit table.
	 *
	 * @param object $term Term object
	 *
	 * @return null
	 * @since 1.4
	 *
	 */
	public function taxonomy_edit_form_fields( $term ) {

		$term_meta = array_merge( array(
			'orderby'      => 'default',
			'order'        => 'desc',
			'postmeta'     => '',
			'postmetatype' => ''
		), (array) get_term_meta( $term->term_id, 'term_order', true ) );
		?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="orderby"><?php esc_html_e( 'Order by', 'cps' ); ?></label></th>
            <td>
                <select id="tpo_orderby" name="term_meta[orderby]">
					<?php foreach ( $this->orderby as $key => $val ): ?>
                        <option <?php echo selected( $term_meta['orderby'], $key ); ?> value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $val ); ?></option>
					<?php endforeach; ?>
                </select>

                <select <?php echo ( $term_meta['orderby'] == 'custom' || $term_meta['orderby'] == 'default' ) ? 'class="hidden"' : ''; ?>
                        id="tpo_order" name="term_meta[order]">
					<?php foreach ( $this->order as $key => $val ): ?>
                        <option <?php selected( $term_meta['order'], $key ); ?> value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $val ); ?></option>
					<?php endforeach; ?>
                </select>

                <p <?php echo $term_meta['orderby'] != 'postmeta' ? 'class="hidden"' : ''; ?> id="tpo_meta_value">
					<?php $keys = $this->get_meta_keys(); ?>
					<?php if ( $keys ) { ?>
                        <label for="tpo_post_meta_key"><?php echo esc_html( $this->orderby['postmeta'] ); ?></label>
                        <select id="tpo_post_meta_key" name="term_meta[postmeta]">
                            <option value=""><?php esc_html_e( '&mdash; Select &mdash;' ); ?></option>
							<?php
							foreach ( $keys as $key ) {
								if ( is_protected_meta( $key, 'post' ) ) {
									continue;
								}
								echo "\n<option value='" . esc_attr( $key ) . "' " . selected( $term_meta['postmeta'], $key ) . ">" . esc_html( $key ) . "</option>";
							}
							?>
                        </select>

                        <label for="tpo_post_meta_key_type"><?php esc_html_e( 'Type', 'cps' ); ?></label>
                        <select id="tpo_post_meta_key_type" name="term_meta[postmetatype]">
							<?php foreach ( $this->postmetatype as $key => $val ): ?>
                                <option <?php selected( $term_meta['postmetatype'], $key ); ?> value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $val ); ?></option>
							<?php endforeach; ?>
                        </select>
					<?php } ?>
                </p>
                <p class="description"><?php esc_html_e( 'Select order field', 'cps' ); ?></p>
            </td>
        </tr>
		<?php
	}

	/**
	 * Save taxonomy term meta
	 *
	 * @param int $term_id The term ID
	 *
	 * @return bool
	 * @since 1.4
	 *
	 */
	public function taxonomy_save_meta( $term_id ) {
		$term_meta    = wp_unslash( $_POST['term_meta'] );
		$orderby      = isset( $term_meta['orderby'] ) ? sanitize_text_field( $term_meta['orderby'] ) : null;
		$order        = isset( $term_meta['order'] ) ? sanitize_text_field( $term_meta['order'] ) : null;
		$postmeta     = isset( $term_meta['postmeta'] ) ? sanitize_text_field( $term_meta['postmeta'] ) : null;
		$postmetatype = isset( $term_meta['postmetatype'] ) ? sanitize_text_field( $term_meta['postmetatype'] ) : null;

		if ( $orderby == 'default' ) {
			delete_term_meta( $term_id, 'term_order' );
		} elseif ( isset( $this->orderby[ $orderby ] ) && isset( $this->order[ $order ] ) ) {
			$meta_value = array(
				'orderby'      => $orderby,
				'order'        => $order,
				'postmeta'     => $postmeta,
				'postmetatype' => $postmetatype
			);
			update_term_meta( $term_id, 'term_order', $meta_value );
		}
	}

	/**
	 * Retrieve single bookmark data item or field.
	 *
	 * @param array $columns The list of taxonomy columns to return
	 *
	 * @return array
	 * @since 1.4
	 *
	 */
	public function taxonomy_columns( $columns ) {
		$columns['cat_order'] = esc_html__( 'Order', 'cps' );

		return $columns;
	}

	/**
	 * Add value to taxonomy Order column.
	 *
	 * @return bool
	 * @since 1.4
	 */
	public function taxonomy_custom_fields( $null, $column_name, $term_id ) {
		global $post_type, $taxonomy;
		if ( $column_name == 'cat_order' ) {
			if ( ! isset( $term_id ) || ! isset( $taxonomy ) ) {
				return '';
			}
			$term_order = get_term_meta( $term_id, 'term_order', true );

			if ( isset( $term_order['orderby'] ) && isset( $term_order['order'] ) ) {

				if ( $term_order['orderby'] == 'custom' ) {
					echo esc_html( $this->orderby[ $term_order['orderby'] ] );
					echo '<p><a href="' . admin_url( 'edit.php?page=sort-page&taxonomy=' . esc_attr( $taxonomy ) . '&term_id=' . esc_attr( $term_id ) . '&post_type=' . $post_type ) . '">' . esc_html__( 'Order posts', 'cps' ) . '</a></p>';
				} elseif ( isset( $this->orderby[ $term_order['orderby'] ] ) ) {
					echo esc_html( $this->orderby[ $term_order['orderby'] ] ) . ' ' . esc_html( $this->order[ $term_order['order'] ] );
				}
			} else {
				echo esc_html__( 'Default', 'cps' );
			}
		}
	}

}