<?php if (ICL_LANGUAGE_CODE == 'es') : $desde = "Desde ";
  $cat = "31";
  $readmore = "Ver Articulo";
  $tblog = "Articulos recientes";
endif; ?>
<?php if (ICL_LANGUAGE_CODE == 'en') : $desde = "From ";
  $cat = "31";
  $readmore = "Read Article";
  $tblog = "Recent articles";
endif; ?>
<div class="conBlogRight">
  <div class="conitemBlog">
    <?php query_posts('cat=' . $cat . '&posts_per_page=3'); ?>
    <?php while (have_posts()) : the_post(); ?>
      <?php if (get_field("duracion_tours") == "0") {
        $dias = $HalfDay;
      } else if (get_field("duracion_tours") == "1") {
        $dias = $FullDay;
      } else {
        $dias = get_field("duracion_tours") . $DDias;
      } ?>

      <div class="conBlog asideBlog ">
        <div class="imgBlog ">
          <a href="<?php the_permalink() ?>"><?php if (has_post_thumbnail()) {
                                                the_post_thumbnail('full', array('alt' => get_the_title(), 'title' => get_the_title()));
                                              } else { ?> <img src="<?php bloginfo('template_directory'); ?>/images/BGdestacadaa.jpg" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"> <?php } ?></a>
        </div>
        <div class="txtBlog">
          <p><?php the_tags('Tags: ', ', ', '<br />'); ?></p>
          <?php if (get_field("titulo_tours")) { ?><h2><a href="<?php the_permalink() ?>"><?php the_field('titulo_tours'); ?><?php if (get_field("duracion_tours") != "Seleccionar") { ?><span class="duracion"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $dias ?></span><?php } ?></a></h2><?php } else { ?> <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2><?php } ?>
          <p class="autor"><span><i class="fa fa-user-o" aria-hidden="true"></i> I. Machupicchu Travel </span> <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php the_time('F');
                                                                                                                                                                              echo " ";
                                                                                                                                                                              the_time('d');
                                                                                                                                                                              echo ", ";
                                                                                                                                                                              the_time('Y'); ?></span></p>
          <a class="readBlog" href="<?php the_permalink(); ?>"><?php echo $blog; ?></a>
        </div>
      </div>
    <?php endwhile;
    wp_reset_query(); ?>
  </div>
</div>