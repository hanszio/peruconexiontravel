<div class="dp-wrap homeRight reset">
    <?php if (ICL_LANGUAGE_CODE == 'en') : $cat = "31";
        $readdtour = "View Tour";
    endif; ?>
    <?php if (ICL_LANGUAGE_CODE == 'es') : $cat = "31";
        $readdtour = "Ver Tour";
    endif; ?>
    <span id="dp-prev">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 51.401 51.401">
            <defs>
                <style>
                    .cls-1 {
                        fill: none;
                        stroke: #fff;
                        stroke-miterlimit: 10;
                        stroke-width: 7px;
                    }
                </style>
            </defs>
            <path id="Rectangle_4_Copy" data-name="Rectangle 4 Copy" class="cls-1" d="M32.246,0V33.178L0,31.953" transform="translate(0.094 25.276) rotate(-45)"></path>
        </svg>
    </span>
    <?php query_posts('cat=' . $cat . '&posts_per_page=9&order=ASC'); ?><?php $count = 1; ?>
    <div id="dp-slider" class="carouselTopFive">
        <?php while (have_posts()) : the_post(); ?>
            <div class="dp_item itemsTopFive resetSpace" data-class="<?php echo $count; ?>" data-position="<?php echo $count; ?>">
                <div class="imgTopFive">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('imagenTopFive', array('alt' => get_the_title(), 'title' => get_the_title()));
                        } else { ?> <img src="<?php bloginfo('template_directory'); ?>/images/bg-cat.jpg" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"> <?php } ?></a>
                </div>
                <div class="textTopFive">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?><br><strong><?php the_field('duracion'); ?></strong></a></h3>
                    <div class="TextFilaDos">
                        <p><?php the_field('precio'); ?></p>
                        <a href="<?php the_permalink(); ?>"><?php echo $readdtour; ?></a>
                    </div>
                </div>
            </div>
            <?php $count++; ?>
        <?php endwhile; ?>
    </div>
    <?php wp_reset_query(); ?>
    <span id="dp-next">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 51.401 51.401">
            <defs>
                <style>
                    .cls-1 {
                        fill: none;
                        stroke: #fff;
                        stroke-miterlimit: 10;
                        stroke-width: 7px;
                    }
                </style>
            </defs>
            <path id="Rectangle_4_Copy" data-name="Rectangle 4 Copy" class="cls-1" d="M32.246,0V33.178L0,31.953" transform="translate(0.094 25.276) rotate(-45)"></path>
        </svg>
    </span>
</div>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.11.2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        function detect_active() {
            // get active
            var get_active = $("#dp-slider .dp_item:first-child").data("class");
            $("#dp-dots li").removeClass("active");
            $("#dp-dots li[data-class=" + get_active + "]").addClass("active");
        }
        $("#dp-next").click(function() {
            var total = $(".dp_item").length;
            $("#dp-slider .dp_item:first-child").hide().appendTo("#dp-slider").fadeIn();
            $.each($('.dp_item'), function(index, dp_item) {
                $(dp_item).attr('data-position', index + 1);
            });
            detect_active();
        });
        $("#dp-prev").click(function() {
            var total = $(".dp_item").length;
            $("#dp-slider .dp_item:last-child").hide().prependTo("#dp-slider").fadeIn();
            $.each($('.dp_item'), function(index, dp_item) {
                $(dp_item).attr('data-position', index + 1);
            });
            detect_active();
        });
        $("#dp-dots li").click(function() {
            $("#dp-dots li").removeClass("active");
            $(this).addClass("active");
            var get_slide = $(this).attr('data-class');
            console.log(get_slide);
            $("#dp-slider .dp_item[data-class=" + get_slide + "]").hide().prependTo("#dp-slider").fadeIn();
            $.each($('.dp_item'), function(index, dp_item) {
                $(dp_item).attr('data-position', index + 1);
            });
        });
        $("body").on("click", "#dp-slider .dp_item:not(:first-child)", function() {
            var get_slide = $(this).attr('data-class');
            console.log(get_slide);
            $("#dp-slider .dp_item[data-class=" + get_slide + "]").hide().prependTo("#dp-slider").fadeIn();
            $.each($('.dp_item'), function(index, dp_item) {
                $(dp_item).attr('data-position', index + 1);
            });
            detect_active();
        });
        var autoplayInterval = setInterval(function() {
            $("#dp-next").trigger("click");
        }, 5000);
        $("#dp-slider, #dp-next, #dp-prev, #dp-dots li").hover(function() {
            clearInterval(autoplayInterval);
        }, function() {
            autoplayInterval = setInterval(function() {
                $("#dp-next").trigger("click");
            }, 5000);
        });
    });
</script>