<?php get_header(); ?>

<main id="content">
<header class="header">
<div class="wp-block-group alignfull has-white-color has-blue-background-color has-text-color has-background">
	<div class="wp-block-group__inner-container">
		<div class="wp-block-group test">
			<div class="wp-block-group__inner-container">
				<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
				<h2>Blog</h2>
				<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			</div>
		</div>
	</div>
</div>

<div class="btn_group">
		<?php 
		$category = get_queried_object();
		$current_category = $category->term_id;
		
		$categories = get_categories( array(
		'orderby' => 'name',
		'parent'  => 0
	) );
		$count = 0;
	foreach ( $categories as $category ) {
		
		// vars
		$image = get_field('color', $term);
		$link = get_category_link( $category->term_id );
		$name =  $category->name;
		$color = get_field('color', $category);
		$text_color = get_field('text_color', $category);
		?>
		<a href="<?php echo $link; ?>" class="btn_<?php echo $count ?><?php if ($current_category == $category->term_id) {echo ' current';}?>" style="background-color:<?php echo $color; ?>; color:<?php echo $text_color; ?>;">
			<span><?php echo $name; ?></span>
		</a>
		
		<?php
		$count++;
	}
	?>
 </div>

</header>

<div class="flex-container">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
	<div class="flex-item half">
		<?php get_template_part( 'entry' ); ?>
	</div>	
	
	<?php endwhile; endif; ?>
	<?php get_template_part( 'nav', 'below' ); ?>
</div>

</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>