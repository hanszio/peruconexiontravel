<div class="Gallery-Image">
    <?php $images = get_field('galeria');
    if ($images) { ?>
        <div id="Gal" class="Galeria-img owl-carousel owl-theme">
            <?php foreach ($images as $image) : ?>
                <div class="Item-Galeria">
                    <img src="<?php echo $image['sizes']['galeria']; ?>" alt="<?php echo $image['alt']; ?>" />
                </div>
            <?php endforeach; ?>
        </div>
    <?php } else { ?>
        <div class="galeriaSingle reset">
            <?php { ?>
                <div class="Item-Galeria">
                    <img src="<?php bloginfo('template_directory'); ?>/images/BG-galeria.jpg" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>