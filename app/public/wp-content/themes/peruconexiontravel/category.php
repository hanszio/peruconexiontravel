<?php get_header(); ?>
<?php if (ICL_LANGUAGE_CODE == 'es') : $desde = "Desde ";
  $readmore = "Ver Mas";
  $blog = "VER MAS";
  $HalfDay = "Medio día";
  $FullDay = "Full Day";
  $DDias = " Días";
  $DNoches = " Noches";
endif; ?>
<?php if (ICL_LANGUAGE_CODE == 'en') : $desde = "From ";
  $readmore = "View More";
  $blog = "Read more about the article";
  $HalfDay = "Medio día";
  $FullDay = "Full Day";
  $DDias = " Días";
  $DNoches = " Noches";
endif; ?>

<section class="content categoria clear">
  <?php if (have_posts()) : ?>
    <div class="imgTitleCat reset">
      <?php $post = $posts[0]; // Truco. Conjunto $post para que the_date() funcione. 
      ?>
      <?php /* Si se trata de un archivo de la categoría */ if (is_category()) { ?>
        <div class="contentTitle container">
          <h1 class="pagetitle  resetSpace"><?php single_cat_title(); ?></h1>
        </div>
      <?php /* Si se trata de un archivo de variables */ } elseif (is_tag()) { ?>
        <h1 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
      <?php /* Si se trata de un archivo diario */ } elseif (is_day()) { ?>
        <h1 class="pagetitle">Archivo para <?php the_time('F jS, Y'); ?></h1>
      <?php /* Si se trata de un archivo mensual */ } elseif (is_month()) { ?>
        <h1 class="pagetitle">Archivo para <?php the_time('F, Y'); ?></h1>
      <?php /* Si se trata de un archivo anual */ } elseif (is_year()) { ?>
        <h1 class="pagetitle">Archivo para <?php the_time('Y'); ?></h1>
      <?php /* Si se trata de un archivo autor */ } elseif (is_author()) { ?>
        <h1 class="pagetitle">Archivo del Autor</h1>
      <?php /* Si se trata de un archivo de paginado */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
        <h1 class="pagetitle">Archivos del Blog</h1><?php } ?>
    </div>

    <div class="contentItemsCat container">
      <div class="descripCat"><?php echo category_description(); ?></div>
      <?php if (is_category(array(18))) { ?>
        <?php query_posts('cat=18&posts_per_page=1'); ?>
        <div class="conBlog">
          <?php while (have_posts()) : the_post(); ?>
            <div class="imgBlog reset BlogImgBlog">
              <a href="<?php the_permalink() ?>"><?php if (has_post_thumbnail()) {
                                                    the_post_thumbnail('destacada', array('alt' => get_the_title(), 'title' => get_the_title()));
                                                  } else { ?> <img src="<?php bloginfo('template_directory'); ?>/images/no-disponible.webp" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"> <?php } ?></a>
            </div>
            <div class="txtBlog">
              <p><?php the_tags('Tags: ', ', ', '<br />'); ?></p>
              <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
              <p class="autor"><span><i class="fa fa-user-o" aria-hidden="true"></i> Peru Conexión </span> <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php the_time('F');
                                                                                                                                                                          echo " ";
                                                                                                                                                                          the_time('d');
                                                                                                                                                                          echo ", ";
                                                                                                                                                                          the_time('Y'); ?></span></p>
              <p><?php echo excerpt(18); ?></p>
              <a class="readBlog" href="<?php the_permalink(); ?>"><?php echo $blog; ?></a>
            </div>
          <?php endwhile; ?>
        </div><?php wp_reset_query(); ?>
        <div class="conBlogCat">
          <?php while (have_posts()) : the_post(); ?>
            <div class="conBlog ">
              <div class="imgBlog ">
                <a href="<?php the_permalink() ?>"><?php if (has_post_thumbnail()) {
                                                      the_post_thumbnail('full', array('alt' => get_the_title(), 'title' => get_the_title()));
                                                    } else { ?> <img src="<?php bloginfo('template_directory'); ?>/images/no-disponible.webp" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"> <?php } ?></a>
              </div>
              <div class="txtBlog">
                <p><?php the_tags('Tags: ', ', ', '<br />'); ?></p>
                <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <p class="autor"><span><i class="fa fa-user-o" aria-hidden="true"></i> Peru Conexión </span> <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php the_time('F');
                                                                                                                                                                            echo " ";
                                                                                                                                                                            the_time('d');
                                                                                                                                                                            echo ", ";
                                                                                                                                                                            the_time('Y'); ?></span></p>
                <p><?php echo excerpt(18); ?></p>
                <a class="readBlog" href="<?php the_permalink(); ?>"><?php echo $blog; ?></a>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
        <div class="contentBlogRight">
          <?php include(TEMPLATEPATH . "/rec-aside.php"); ?>
          <?php include(TEMPLATEPATH . "/blog-aside.php"); ?>
          <?php include(TEMPLATEPATH . "/menu-blog.php"); ?>
        </div>
      <?php  } else { ?>
        <div class="flexcontent">
          <?php while (have_posts()) : the_post(); ?>
            <?php if (get_field("duracion_tours") == "0") {
              $dias = $HalfDay;
            } else if (get_field("duracion_tours") == "1") {
              $dias = $FullDay;
            } else {
              $dias = get_field("duracion_tours") . $DDias;
            } ?>

            <div class="itemsCat">
              <div class="imgCat reset">
                <a href="<?php the_permalink() ?>"><?php if (has_post_thumbnail()) {
                                                      the_post_thumbnail('destacadaBlog', array('alt' => get_the_title(), 'title' => get_the_title()));
                                                    } else { ?> <img src="<?php bloginfo('template_directory'); ?>/images/no-disponible.webp" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"> <?php } ?></a>
              </div>
              <div class="txtCat resetSpace">
                <?php if (get_field("titulo_tours")) { ?><h3><a href="<?php the_permalink() ?>"><?php the_field('titulo_tours'); ?><?php if (get_field("duracion_tours") != "Seleccionar") { ?><span class="duracion"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $dias ?></span><?php } ?></a></h3><?php } else { ?> <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3><?php } ?>
                <p><?php echo excerpt(25); ?></p>
                <a href="<?php the_permalink(); ?>" class="leermas"><?php echo $readmore; ?></a>
                <img src="<?php bloginfo('template_directory'); ?>/images/hotel.webp" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
                <img src="<?php bloginfo('template_directory'); ?>/images/bus.webp" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
                <img src="<?php bloginfo('template_directory'); ?>/images/tickets.webp" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
              </div>
            </div>
          <?php endwhile; ?>
        </div><?php } ?>
      <div class="navigation">
        <?php if (function_exists('wp_pagenavi')) {
          wp_pagenavi();
        } else { ?>
          <div class="alignleft"><?php next_posts_link('&larr; Entradas Anteriores') ?></div>
          <div class="alignright"><?php previous_posts_link('Entradas Siguientes &rarr;') ?></div>
        <?php } ?>
      </div>
    <?php else : ?>
      <article>
        <h2>No se ha encontrado</h2>
        <p>Lo sentimos, pero usted está buscando algo que no está aquí.</p>
      </article>
    </div>
  <?php endif; ?>
</section>
<?php get_footer(); ?>