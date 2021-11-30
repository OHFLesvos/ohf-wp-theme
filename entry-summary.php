<div class="entry-summary">

<?php the_excerpt(); ?>
<a href="<?php the_permalink(); ?>" class="read_more" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php esc_html_e( 'read more', 'ohfnext' ); ?></a>

<?php if ( is_search() ) { ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
<?php } ?>
</div>


