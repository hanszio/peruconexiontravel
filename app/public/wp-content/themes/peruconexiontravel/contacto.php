<?php if (ICL_LANGUAGE_CODE == 'es') : $texto0 = "Contacto";
    $texto1 = "Encuentranos: ";
    $texto2 = "Complete el siguiente formulario para solicitaruna reserva. Nos pondremos en contacto dentro de las dos horas habiles, para confirmar la disponibilidad del tour u/o brindarle tras obsiones.";
    $texto3 = "Redes Sociales: ";
    $texto4 = "Contactenos: ";
endif; ?>
<?php if (ICL_LANGUAGE_CODE == 'en') : $texto0 = "Contact";
    $texto1 = "Find Us: ";
    $texto2 = "Complete el siguiente formulario para solicitaruna reserva. Nos pondremos en contacto dentro de las dos horas habiles, para confirmar la disponibilidad del tour u/o brindarle tras obsiones.";
    $texto3 = "Social networks: ";
    $texto4 = "Contact Us: ";
endif; ?>
<?php
/*
Template Name: Contactos
*/
get_header(); ?>
<article class="Paginas-cont">
    <div class="container">
        <h1><?php echo $texto0; ?></h1>
        <div class="Formulario-Paginas">
            <div data-aos="fade-down-right" class="aos-init aos-animate">
                <h2><?php echo $texto1; ?></h2>
                <p><?php echo $texto2; ?></p>
                <div class="FormularioPage">
                    <?php if (ICL_LANGUAGE_CODE == 'es') {
                        echo do_shortcode('[contact-form-7 id="361" title="FormPage"]');
                    }
                    if (ICL_LANGUAGE_CODE == 'en') {
                        echo do_shortcode('[contact-form-7 id="361" title="FormPage"]');
                    } ?>
                </div>
            </div>
        </div>
        <div class="Cont-RC">
            <div data-aos="fade-up-left" class="aos-init aos-animate">
                <h2><?php echo $texto3; ?></h2>
                <div class="Redes-Iconos">
                    <p><a href="https://www.facebook.com/peruconexiontravel" target="_blank" rel="noopener"><i class="fa fa-facebook fa- "></i></a></p>
                    <p><a href="https://www.tiktok.com/@peruconexiontravelagency" target="_blank" rel="noopener"><i class="fa-brands fa-tiktok fa- "></i></a></p>
                    <p><a href="https://www.instagram.com/peruconexion/" target="_blank" rel="noopener"><i class="fa fa-instagram fa- "></i></a></p>
                    <!-- <p><a href="https://www.tripadvisor.co/Attraction_Review-g294314-d23798730-Reviews-Peru_Conexion_Travel_Agency-Cusco_Cusco_Region.html" target="_blank" rel="noopener"><i class="fa fa-tripadvisor fa- "></i></a></p> -->
                </div>
                <h2><?php echo $texto4; ?></h2>
                <table>
                    <tbody>
                        <tr>
                            <td><i class="fa fa-phone fa- "></i></td>
                            <td><p>+51 914 248 899</p></td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-envelope fa- "></i></td>
                            <td>
                                <p>info@peruconexiontravel.com</p>
                                <p>reservas@peruconexiontravel.com</p>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-map-marker fa- "></i></td>
                            <td>
                                <p></p>
                                <p>APV Sol Naciente M-2</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</article>
<?php get_footer(); ?>