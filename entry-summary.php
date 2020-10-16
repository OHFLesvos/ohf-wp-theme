<div class="entry-summary">

<?php the_excerpt(); ?>
<a href="" class="read_more" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php _e('read more', 'ohf_theme'); ?></a>

<?php if ( is_search() ) { ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
<?php } ?>
</div>


