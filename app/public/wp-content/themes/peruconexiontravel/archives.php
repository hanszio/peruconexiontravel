<?php
/*
Template Name: Archives
*/
get_header(); ?>
<?php include(TEMPLATEPATH."/sidebar-left.php");?>
<section class="content">
    <article>
        <h2>Archivos por mes:</h2>
            <ul><?php wp_get_archives('type=monthly'); ?></ul>
        <h2>Archivos por Asunto:</h2>
            <ul><?php wp_list_categories(); ?></ul>
    </article>
</section>
<?php include(TEMPLATEPATH."/sidebar-right.php");?>
<?php get_footer(); ?>