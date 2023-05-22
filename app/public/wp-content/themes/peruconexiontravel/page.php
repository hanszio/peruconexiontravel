<?php get_header(); ?>
<section class="BoxPage"><div class="container">
   <article>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        <?php edit_post_link('Edit', '<p>', '.</p>'); ?>
        <?php endwhile; endif; ?>
    </article>
</div></section>
<?php get_footer(); ?>