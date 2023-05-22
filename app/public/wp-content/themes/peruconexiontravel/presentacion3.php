<?php if (ICL_LANGUAGE_CODE=='es' ) : $cat = 16; endif; ?>
<?php if (ICL_LANGUAGE_CODE=='en' ) : $cat = 16; endif; ?>
<?php query_posts('cat='.$cat.'&posts_per_page=12'); ?>
<div class="titleCat"> <h2><?php echo get_cat_name($cat);?></h2> <p><?php echo category_description(); ?></p> </div>

<div class="owlItem owl-carousel owl-theme boxItems">
 <?php $contador = 1; while ( have_posts() ) : the_post(); ?>
<div class="Box-Tren<?php if($contador > 6){echo " Box-Tren2";} ?>">
    <div class="BoxTrenItem">
           <div class="BoxTren">
            <div class="BoxTrenImg">
                <a href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('destacada', array( 'alt' => get_the_title(), 'title' => get_the_title() ) ); }else{?> <img src="<?php bloginfo('template_directory'); ?>/images/no-disponible.webp" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"> <?php } ?></a>
            </div>
            <div class="BoxTrenText">
                 <h2><a href="<?php the_permalink(); ?>" class=""><?php the_title(); ?></a></h2>
            </div>
           </div>
    </div>
</div>
<?php $contador = $contador + 1; endwhile; wp_reset_query(); ?>
</div>