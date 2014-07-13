<article id="post-<?php the_ID(); ?>" class="thumbnail">
	<header class="entry-header">
		<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
	</header><!-- .entry-header -->


	<?php if (is_search() || is_category()) { // Only display Excerpts for Search & posts listed in categories ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<?php if (has_post_thumbnail()) { ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumbnail">
		<?php the_post_thumbnail('medium'); ?>
		</a>
		<?php } ?>
		<p class="text-right">
			<a href="<?php echo get_permalink(); ?>" class="btn btn-primary btn-lg"><?php echo esc_html__('Read more', 'bootstrap-basic'); ?><span class="glyphicon glyphicon-share-alt"></span></a>
		</p>
		<hr class="clearfix" />
	</div><!-- .entry-summary -->
	<?php } else { ?>
	<div class="entry-content">
		<?php the_content(bootstrapBasicMoreLinkText()); ?>
		<hr class="clearfix" />
		<?php
		/**
		 * This wp_link_pages option adapt to use bootstrap pagination style.
		 * The other part of this pager is in inc/template-tags.php function name bootstrapBasicLinkPagesLink() which is called by wp_link_pages_link filter.
		 */
		wp_link_pages(array(
			'before' => '<div class="page-links">' . __('Pages:', 'bootstrap-basic') . ' <ul class="pagination">',
			'after'  => '</ul></div>',
			'separator' => ''
		));
		?>
	</div><!-- .entry-content -->
	<?php } //endif; ?>


</article><!-- #post-## -->
