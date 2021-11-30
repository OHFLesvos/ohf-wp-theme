<?php
/**
 * Block Name: bg_image_with_action_btn
 *
 * 
 */

// get image field (array)
$background_image = get_field('background_image');

// create id attribute for specific styling
$id = 'bg_image_with_action_btn-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>


<div  id="<?php echo $id; ?>" class="bg_image_with_action_btn <?php echo $align_class; ?>">
	<img src="<?php echo $background_image['url']; ?>" alt="<?php echo $background_image['alt']; ?>" />
	
	
	<button>
					<?php the_field('title'); ?>
	</button>
	
	<div class="action_buttons">
		<?php
		// Check rows exists.
		if( have_rows('action_buttons') ):
		
			
			$count = 1;

			// Loop through rows.
			while( have_rows('action_buttons') ) : the_row();

				// Load sub field value.
				$title = get_sub_field('title');
				$link = get_sub_field('link');
				$color = get_sub_field('color');
				$text_color = get_sub_field('text_color');
		?>		
				
				<a href="<?php echo $link ?>" style="color:<?php echo $text_color ?>; background-color:<?php echo $color ?>;" class="btn_<?php echo $count ?>">
					<span><?php echo $title ?></span>
				</a>
				
				<?php
					$count++;
				?>
				
		<?php
			// End loop.
			endwhile;

		// No value.
		else :
			// Do something...
		endif;
	 ?>
	</div>
	

</div>




<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php the_field('background_color'); ?>;
		color: <?php the_field('text_color'); ?>;
	}
</style>