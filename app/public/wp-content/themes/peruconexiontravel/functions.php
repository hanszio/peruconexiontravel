<?php
if (function_exists('register_sidebar')) {
    register_sidebar(array('name' => 'Box-1', 'before_widget' => '<div class="">', 'after_widget' => '</div>'));
    register_sidebar(array('name' => 'Box-2', 'before_widget' => '<div class="">', 'after_widget' => '</div>'));
    register_sidebar(array('name' => 'Testimonio', 'before_widget' => '<div class="">', 'after_widget' => '</div>'));
    /*
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Logo') ) : endif; ?>
*/
}
if (function_exists('register_nav_menu')) {
    add_action('init', 'register_my_menu');
    function register_my_menu()
    {
        register_nav_menu('primary-menu', __('Primary Menu'));
    }
}
// Short code [construccion]
function construccion($atts, $content = null)
{
    return '<p class="const">En construcción...</p>';
}
add_shortcode('construccion', 'construccion');
add_theme_support('post-thumbnails');

// shortcode video [youtube video="8EeBu0eXYjM"]
function video_youtube($atts)
{
    $video_detalle = "";
    extract(shortcode_atts(array(
        'video' => 'No especificado',
    ), $atts));
    $video_detalle = '<iframe width="100%" height="200" src="https://www.youtube.com/embed/' . $video . '" frameborder="0" allowfullscreen></iframe>';
    return $video_detalle;
}
add_shortcode('youtube', 'video_youtube');

// Extracto
function excerpt($limit)
{
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
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

// Funcion que Evita que CF7 ponga etiquetas p automaticamente
add_filter('wpcf7_autop_or_not', '__return_false');
//
?>