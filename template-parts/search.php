<?php

/**
 * The template for displaying search results.
 *
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>
<div class="container content px-4 px-lg-auto py-4 mb-4">
	<div class="row">
		<div class="col-12">
			<?php if (have_posts()) : ?>
				<?php
				while (have_posts()) :
					the_post();
					$post_link = get_permalink();
				?>
					<article class="post p-3 card my-3">
						<?php
						printf('<h4 class="%s"><a class="text-decoration-none fw-bold" href="%s">%s</a></h4>', 'entry-title', esc_url($post_link), wp_kses_post(get_the_title()));
						the_excerpt();
						?>
					</article>
				<?php
				endwhile;
				?>
			<?php else : ?>
				<p><?php echo esc_html__('It seems we can\'t find what you\'re looking for.', 'hello-elementor'); ?></p>
			<?php endif; ?>
		</div>

		<?php wp_link_pages(); ?>

		<?php
		global $wp_query;
		if ($wp_query->max_num_pages > 1) :
		?>
			<div class="archive">
				<nav class="d-flex nav-links pagination-container justify-content-center">
					<?php
					// the_posts_pagination(array('mid_size' => 2));
					$total_pages = $wp_query->max_num_pages;

					if ($total_pages > 1) {

						$current_page = max(1, get_query_var('page'));

						echo paginate_links(array(
							'base' => @add_query_arg('page', '%#%'),
							'format' => '?page=%#%',
							'current' => $current_page,
							'total' => $total_pages,
							'prev_text'    => __('« prev'),
							'next_text'    => __('next »'),
						));
					}

					?>
				</nav>
			<?php endif; ?>
			</div>
	</div>
</div>