<?php

/**
 * The template for displaying archive pages.
 *
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
get_header();
?>
<main id="content" class="site-main container">
	<div class="row mt-4">
		<div class="col-12 mx-auto">
			<header class="page-header">
				<?php
				the_archive_title('<h1 class="entry-title text-dark">', '</h1>');
				the_archive_description('<p class="archive-description">', '</p>');
				?>
			</header>
			<div class="page-content">
				<?php
				while (have_posts()) {
					the_post();
					$post_link = get_permalink();
				?>
					<article class="post p-4">
						<?php
						printf('<h2 class="%s h4 mb-3"><a class="text-decoration-none" href="%s">%s</a></h2>', 'entry-title', esc_url($post_link), wp_kses_post(get_the_title()));
						if (has_post_thumbnail()) {
							printf('<a href="%s">%s</a>', esc_url($post_link), get_the_post_thumbnail($post, 'large'));
						}
						the_excerpt();
						printf('<a class="btn btn-primary mt-4" href="%s"> Read More</a>', esc_url($post_link));
						?>
					</article>
				<?php } ?>
			</div>

			<?php wp_link_pages(); ?>

			<?php
			global $wp_query;
			if ($wp_query->max_num_pages > 1) :
			?>
				<nav class="pagination">
					<?php /* Translators: HTML arrow */ ?>
					<div class="nav-previous"><?php next_posts_link(sprintf(__('%s older', 'hello-elementor'), '<span class="meta-nav">&larr;</span>')); ?></div>
					<?php /* Translators: HTML arrow */ ?>
					<div class="nav-next"><?php previous_posts_link(sprintf(__('newer %s', 'hello-elementor'), '<span class="meta-nav">&rarr;</span>')); ?></div>
				</nav>
			<?php endif; ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>