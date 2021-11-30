<?php
/**
 * Block Name: btn_group
 *
 * 
 */



// create id attribute for specific styling
$id = 'btn_group-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>


<div  id="<?php echo $id; ?>" class="btn_group <?php echo $align_class; ?> container">
	

	
	<div class="btn_group">
		<?php
		// Check rows exists.
		if( have_rows('button') ):
			$count = 1;
			// Loop through rows.
			while( have_rows('button') ) : the_row();
				
				// Load sub field value.
				$title = get_sub_field('title');
				$link = get_sub_field('link');
				$color = get_sub_field('color');
				$text_color = get_sub_field('text_color');
				
			?><a href="<?php echo $link ?>" style="color:<?php echo $text_color ?>; background-color:<?php echo $color ?>;" class="btn_<?php echo $count ?>"><span><?php echo $title ?></span></a><?php $count++; ?>
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