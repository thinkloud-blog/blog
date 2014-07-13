<?php
/**
 * Displaying archive page (category, tag, archives post, author's post)
 *
 * @package bootstrap-basic
 */

get_header();

/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();
?>
<?php get_sidebar('left'); ?>
				<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
					<main id="main" class="site-main" role="main">
						<?php
						/* JLE : add breadcrumbs widget zone */
						if (is_active_sidebar('content-above')) { ?>
							<?php dynamic_sidebar('content-above'); ?>
							<hr class="clearfix" />
						<?php } // endif JLE; ?>

						<article>
						<?php if (have_posts()) { ?>

						<header class="page-header">
							<h1 class="page-title">
								<?php
									$category = get_category($cat);
									$term_meta = get_option( "taxonomy_{$cat}" );
									if($term_meta['custom_frontoffice_name'] != "null") {
										echo $term_meta['custom_frontoffice_name'];
									} else {
										single_cat_title();
									}
								?>
							</h1>

							<?php
							// Show an optional term description.
							$term_description = term_description();
							$taxonomy_image_url = z_taxonomy_image_url($child->term_id);

							$img_id = z_get_attachment_id_by_url($taxonomy_image_url);
							if (!empty($term_description)) {
								echo '<div class="taxonomy-description">';
								if(! is_null($img_id)) {
									$img = get_post($img_id);
									echo '<p class="thumbnail col-md-3"><img src="' . $taxonomy_image_url. '" align="left" alt="'. $img->post_excerpt . '" />'.
									'<small>'. $img->post_content .'</small>';
								}
								echo '<div class="col-md-9">' .
								$term_description .'</div></div>';

								//
							} //endif;
							?>


						</header><!-- .page-header -->
						<?php
								the_sistercategories($cat);
								if($term_meta['custom_show_subcats'] ==  '1') {
									$args = array('orderby' => 'name', 'pad_count' => 1, 'hierarchical' => 0, 'child_of'=> $cat);
									the_subcategories($cat, $args, array('title'=>$term_meta['custom_subcats_title']));
								}
							?>
						<section>
						<ol class="posts-list">
						<?php
						/* Start the Loop */

						while (have_posts()) {
							echo '<li class="col-md-3">';
							the_post();

							/* Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */

							get_template_part('content', 'postlist');
							echo '</li>';
						} //endwhile;
						?>
						</ol><hr class="clearfix" />
						<?php bootstrapBasicPagination(); ?>

						<?php } else { ?>

						<?php get_template_part('no-results', 'archive'); ?>

						<?php } //endif; ?>
						</section></article>
					</main>
				</div>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>
