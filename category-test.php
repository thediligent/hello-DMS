<?php

/**
 * The template for displaying archive pages for the press release section.
 *
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
get_header();
$press_query = new WP_Query(array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'orderby' => 'date',
	'order' => get_query_var('order'), // will return order by the query string variable in the url
	'paged' => get_query_var('paged'),
	'posts_per_page' => '12'
));
#This is where we find the sort order
$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
?>
<main id="content" class="site-main container-fluid container-lg pb-3 mb-5">
	<div class="row mt-4">
		<?php  #This is where the title and the description are added 
		?>
		<header class="page-header my-4 mx-2 col">
			<h1 class="entry-title text-black lp-underline d-inline-block">Press Releases</h1>
			<span class="text-light"><?php echo category_description(get_category_by_slug('press-release')->term_id); ?> </span>
		</header>
		<?php  #This is where the sort and style buttons are for the press releases 
		?>
		<div class="d-none d-lg-flex col justify-content-end align-self-end">
			<div class="p-3">
				<div class="btn-group" role="group">
					<a id="sort-btn" class="btn btn-outline-light d-flex">
						<i class="d-flex material-symbols-outlined pe-2">sort</i>
						<span class="d-flex"><span class="d-none d-xl-flex">Sorted by Date&nbsp;</span>
							<?php  #This is where we set the sort text 
							?>
							<?php if (isset($queries['order'])) {
								echo ($queries['order'] == 'asc') ? 'Ascending' : 'Descending';
							} else {
								echo 'Descending';
							} ?>
						</span></a>
					<a id="grid-btn" class="btn btn-outline-light d-flex">
						<i class="material-symbols-outlined pe-2">grid_view</i>
						<span class="d-flex"> Grid</span>
					</a>
					<a id="list-btn" class="btn btn-outline-light d-flex">
						<i class="material-symbols-outlined pe-2">view_agenda</i>
						<span class="d-flex"> List</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="page-content pb-3">
			<div class="row">
				<?php
				while ($press_query->have_posts()) {
					$press_query->the_post();
					$post_link = get_permalink();
				?>
					<div class="card-holder col-12 <?php if (isset($queries['style'])) {
														echo ($queries['style'] == 'grid') ? ' col-md-6 col-lg-4 card-grid' : 'card-list';
													} else {
														echo 'card-list';
													} ?>">
						<article class="post p-1">
							<div class="card h-100 my-2">
								<div class="row g-0">
									<div class="swap-card-image col-12 <?php if (isset($queries['style'])) {
																			echo ($queries['style'] == 'grid') ? '' : 'col-md-4';
																		} else {
																			echo 'col-md-4';
																		} ?>">
										<?php if (has_post_thumbnail()) { ?>
											<a href="<?php echo $post_link ?>">
												<div class="card-img-left rounded-start-2 w-100 h-100" style="background-size:cover; background-position:center center;background-image: url('<?php the_post_thumbnail_url('large'); ?>)'"></div>
												<img class="card-img-top img-fluid" src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php get_the_title() ?>" />
											</a>
										<?php } else { ?>
											<a href="<?php echo $post_link ?>">
												<div class="card-img-left rounded-start-2 w-100 h-100" style="background-size:cover; background-position:center center;background-image: url('<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/theme-images/laser-photonics-press-release-default-image.webp'); ?>)'"></div>
												<img class="card-img-top img-fluid" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/theme-images/laser-photonics-press-release-default-image.webp'); ?>" alt="<?php get_the_title() ?>" />
											</a>
										<?php } ?>
										<div class="lds-ring">
											<div></div>
											<div></div>
											<div></div>
											<div></div>
										</div>
									</div>
									<div class="swap-card-body col-12 <?php if (isset($queries['style'])) {
																			echo ($queries['style'] == 'grid') ? '' : 'col-md-8';
																		} else {
																			echo 'col-md-8';
																		} ?>">
										<div class="card-body">
											<?php
											printf('<h5 class="%s h-font fw-bold card-title"><a class="text-decoration-none text-dark" href="%s">%s</a></h2>', 'entry-title', esc_url($post_link), wp_kses_post(get_the_title()));
											?>
											<p class="card-text">
												<small class="text-secondary">
													<?php
													$post_id = get_the_ID();
													$publish_date = get_post_field('post_date', $post_id);
													echo mysql2date('l, F j, Y', $publish_date);
													?>
												</small>
											</p>
											<p class="text-muted"><?php the_excerpt();  ?></p>
											<?php printf('<a class="btn btn-primary btn-sm mt-4" href="%s"> Read More</a>', esc_url($post_link)); ?>
										</div>
									</div>
								</div>
							</div>
						</article>
					</div>
				<?php } ?>
			</div>
		</div>

		<?php wp_link_pages(); ?>

		<?php
		global $wp_query;
		if ($wp_query->max_num_pages > 1) :
		?>
			<nav class="pagination-container">
				<?php the_posts_pagination(array('mid_size' => 2)); ?>
			</nav>
		<?php endif; ?>
	</div>
	</div>
</main>
<?php get_footer(); ?>