<?php if (ICL_LANGUAGE_CODE == 'es') :
    $blog = "37";
    $tmenublog = "Entradas Destacadas";
endif; ?>
<?php if (ICL_LANGUAGE_CODE == 'en') :
    $blog = "37";
    $tmenublog = "Featured Entries";
endif; ?>

<?php query_posts('cat=' . $blog . '&posts_per_page=5'); ?>
<ul class="textTours">
    <h3 class="menu-blog"><?php echo $tmenublog; ?></h3>
    <?php while (have_posts()) : the_post(); ?>
        <li><a href="<?php the_permalink() ?>" class="title"><?php the_title(); ?></a></li>
    <?php endwhile;
    wp_reset_query(); ?>
</ul>