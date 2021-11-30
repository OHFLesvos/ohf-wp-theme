<?php /* Template Name: Category overview */ ?>
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
<a href="/<?php echo pll_current_language() ?>/blog" style="background-color:#5832ff !important; color:white !important;">
			<span>
				<?php esc_html_e( 'Latest', 'ohfnext' ); ?>
			</span>
</a>
		
		<?php 
		$category = get_queried_object();
		$current_category = $category->term_id;
		
		$categories = get_categories( array(
		'orderby' => 'name',
		'parent'  => 0,
		'exclude' => '402,404,406',
	) );
		$count = 0;
	foreach ( $categories as $category ) {
		
		// vars
		$image = get_field('color', $term);
		$link = get_category_link( $category->term_id ).'#start_reading';
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

<div class="flex-container" id="start_reading">



<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
	'posts_per_page' => get_option('posts_per_page'),
	'posts_per_page' => 50,
	'paged' => $paged,
	'post_type'=>'post', 
	'post_status'=>'publish'
);
$custom_query = new WP_Query( $args );

// Pagination fix
$temp_query = $wp_query;
$wp_query   = NULL;
$wp_query   = $custom_query;
?>
 
 

<?php if ( $custom_query->have_posts() ) : ?>
 

 
    <!-- the loop -->
    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
        
		<div class="flex-item half">
			<?php get_template_part( 'entry' ); ?>
		</div>	
		
		
    <?php endwhile; ?>
    <!-- end of the loop -->
 

 

 
<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

    <?php wp_reset_postdata(); ?>
	
	
<?php if (function_exists("pagination")) {
 //pagination($custom_query->max_num_pages);
} ?>

</div>

</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>