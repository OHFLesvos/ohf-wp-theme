<?php
/**
 * Block Name: project_overview
 *
 * 
 */



// create id attribute for specific styling
$id = 'project_overview-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>


<div  id="<?php echo $id; ?>" class="project_overview <?php echo $align_class; ?> container">
	
	<div class="project_overview">
	
	<?php
		$first_projects = get_field('first_projects');
		if( $first_projects ): 
		$firstPosts = array();
		$count = 0;
		?>
			

	<ul class="flex-container">
			
			<?php foreach( $first_projects as $project ): 
				//$permalink = get_permalink( $project->ID );
				$title = get_the_title( $project->ID );
				$custom_field = get_field( 'field_name', $project->ID );
				$featured_image = get_the_post_thumbnail ( $project->ID, $size = 'medium' );
				$firstPosts[] = $project->ID;
				$count++;
				?>
				<li class="flex-item <?php if ($count > 5) {echo "hidden additional_item";}?>">
					<div class="image_container">
						<span class="title">
								<?php echo esc_html( $title ); ?>
							</span>
							<?php echo $featured_image; ?>
					</div>
					
				
			<?php endforeach; ?>

	<?php endif; 
	?>
	
	
	<?php
	$args2 = array(
		'post__not_in' => $firstPosts, 
		'order' => 'ASC' ,
		'post_type' => 'project',
		'posts_per_page' => -1,
	);
	
	$q2 = new WP_query($args2);
		if($q2->have_posts()) :
			while($q2->have_posts()) : $q2->the_post(); ?>
			
			<?php
			
			$title = get_the_title();
			$featured_image = get_the_post_thumbnail ($post_id, $size = 'medium' );
			$count++;
				
			?>
			<li class="flex-item <?php if ($count > 5) {echo "hidden additional_item";}?>">
					<div class="image_container">
						<span class="title">
								<?php echo esc_html( $title ); ?>
							</span>
							<?php echo $featured_image; ?>
					</div>
			</li>
			<?php endwhile; ?>
			
						</ul>
		<?php endif;	?>
	<a class="btn_01 btn_align_center load_more">Show all</a>
	</div>
		
</div>

<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php the_field('background_color'); ?>;
		color: <?php the_field('text_color'); ?>;
	}
</style>