<?php get_header(); ?>
<?php include(TEMPLATEPATH."/sidebar-left.php");?>
<section class="content">
        <?php if (have_posts()) : ?>
 	  <?php $post = $posts[0]; // Truco. Conjunto $post para que the_date() funcione. ?>
 	  <?php /* Si se trata de un archivo de la categoría */ if (is_category()) { ?>
        <h1 class="pagetitle">Archivo de <?php single_cat_title(); ?></h1>
 	  <?php /* Si se trata de un archivo de variables */ } elseif( is_tag() ) { ?>
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
        <h1 class="pagetitle">Archivos del Blog</h1>
 	  <?php } ?>
        <?php while (have_posts()) : the_post(); ?>
        <article>
                <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Enlace para <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <h3><?php the_time('l, j F, Y') ?> | <?php the_category(', ') ?> | <?php comments_popup_link('0 Comentarios', '1 Comentario', '% Comentarios'); ?></h3>
                    <?php the_content(); ?>
                    <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
                <?php if (function_exists('the_tags')) { the_tags('<p class="postmetadata">Tags: ', ', ', '</p>'); } ?>
        </article>
        <?php endwhile; ?>
            <div class="navigation">
                <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>

                <div class="alignleft"><?php next_posts_link('&larr; Entradas Anteriores') ?></div>
                <div class="alignright"><?php previous_posts_link('Entradas Siguientes &rarr;') ?></div>
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