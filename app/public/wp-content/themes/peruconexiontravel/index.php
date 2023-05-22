<?php get_header(); ?>
<?php include(TEMPLATEPATH."/sidebar-left.php");?>
<section class="content">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article>
                <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Enlace para <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <h3><?php the_time('l, j F, Y') ?> | <?php the_category(', ') ?> | <?php comments_popup_link('0 Comentarios', '1 Comentario', '% Comentarios'); ?></h3>
                <div class="entry content_Index">
                    <a class="imgThumb" href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail', array( 'alt' => get_the_title(), 'title' => get_the_title() ) ); } ?></a>
                    <!--  the_post_thumbnail('thumbnail'); the_post_thumbnail('medium'); the_post_thumbnail('large'); //3 tamaños predefinidos, the_post_thumbnail(); //tamaño real, the_post_thumbnail( array(100,100) ); // Resolución a medida -->
                    <?php the_content(); ?>
                    <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
                <?php if (function_exists('the_tags')) { the_tags('<p class="postmetadata">Tags: ', ', ', '</p>'); } ?>
            </article>
        <?php endwhile; ?>
            <div class="navigation">
                <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                <div class="hotelLeft"><?php next_posts_link('Anteriores') ?></div>
                <div class="hotelRight"><?php previous_posts_link('Siguientes') ?></div>
                <?php } ?>
            </div>
    <?php else : ?>
        <article>
            <h2>No se ha encontrado</h2>
            <p>Lo sentimos, pero usted está buscando algo que no está aquí.</p>
        </article>
    <?php endif; ?>
</section>
<?php include(TEMPLATEPATH."/sidebar-right.php");?>
<?php get_footer(); ?>