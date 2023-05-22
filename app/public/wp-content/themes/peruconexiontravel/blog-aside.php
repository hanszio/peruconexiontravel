<?php if (ICL_LANGUAGE_CODE=='es' ) : $desde="Desde ";$cat ="35";$readmore="Ver Articulo";$tblog="Tours Destacados";  endif; ?>
<?php if (ICL_LANGUAGE_CODE=='en' ) : $desde="From "; $cat ="35";$readmore="Read Article";$tblog="Featured Tours";endif; ?>
  
<div class="blogRight">
<?php query_posts('cat='.$cat.'&posts_per_page=3'); ?>
     <h3 class="menu-blog"><?php echo $tblog;?></h3>
 <?php while ( have_posts() ) : the_post(); ?>
<div class="contentItemBlog">      
    <div class="imagenBlog">
            <a href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('sizesCat', array( 'alt' => get_the_title(), 'title' => get_the_title() ) ); }else{?> <img src="<?php bloginfo('template_directory'); ?>/images/BGdestacadaa.jpg" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"> <?php } ?></a>
    </div>
    <div class="textBlogAside">          
            <?php if (get_field("titulo")){ ?><h3><a href="<?php the_permalink() ?>"><?php the_field('titulo'); ?></a></h3><?php } else { ?> <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3><?php } ?>   
            <p><?php echo excerpt(12); ?></p> 

    </div>
</div>
<?php endwhile; wp_reset_query(); ?>
</div>