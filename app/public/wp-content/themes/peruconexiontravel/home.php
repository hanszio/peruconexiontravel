<?php if (ICL_LANGUAGE_CODE=='es' ) : $treco="Ventajas de Elegirnos"; endif; ?>
<?php if (ICL_LANGUAGE_CODE=='en' ) : $treco="Ventajas de Elegirnos"; endif; ?>

<?php 
/*
Template Name: Home
*/
get_header(); ?>
   <div class="BoxPresentacion1">
       <div class="container">
           <?php include(TEMPLATEPATH."/presentacion1.php"); ?>
       </div>
    </div>
    <div class="BoxDestino">
            <?php include(TEMPLATEPATH."/destinos.php"); ?>
    </div>
   <div class="BoxPresentacion1">
       <div class="container">
           <?php include(TEMPLATEPATH."/presentacion2.php"); ?>
       </div>
    </div>
    <div class="BoxDisena">
        <div class="container"><?php the_field('disena'); ?></div>    
    </div>
   <div class="BoxTestimonio">
       <div class="container">
           <div class="titleCat"><h2>Testimonios</h2></div>
           <?php echo do_shortcode('[trustindex no-registration=tripadvisor]'); ?>
       </div>
   </div>
   <div class="BoxVentajas">
       <div class="container">
           <h2><?php echo $treco ?></h2>
<div class="frontpage__ventajas">
	<?php
if( have_rows('ventajas_pct') ):
    while( have_rows('ventajas_pct') ) : the_row(); ?>
        <div class="ventaja">
            <img src="<?php echo get_sub_field('icono_ventaja')['url']; ?>" alt="<?php echo get_sub_field('icono_ventaja')['alt']; ?>">
            <p><?php echo get_sub_field('texto_ventaja'); ?></p>
        </div>
    <?php endwhile;
else :
    // no rows found
endif;
?>

		   </div>
       </div>
   </div>
   <div class="BoxPresentacion1">
       <div class="container">
           <?php include(TEMPLATEPATH."/presentacion3.php"); ?>
       </div>
    </div>
<section class="content">
    <article class="BoxHome">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        <?php endwhile; endif; ?>
    </article>
</section>
<?php get_footer(); ?>
