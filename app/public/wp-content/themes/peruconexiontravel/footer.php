<footer id="footer" class="clear">
    <div class="boxFotter">
        <div class="container">
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Box-2')) : endif; ?>
            <div class="Box-2-Redes center">
                <img src="<?php bloginfo('template_directory'); ?>/images/peru-conexion-travel-vertical-tag-blanco.svg" alt="">
                <div class="rdsfinal">
                    <ul>
                        <li><a href="https://www.facebook.com/Per%C3%BA-Conexi%C3%B3n-Travel-Agency-113918340360103" target="_blank"><span></span></a></li>
                        <li><a href="https://www.youtube.com" target="_blank"><span></span></a></li>
                        <li><a href="#"><span></span></a></li>
                        <li><a href="https://api.whatsapp.com/send?phone=51986268583&text=&source=&data=" target="_blank"><span></span></a></li>
                        <li><a href="https://www.peruconexiontravel.com/wp-admin" target="_blank"><span></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="copyright">
        <p>&copy; <?php echo date("Y"); ?>. Perú Conexión Travel. All Right Reserved.</p>
    </div>
</footer>
</div><!-- Fin container -->
<?php wp_footer(); ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/carousel/owl.carousel.min.js"></script>
<?php include(TEMPLATEPATH . "/analytics.php"); ?>
<script type="text/javascript">
    var jQuery = jQuery.noConflict();
    jQuery(document).ready(function() {
        jQuery("#Tours").val("<?php the_title(); ?>");
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#Gal").owlCarousel({
            items: 1,
            lazyLoad: true,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            nav: true,
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                680: {
                    items: 2
                },
                768: {
                    items: 1
                }
            }
        });
    });
</script>
<script type="text/javascript">
    var jQuery = jQuery.noConflict();
    jQuery(".owlItem").owlCarousel({
        items: 3,
        lazyLoad: true,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
		margin:20,
        nav: true,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1
            },
            680: {
                items: 2
            },
            768: {
                items: 3
            }
        }
    });
</script>
<script type="text/javascript">
    var jQuery = jQuery.noConflict();
    jQuery(".owlItemFoter").owlCarousel({
        items: 1,
        lazyLoad: true,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        nav: true,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1
            },
            680: {
                items: 1
            },
            768: {
                items: 1
            }
        }
    });
</script>
</body>

</html>