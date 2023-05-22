<?php if (ICL_LANGUAGE_CODE=='es' ) : $title="Administradores";$text="Estos enlaces le ayudarn a darle mejor rendimiento a su Pagina Web";$ccnstrs="Comunicate con Nosotros"; endif; ?>
<?php if (ICL_LANGUAGE_CODE=='en' ) : $title="Administrators";$text="Estos enlaces le ayudarn a darle mejor rendimiento a su Pagina Web";$ccnstrs="Contact us"; endif; ?>

<style>
.BoxAdministradores {padding: 70px 0;}
.BoxAdministradores h2 {text-align: center;font-size: 40px;padding: 25px 0 20px;}
.BoxAdministradores p {text-align: center !important;font-size: 15px;font-weight: 100;line-height: 25px;padding-bottom: 30px;}
.BoxAdministradoresEnlaces {display: flex;flex-wrap: wrap;}
.BoxAdministradoresEnlaces a {width: 24%;box-sizing: border-box;padding: 5px;border: 1px dashed #ccc;margin: 5px;}
.BoxAdministradoresEnlaces a:hover {border: 1px solid #ccc;}
#footer{background-color: #1a4e34;}
#innerfooter{ width:1100px; margin:auto; overflow:hidden; padding:20px 0 40px;}
.contactfooter{}
.contactfooter ul{ list-style:none; font-size:0; text-align:center;}
.contactfooter ul li{ color:#fff;font-family: 'Open Sans', sans-serif; font-size: 20px; opacity:0.9; font-weight:300; display:inline-block; margin:0 10px;}
.contactfooter ul li i{ width:30px; text-align:center;}
.contactfooter h3{text-align:center;font-weight:300;padding-bottom:15px;border-bottom:dashed 1px #787878;margin-bottom:15px;font-size: 28px !important;color: #fff !important;}
</style>

<?php 
/*
Template Name: Administradores
*/
get_header(); ?>
<section class="content">
    <article class="BoxAdministradores"><div class="container">
       <h2><?php echo $title ?></h2>
       <p><?php echo $text ?></p>
       <div class="BoxAdministradoresEnlaces">
           <a href="https://accounts.google.com/signin/v2/identifier?service=analytics&passive=1209600&continue=https%3A%2F%2Fanalytics.google.com%2Fanalytics%2Fweb%2F%23&followup=https%3A%2F%2Fanalytics.google.com%2Fanalytics%2Fweb%2F&flowName=GlifWebSignIn&flowEntry=ServiceLogin"><img src="https://skynetcusco.com/google-analitic.jpg" alt=""></a>
           <a href="https://search.google.com/search-console/about?hl=es"><img src="https://skynetcusco.com/google-console.jpg" alt=""></a>
           <a href="https://www.NOMBREDELAEMPRESA.com/webmail"><img src="https://skynetcusco.com/webmail.jpg" alt=""></a>
           <a href="https://www.NOMBREDELAEMPRESA.com/wp-admin"><img src="https://skynetcusco.com/worpress.jpg" alt=""></a>
       </div>
    </div></article>
    <div id="footer">
	<div id="innerfooter">
	<div id="black-studio-tinymce-7" class="contactfooter widget widget_black_studio_tinymce"><h3><?php echo $ccnstrs ?></h3><div class="textwidget"><ul>
        <li><i class="fa fa-phone fa- "></i> +51 084 601425</li>
        <li><i class="fa fa-envelope fa- "></i> ventas@skynetcusco.com</li>
        <li><i class="fa fa-whatsapp fa- "></i> + 51 932 395821</li>
        <li><i class="fa fa-map-marker fa- "></i> Av. Huascar #222 3er piso, Wanchaq</li>
    </ul>
    </div></div> 
    </div></div> 
</section>
<?php get_footer(); ?>