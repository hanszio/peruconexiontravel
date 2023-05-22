<?php if (ICL_LANGUAGE_CODE == 'es') : $cat = 33;
    $als = "Leer Testimonio";
    $title = "Recomendaciones";
endif; ?>
<?php if (ICL_LANGUAGE_CODE == 'en') : $cat = 33;
    $als = "Leer Testimonio";
    $title = "Recomendaciones";
endif; ?>
<?php query_posts('cat=' . $cat . '&posts_per_page=12'); ?>
<div class="titleCat">
    <h2><?php echo $title ?></h2>
</div>
<div class="owlItemFoter owl-carousel owl-theme boxItems">
    <?php $contador = 1;
    while (have_posts()) : the_post(); ?>
        <div class="Content-Test<?php if ($contador > 6) {
                                    echo " Pre-Tsti2";
                                } ?>">
            <div class="shadow">
                <div class="detSingle">
                    <p><span class="dificult-<?php the_field('testimonio'); ?>"></span></p>
                </div>
                <div class="textTest">
                    <h2><a href="<?php the_permalink(); ?>" class=""><?php the_title(); ?></a></h2>
                    <p><?php echo excerpt(80); ?></p>
                    <img src="<?php bloginfo('template_directory'); ?>/images/lineasFooter.png" alt="">
                    <h2><?php the_time("l, j F, Y") ?></h2>
                </div>
            </div>
        </div>
    <?php $contador = $contador + 1;
    endwhile;
    wp_reset_query(); ?>
</div>