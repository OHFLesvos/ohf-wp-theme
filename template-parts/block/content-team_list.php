<?php
/**
 * Block Name: team_list
 *
 * 
 */


// create id attribute for specific styling
$id = 'team_list-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>


<div  id="<?php echo $id; ?>" class="team_list <?php echo $align_class; ?>">
	
	<?php 
	if (get_field('team') == 'coo'){
				$team_cat = 'coordination_team';
	}
	elseif (get_field('team') == 'board'){
				$team_cat = 'board';
	}
	elseif (get_field('team') == 'germsupp'){
				$team_cat = 'german_support';
	}
	elseif (get_field('team') == 'partners'){
				$team_cat = 'partner';
	}
	
	
	if ($team_cat != 'partner'){
				
	
	?>
	
	<?php
	$args2 = array(
		'order' => 'ASC' ,
		'orderby' => 'title',
		'post_type' => 'team_member',
		'posts_per_page' => -1,
		'meta_key'     => $team_cat,
		'meta_value'   => 1,
	);
	
	$q2 = new WP_query($args2);
		if($q2->have_posts()) : ?>
			<?php $postid = $wp_query->post->ID; ?>
			<ul class="flex-container">
			
			<?php while($q2->have_posts()) : $q2->the_post(); ?>
			
			<?php
				$title = get_the_title();
				$featured_image = get_the_post_thumbnail ($post_id, $size = 'medium' );
			?>
			
			<li class="flex-item half">
						<div class="team_item_left">
							<?php echo $featured_image; ?>
						</div>
						
						<div class="team_item_right">
							<h3>
								<?php echo esc_html( $title ); ?>
							</h3>
							
							<p>
								<?php echo get_post_meta( get_the_ID(), 'responsibilities', true); ?>
							</p>
						</div>	

			</li>
			<?php endwhile; ?>
			<?php /* Restore original Post Data */
				wp_reset_postdata();
			?>
			
						</ul>
		<?php endif;	
		}
		
		else{ ?>
			
			<?php
	$args2 = array(
		'order' => 'ASC' ,
		'orderby' => 'title',
		'post_type' => 'partner',
		'posts_per_page' => -1,
	);
	
	$q2 = new WP_query($args2);
		if($q2->have_posts()) : ?>
			<?php $postid = $wp_query->post->ID; ?>
			<ul class="flex-container">
			
			<?php while($q2->have_posts()) : $q2->the_post(); ?>
			
			<?php
				$title = get_the_title();
				$featured_image = get_the_post_thumbnail ($post_id, $size = 'medium' );
				$link = get_post_meta( get_the_ID(), 'website', true);
			?>
			
			<li class="flex-item half">
						<div class="team_item_left">
							<a href="<?php echo $link; ?>" target="_blank" title="<?php echo esc_html( $title ); ?>"><?php echo $featured_image; ?></a>
						</div>
						
						<div class="team_item_right">
							<h3>
								<a href="<?php echo $link; ?>" target="_blank" title="<?php echo esc_html( $title ); ?>"><?php echo esc_html( $title ); ?></a>
							</h3>
							
							<!--
							<p>
								<?php echo get_post_meta( get_the_ID(), 'type_of_support', true); ?>
							</p>
							-->
						</div>	

			</li>
			<?php endwhile; ?>
			<?php /* Restore original Post Data */
				wp_reset_postdata();
			?>
			
						</ul>
		<?php endif;	?>
			
			
			
		<?php }
		?>
	
	

</div>




<style type="text/css">
	#<?php echo $id; ?> ul {
    list-style: none;
    margin-left: 0;
    padding-left: 0;
}
	#<?php echo $id; ?> ul li {
    margin-bottom:15px;
}
	#<?php echo $id; ?> .team_item_left {
    width: 40%;
    float: left;
    padding-right: 20px;
}
	#<?php echo $id; ?> .team_item_right {
    width: 60%;
	display: block;
    float: left;
    padding-right: 20px;
}
</style>