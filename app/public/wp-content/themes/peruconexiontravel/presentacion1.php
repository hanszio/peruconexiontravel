<?php if (ICL_LANGUAGE_CODE=='es' ) : $cat = 20; $als="Ver Detalles"; endif; ?>
<?php if (ICL_LANGUAGE_CODE=='en' ) : $cat = 20; $als="Ver Detalles"; endif; ?>
<?php query_posts('cat='.$cat.'&posts_per_page=12'); ?>
<div class="titleCat"> <h2><?php echo get_cat_name($cat);?></h2> <p><?php echo category_description(); ?></p> </div>

<div class="owlItem owl-carousel owl-theme boxItems">
 <?php $contador = 1; while ( have_posts() ) : the_post(); ?>
<div class="Box-Category<?php if($contador > 6){echo " Box-Category2";} ?>">
    <div class="BoxCategoriaItem">
           <div class="BoxCategoria">
            <div class="BoxCategoriaImg">
                <a href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('destacada', array( 'alt' => get_the_title(), 'title' => get_the_title() ) ); }else{?> <img src="<?php bloginfo('template_directory'); ?>/images/no-disponible.webp" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"> <?php } ?></a>
            </div>
            <div class="BoxCategoriaText">
                 <h2><a href="<?php the_permalink(); ?>" class=""><?php the_title(); ?></a></h2>
                 <p><?php echo excerpt(25); ?></p>
                 <p><strong><?php the_field('duracion'); ?></strong></p>
                 <a href="<?php the_permalink(); ?>" class="bootom"><?php echo $als ?> <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> </a>
            </div>
           </div>
    </div>
</div>
<?php $contador = $contador + 1; endwhile; wp_reset_query(); ?>
</div>