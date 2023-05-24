<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link type="text/css" rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/carousel/owl.carousel.css" />
  <?php wp_head(); ?>
  <meta name="facebook-domain-verification" content="l1gylwyln75vyrywhew891cwkz32hg" />
  <!-- Meta Pixel Code -->
  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1407031690086014');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1407031690086014&ev=PageView&noscript=1" /></noscript>
  <!-- End Meta Pixel Code -->
</head>

<body>
  <div class="content">
    <header class="clear <?php if (!is_page(2)) {
                            echo 'internal__header';
                          } ?>">
      <div class="boxDatosReci">
        <div class="container"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Box-1')) : endif; ?></div>
      </div>
      <div class="boxHader">
        <div class="container">
          <div class="boxHaderLogo"><a href="/"> <img src="<?php bloginfo('template_directory'); ?>/images/peru-conexion-travel-horizontal.svg" alt=""> </a></div>
          <div class="boxHaderMenu">
            <nav id="menu" class="clear"> <?php if (function_exists('wp_nav_menu')) {
                                            wp_nav_menu(array('container_class' => 'menu-header', 'theme_location' => 'primary-menu', 'depth' => '4', 'show_home' => 'true'));
                                          } else { ?> <ul>
                  <li class="<?php if (is_home()) { ?>current_page_item<?php } else { ?>page_item<?php } ?>"><a href="<?php bloginfo('url'); ?>" title="Home">Home</a></li> <?php wp_list_pages('title_li=&sort_column=menu_order&depth=4');   ?>
                </ul> <?php } ?> </nav>
          </div>
        </div>
      </div>
    </header>
    <?php if (is_page(2) == true) { ?><div class="banner">
        <div class="bannerTop"><?php echo do_shortcode('[transitionslider id="1"]'); ?></div>
        <div class="bannerimg">
          <?php
          $images = get_field('iconos_reconocimiento');
          if ($images) : ?>
            <?php foreach ($images as $image) : ?>
              <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <?php include(TEMPLATEPATH . "/carrousel.php"); ?>
      </div><?php } ?>