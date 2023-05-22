<?php
/*
Template Name: Testimonios
Template Post Type: post
Description: Template para testimonios
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
<div class="container testimonial__post">
    <div class="BoxSingle">
        <div class="boxGale">
            <div class="boxGaleImg">
                <?php include(TEMPLATEPATH . "/galeria.php"); ?>
            </div>
            <div class="boxGaleText">
                <p><?php echo $tdes ?> $<?php the_field('precio'); ?> <?php echo $tppns ?></p>
                <p><?php the_field('duracion'); ?></p>
            </div>
        </div>
        <div class="BoxDescripcionSingle">
            <h1><?php the_title(); ?></h1>
            <?php the_field('descripcion'); ?>
        </div>
        <article>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                    <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
            <?php endwhile;
            endif; ?>
        </article>
    </div>
</div>
<?php get_footer(); ?>