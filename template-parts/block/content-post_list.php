<?php
/**
 * Block Name: post_list
 *
 * 
 */


// create id attribute for specific styling
$id = 'post_list-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>


<div  id="<?php echo $id; ?>" class="post_list <?php echo $align_class; ?>">
	
	<?php 
	if (get_field('post_type') == 'Media articles'){
				$post_type = 'media_article';
	}
	if (get_field('posts_to_show')){
				$posts_to_show = get_field('posts_to_show');
	}
	?>
	
	<?php
	$args2 = array(
		'order' => 'date' ,
		'post_type' => $post_type,
		'posts_per_page' => $posts_to_show,
	);
	
	$q2 = new WP_query($args2);
		if($q2->have_posts()) : ?>
			<?php $postid = $wp_query->post->ID; ?>
			<ul>
			
			<?php while($q2->have_posts()) : $q2->the_post(); ?>
			
			<?php
				$title = get_the_title();
			?>
			
			<li>
						<a href="<?php echo get_post_meta( get_the_ID(), 'website', true); ?>" target="_blank">
							<?php echo esc_html( $title ); ?>
						</a><br />
						
						<span><?php echo get_post_meta( get_the_ID(), 'media', true); ?>, </span>
						<span><?php echo get_post_meta( get_the_ID(), 'date_of_publication', true); ?></span>
							

			</li>
			<?php endwhile; ?>
			<?php /* Restore original Post Data */
				wp_reset_postdata();
			?>
			
						</ul>
		<?php endif;	?>
	
	

</div>




<style type="text/css">
	#<?php echo $id; ?> a {
		text-decoration: none;
		color: #000;
		border-bottom: 1px solid #000;
	}
	#<?php echo $id; ?> ul {
    list-style: none;
    margin-left: 0;
    padding-left: 0;
}
	#<?php echo $id; ?> ul li {
    margin-bottom:15px;
}
</style>