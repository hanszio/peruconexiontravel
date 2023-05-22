<div class="nuestros-viajes">
<div class="titleCat"> <h2>Nuestros Destinos</h2> </div>
    <section class="contViajes">
    	<div class="gridViajes">
			<?php $subcats=get_categories(array(
			'hide_empty' => false,
			'orderby'    => 'include',
    		'include'    => array( 6, 8, 10, 12, 14)
			));
			foreach($subcats as $subcat)
			{ $catLink=get_category_link( $subcat );
				$taxonomy=$subcat->taxonomy;
				$catID=$subcat->term_id;
			 	if(get_field('imagenDestinos',$taxonomy . '_' . $catID)){
				?>
			
    			<a href="<?php echo esc_url( $catLink); ?>">
    			<div class="itemViajesdestinos">
    				<div class="textGriddestinos">
              			<?php echo '<h2>' . $subcat->cat_name . '</h2>';?>
						<h3>Ver Tours</h3>
    				</div>
    				<?php $image =get_field('imagenDestinos',$taxonomy . '_' . $catID);
    		 ?>
    			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
    			</div>
    		</a>
    		<?php } ?>
    <?php	} ?>
    	</div>
    </section>

</div>