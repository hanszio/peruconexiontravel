<?php
/*
Template Name: Blog
Template Post Type: post
Description: Template para las entradas de Blog
*/
?>
<?php if (ICL_LANGUAGE_CODE == 'es') : $tdes = "Desde: ";
    $tppns = "Por Persona";
    $tp1s = "Pagos 100% Seguros";
    $tp1sa = "Pagar Ahora";
endif; ?>
<?php if (ICL_LANGUAGE_CODE == 'en') : $tdes = "Desde: ";
    $tppns = "Por Persona";
    $tp1s = "Pagos 100% Seguros";
    $tp1sa = "Pagar Ahora";
endif; ?>
<?php get_header(); ?>
<div class="container blog__post">
    <div class="BoxSingle">
        <div class="BoxSingleLeft">
            <div class="BoxDescripcionSingle">
                <h1><?php the_title(); ?></h1>
                <?php the_field('descripcion'); ?>
            </div>
            <div class="boxGale">
                <div class="boxGaleImg">
                    <?php include(TEMPLATEPATH . "/galeria.php"); ?>
                </div>
            </div>
            <article>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                <?php endwhile;
                endif; ?>
            </article>
        </div>
        <div class="BoxSingleRigth">
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Testimonio')) : endif; ?>
            <?php include(TEMPLATEPATH . "/blog-aside.php"); ?>
            <?php include(TEMPLATEPATH . "/menu-blog-destacados.php"); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>