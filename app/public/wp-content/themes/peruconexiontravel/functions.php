<?php
if ( function_exists('register_sidebar') ) {
    register_sidebar( array('name' => 'Box-1', 'before_widget' => '<div class="">', 'after_widget' => '</div>'));
    register_sidebar( array('name' => 'Box-2', 'before_widget' => '<div class="">', 'after_widget' => '</div>'));
    register_sidebar( array('name' => 'Testimonio', 'before_widget' => '<div class="">', 'after_widget' => '</div>'));
/*
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Logo') ) : endif; ?>
*/
}
if(function_exists('register_nav_menu')) {
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
    register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
}
}
// Short code [construccion]
function construccion( $atts, $content = null ) {
   return '<p class="const">En construcción...</p>';
}
add_shortcode('construccion', 'construccion');
add_theme_support( 'post-thumbnails' );

// shortcode video [youtube video="8EeBu0eXYjM"]
function video_youtube( $atts ){
   $video_detalle="";
        extract(shortcode_atts(array(
                'video' => 'No especificado',
       ), $atts));
    $video_detalle = '<iframe width="100%" height="200" src="https://www.youtube.com/embed/'.$video.'" frameborder="0" allowfullscreen></iframe>';
    return $video_detalle;
}
add_shortcode('youtube', 'video_youtube');

// Extracto
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

/*Miniaturas*/
add_image_size('destacada', 388, 304, true);
add_image_size('galeria', 876, 493, true);


/*Llamar extracto en template con:
<?php echo excerpt(25); ?>

/*
Template Name: Full-width layout
Template Post Type: post, page, product
Single Post Template: [Descriptive Template Name]
Description: This part is optional, but helpful for describing the Post Template
*/

/* Oculta actualizaciones en WordPress
function wp_hide_update() {
    remove_action('admin_notices', 'update_nag', 3);
}
add_action('admin_menu','wp_hide_update');

/*Temporalmente en mantenimiento con - http response 503 (Service Temporarily Unavailable) Bloquea la vista de la web a los usuarios no administradores.
function wp_maintenance_mode(){
    if(!current_user_can('edit_themes') || !is_user_logged_in()){
        wp_die('En mantenimiento, disculpe las molestias. Vuelva  a intentarlo más tarde.', 'En mantenimiento, disculpe las molestias. Vuelva  a intentarlo más tarde.'', array('response' => '503'));
    }
}
add_action('get_header', 'wp_maintenance_mode');

/*Permitir PHP en los widgets de texto de WordPress
function php_text($text) {
 if (strpos($text, '<' . '?') !== false) {
 ob_start();
 eval('?' . '>' . $text);
 $text = ob_get_contents();
 ob_end_clean();
 }
 return $text;
}
add_filter('widget_text', 'php_text', 99);

/*Agregar .js escritorio wordpress
function custom_register_admin_scripts() {

wp_register_script( 'custom-javascript', get_template_directory_uri() . '/custom.js' );
wp_enqueue_script( 'custom-javascript' );

}
add_action( 'admin_enqueue_scripts', 'custom_register_admin_scripts' );

/*---
if ( ! is_super_admin() ) {} // diferente a super administrador
if (! current_user_can( 'manage_options' )) {}  // diferente a manage_options  

/*Agregar .css escritorio wordpress
function load_custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

/*Agregar estilo administración wordpress
add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
  echo '<style>
    body, td, textarea, input, select {
      font-family: "Lucida Grande";
      font-size: 12px;
    } 
  </style>';
}

/*Eliminar elementos no deseados del panel
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
 //Right Now - Comments, Posts, Pages at a glance
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
//Recent Comments
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
//Incoming Links
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
//Plugins - Popular, New and Recently updated Wordpress Plugins
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

//Wordpress Development Blog Feed
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
//Other Wordpress News Feed
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
//Quick Press Form
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
//Recent Drafts List
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
}

/*Extracto EDITOR -----------------------------
class TinyMceExcerptCustomization{
	const textdomain = '';
	const custom_exceprt_slug = '_custom-excerpt';
	var $contexts;

	 // Set the feature up
	 // @param array $contexts a list of context where you want the wysiwyg editor in the excerpt field. Defatul array('post','page')
	function __construct($contexts=array('post', 'page')){
		
		$this->contexts = $contexts;
		
		add_action('admin_menu', array($this, 'remove_excerpt_metabox'));
		add_action('add_meta_boxes', array($this, 'add_tinymce_to_excerpt_metabox'));
		add_filter('wp_trim_excerpt',  array($this, 'custom_trim_excerpt'), 10, 2);
		add_action('save_post', array($this, 'save_box'));
	}
	 // Removes the default editor for the excerpt
	function remove_excerpt_metabox(){
		foreach($this->contexts as $context)
			remove_meta_box('postexcerpt', $context, 'normal');
	}
	 // Adds a new excerpt editor with the wysiwyg editor
	function add_tinymce_to_excerpt_metabox(){
		foreach($this->contexts as $context)
		add_meta_box(
			'tinymce-excerpt', 
			__('Excerpt', self::textdomain), 
			array($this, 'tinymce_excerpt_box'), 
			$context, 
			'normal', 
			'high'
		);
	}
	 // Manages the excerpt escaping process
	 // @param string $text the default filtered version
	 // @param string $raw_excerpt the raw version
	function custom_trim_excerpt($text, $raw_excerpt) {
		global $post;
		$custom_excerpt = get_post_meta($post->ID, self::custom_exceprt_slug, true);
		if(empty($custom_excerpt)) return $text;
		return $custom_excerpt;
	}
	 // Prints the markup for the tinymce excerpt box
	 // @param object $post the post object
	function tinymce_excerpt_box($post){
		$content = get_post_meta($post->ID, self::custom_exceprt_slug, true);
		if(empty($content)) $content = '';
		wp_editor(
			$content,
			self::custom_exceprt_slug,
			array(
				'wpautop'		=>	true,
				'media_buttons'	=>	false,
				'textarea_rows'	=>	10,
				'textarea_name'	=>	self::custom_exceprt_slug
			)
		);
	}
	 // Called when the post is beeing saved
	 // @param int $post_id the post id
	function save_box($post_id){
		update_post_meta($post_id, self::custom_exceprt_slug, $_POST[self::custom_exceprt_slug]);
	}
}

global $tinymce_excerpt;
$tinymce_excerpt = new TinyMceExcerptCustomization();

//-------------------------------------------------------------------------------------------------

/*Taxonomias en Entradas
function tax_propias() {
        register_taxonomy('artista', 'post', array('hierarchical' => false, 'label' => 'Artista', 'query_var' => true, 'rewrite' => true));
    }
add_action('init', 'tax_propias', 0);

/*Taxonomias en Páginas
register_taxonomy( 'people', 'page', array( 'hierarchical' => false, 'label' => 'People', 'query_var' => true, 'rewrite' => true ) );
add_action( 'admin_menu', 'my_page_taxonomy_meta_boxes' );
function my_page_taxonomy_meta_boxes() {
    foreach ( get_object_taxonomies( 'page' ) as $tax_name ) {
        if ( !is_taxonomy_hierarchical( $tax_name ) ) {
            $tax = get_taxonomy( $tax_name );
            add_meta_box( "tagsdiv-{$tax_name}", $tax->label, 'post_tags_meta_box', 'page', 'side', 'core' );
        }
    }
}

/*Para crear nuevo Menu
    if (function_exists('register_nav_menu')) {
        register_nav_menu('menu-1', 'Menú Left 1');
        register_nav_menu('menu-2', 'Menú Left 2');
        register_nav_menu('menu-3', 'Menú Left 3');
        register_nav_menu('menu-4', 'Menú Left 4');
        register_nav_menu('menu-5', 'Menú Left 5');
    }

/*Declarar menu en header, page, single, footer, etc.
    <?php wp_nav_menu( array( 'theme_location' => 'menu-1' ) ); ?>
    <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'container_id' => 'menu', 'link_before' => '<span>', 'link_after' => '</span>')); ?>

    PARAMETROS
    'theme_location'  => '',
    'menu'            => '',
    'container'       => 'div',
    'container_class' => '',
    'container_id'    => '',
    'menu_class'      => 'menu',
    'menu_id'         => '',
    'echo'            => true,
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'depth'           => 0,
    'walker'          => ''

/*Añadir un favicon a tu blog
function blog_favicon() {
echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
}
add_action('wp_head', 'blog_favicon');

/*Scripts de Contact Form 7 sólo en las páginas seleccionadas
function add_wpcf7_scripts() {
    if ( is_page('33') )
    wpcf7_enqueue_scripts();
}
if ( ! is_admin() && WPCF7_LOAD_JS )
    remove_action( 'init', 'wpcf7_enqueue_scripts' );
    add_action( 'wp', 'add_wpcf7_scripts' );
    
/*
Crear imagen miniatura determinada
if ( function_exists( 'add_image_size' ) ) {
    add_image_size('directorio', 150, 200, true);
}
function hmuda_image_sizes($sizes) {
    $addsizes = array(
        "directorio" => __( "Directorio institucional"),
    );
    $newsizes = array_merge($sizes, $addsizes);
    return $newsizes;
}
add_filter('image_size_names_choose', 'hmuda_image_sizes');

/*DATOS DE CATEGORIA
<?php echo single_cat_title("", false); ?>
<?php echo category_description(ID); ?>
<?php echo get_cat_name(ID);?>
<?php get_category_link(ID); ?>
remove_filter('term_description','wpautop');
*/

/* Activar Comments -----------------------------
function widget_mytheme_search() {
?>
<li><h2>Search</h2>
<form id="searchform" method="get" action="<?php bloginfo('home'); ?>/"> <input type="text" value="Buscar..." onfocus="if (this.value == 'Buscar...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Buscar...';}" size="18" maxlength="50" name="s" id="s" /> </form> </li>
<?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Search'), 'widget_mytheme_search');
?>
<?php
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$size='32',$default='<path_to_url>' ); ?>

         <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Tu comentario está pendiente de moderación.') ?></em>
         <br />
      <?php endif; ?>

      <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>

      <?php comment_text() ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
     </div>
<?php
        }
/* Eliminar URL del cuadro de comentarios
function remove_comment_fields($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields',remove_comment_fields);

//Llamar a COMMENTS <?php comments_template(); ?> 
*/
?>