<div class="entry-content">
<?php
	$show_featured_image = get_field ('hide_featured_image_inside_post');
?>
<?php if ( $show_featured_image != '1'  && has_post_thumbnail() ) { ?>

<a href="<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); echo esc_url( $src[0] ); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('large'); ?></a>

<?php ;} ?>
<?php the_content(); ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
</div>