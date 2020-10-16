<?php
/**
 * Block Name: btn
 *
 * 
 */


// create id attribute for specific styling
$id = 'bg_image_with_action_btn-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>


<div  id="<?php echo $id; ?>" class="btn <?php echo $align_class; ?> <?php if (get_field('stick_to_bottom')) {echo 'stick_buttom';} ?>">
	
	<a href="<?php the_field('link'); ?>" class="btn_01">
					<?php the_field('text'); ?>
	</a>
	
	

</div>




<style type="text/css">
	#<?php echo $id; ?> {
	}
</style>