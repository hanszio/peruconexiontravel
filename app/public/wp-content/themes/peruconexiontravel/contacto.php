<?php if (ICL_LANGUAGE_CODE=='es' ) : $texto0="Contacto"; $texto1="Encuentranos: "; $texto2="Complete el siguiente formulario para solicitaruna reserva. Nos pondremos en contacto dentro de las dos horas habiles, para confirmar la disponibilidad del tour u/o brindarle tras obsiones."; $texto3="Redes Sociales: "; $texto4="Contactenos: "; endif; ?>
<?php if (ICL_LANGUAGE_CODE=='en' ) : $texto0="Contact"; $texto1="Find Us: "; $texto2="Complete el siguiente formulario para solicitaruna reserva. Nos pondremos en contacto dentro de las dos horas habiles, para confirmar la disponibilidad del tour u/o brindarle tras obsiones."; $texto3="Social networks: "; $texto4="Contact Us: "; endif; ?>
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
                    <?php if (ICL_LANGUAGE_CODE=='es' ) {echo do_shortcode('[contact-form-7 id="361" title="FormPage"]');}if (ICL_LANGUAGE_CODE=='en' ) {echo do_shortcode('[contact-form-7 id="361" title="FormPage"]');} ?>
                </div>
            </div>
        </div>
        <div class="Cont-RC">
            <div data-aos="fade-up-left" class="aos-init aos-animate">
                <h2><?php echo $texto3; ?></h2>
                <div class="Redes-Iconos">
                    <p><a href="https://www.facebook.com/" target="_blank" rel="noopener"><i class="fa fa-facebook fa- "></i></a></p>
                    <p><a href="https://www.youtube.com/" target="_blank" rel="noopener"><i class="fa fa-youtube-play fa- "></i></a></p>
                    <p><a href="https://plus.google.com/" target="_blank" rel="noopener"><i class="fa fa-google-plus fa- "></i></a></p>
                    <p><a href="https://www.tripadvisor.com.pe/" target="_blank" rel="noopener"><i class="fa fa-tripadvisor fa- "></i></a></p>
                </div>
                <h2><?php echo $texto4; ?></h2>
                <table>
                    <tbody>
                        <tr>
                            <td><i class="fa fa-phone fa- "></i></td>
                            <td>+51 951 263 487<p></p>
                                <p>+51 951 263 487</p>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-envelope-o fa- "></i></td>
                            <td>info@peruconexion.com<p></p>
                                <p>reservas@peruconexion.com</p>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-map-marker fa- "></i></td>
                            <td>   <p></p>
                                <p>Urb. Reyna de Belén C-7 Wanchaq
(Referencia altura del Terminal Terrestre)</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</article>
<?php get_footer(); ?>