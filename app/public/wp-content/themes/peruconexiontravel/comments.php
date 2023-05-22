<?php
/**
 * @package WordPress
 * @subpackage DTA-VIC
 */

// No elimine estas líneas
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Por favor, no cargue esta página directamente. Gracias!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">Esta entrada está protegida. Introduzca la contraseña para ver los comentarios.</p>
	<?php
		return;
	}
?>

<!-- Usted puede comenzar la edición aquí. -->
<div class="maincomments">

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number('No hay respuestas ', 'Una respuesta', '% respuestas' );?> para &#8220;<?php the_title(); ?>&#8221;</h3>


	<ol class="commentlist">
	<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
	</ol>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- Si los comentarios están abiertos, pero no hay ningún comentario. -->

	 <?php else : // Los comentarios están cerrados ?>
		<!-- Si los comentarios están cerrados. -->
		<p class="nocomments">Los comentarios están cerrados.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="respond">

<h3><?php comment_form_title( 'Deja un comentario', 'Deja un comentario para %s' ); ?></h3>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">Logueado</a> para escribir un comentario.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>

<p>Conectado como <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Desconectarse de esta cuenta">Finalizar la sesión</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small>Nombre <?php if ($req) echo "(Necesario)"; ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small>Email (no será publicado) <?php if ($req) echo "(Necesario)"; ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
<label for="url"><small>Sitio Web</small></label></p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="Enviar comentario" /> <small><?php cancel_comment_reply_link(); ?></small>
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // Si es necesario registrarse y no se haya identificado?>
</div>

<?php endif; // si se elimina este el cielo caerá sobre tu cabeza ?>
</div>