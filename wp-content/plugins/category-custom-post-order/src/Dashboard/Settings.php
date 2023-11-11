<?php

namespace WPSL\PostsOrder\Dashboard;

class Settings {
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );

		// Define fields for orderby clause
		$this->orderby = apply_filters(
			'post_order',
			array(
				'default'    => esc_html__( 'Default', 'cps' ),
				'date'       => esc_html__( 'Date', 'cps' ),
				'modified'   => esc_html__( 'Modified', 'cps' ),
				'title'      => esc_html__( 'Title', 'cps' ),
				'id'         => esc_html__( 'ID', 'cps' ),
				'author'     => esc_html__( 'Author', 'cps' ),
				'slug'       => esc_html__( 'Slug', 'cps' ),
				'menu_order' => esc_html__( 'Menu order', 'cps' )
			)
		);

		// Define order
		$this->order = array(
			'desc' => esc_html__( 'Descending', 'cps' ),
			'asc'  => esc_html__( 'Ascending', 'cps' )
		);

		// Get plugin options
		$this->options = get_option( 'posts_order' );

		// Get list of register taxonomies
		$this->taxonomies = get_taxonomies();
	}

	/**
	 * Add options page
	 */
	public function add_plugin_page() {
		// This page will be under "Settings"
		add_options_page(
			esc_html__( 'Posts Order', 'ceutext' ),
			esc_html__( 'Posts order', 'ceutext' ),
			'manage_options',
			'posts-order-settings',
			array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page() {
		?>
        <div class="wrap">
            <h2><?php esc_html_e( 'Posts Order', 'cps' ); ?></h2>
            <form method="post" action="options.php">
				<?php
				// This prints out all hidden setting fields
				settings_fields( 'posts_order_option_group' );
				do_settings_sections( 'posts-order-general' );
				submit_button();
				?>
            </form>
        </div>
		<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init() {
		register_setting(
			'posts_order_option_group', // Option group
			'posts_order', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'setting_section_id', // ID
			esc_html__( 'General settings', 'cps' ), // Title
			array( $this, 'print_section_info' ), // Callback
			'posts-order-general' // Page
		);

		add_settings_field(
			'homepage',
			esc_html__( 'Homepage', 'cps' ),
			array( $this, 'field_callback' ),
			'posts-order-general',
			'setting_section_id',
			array( 'name' => 'homepage' )
		);

		add_settings_field(
			'categories',
			esc_html__( 'Categories', 'cps' ),
			array( $this, 'field_callback' ),
			'posts-order-general',
			'setting_section_id',
			array( 'name' => 'categories' )
		);

		add_settings_field(
			'taxonomies',
			esc_html__( 'Supported taxonomies', 'cps' ),
			array( $this, 'taxonomies_callback' ),
			'posts-order-general',
			'setting_section_id'
		);

	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input ) {
		$new_input = array();

		if ( isset( $input['homepage_orderby'] ) ) {
			$new_input['homepage_orderby'] = sanitize_key( $input['homepage_orderby'] );
		}

		if ( isset( $input['homepage_order'] ) ) {
			$new_input['homepage_order'] = sanitize_key( $input['homepage_order'] );
		}

		if ( isset( $input['categories_orderby'] ) ) {
			$new_input['categories_orderby'] = sanitize_key( $input['categories_orderby'] );
		}

		if ( isset( $input['categories_order'] ) ) {
			$new_input['categories_order'] = sanitize_key( $input['categories_order'] );
		}

		return $new_input;
	}

	/**
	 * Check if the option exist and return value
	 */
	protected function oval( $index, $value = null ) {
		return isset( $this->options[ $index ] ) ? $this->options[ $index ] : $value;
	}

	/**
	 * Print the Section text
	 */
	public function print_section_info() {
		esc_html_e( 'Select global order for those section', 'cps' );
	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function taxonomies_callback( $args ) {
		foreach ( $this->taxonomies as $slug ) {
			$taxonomy = get_taxonomy( $slug );
			if ( isset( $taxonomy->labels->name ) ) {
				$taxname = $taxonomy->labels->name;
			} else {
				$taxname = $slug;
			}
			echo "{$taxname} [{$slug}] <br/>";
		}
	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function field_callback( $args ) {
		if ( ! isset( $args['name'] ) ) {
			return '';
		}
		echo $this->order_select( $args['name'] );
	}

	/**
	 * Return select field for callback function
	 */
	public function order_select( $index, $selected = '' ) {

		$orderby = $this->oval( $index . '_orderby' );
		$order   = $this->oval( $index . '_order' );

		$output = '<select id="' . $index . '" name="posts_order[' . $index . '_orderby]">';
		foreach ( $this->orderby as $id => $name ) {
			$output .= '<option value="' . $id . '" ' . selected( $id, $orderby, false ) . '>' . $name . '</option>';
		}
		$output .= '<select>';
		$output .= '<select id="' . $index . '" name="posts_order[' . $index . '_order]">';
		foreach ( $this->order as $id => $name ) {
			$output .= '<option value="' . $id . '" ' . selected( $id, $order, false ) . '>' . $name . '</option>';
		}
		$output .= '<select>';

		return $output;
	}

}

