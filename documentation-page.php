<?php
/**
 * Template Name: Documentation Page
 *
 * @package Hello DMS
 * @subpackage hello_DMS
 * @since hello_DMS 1.0
 */
?>
<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
while (have_posts()):
	the_post();
	?>

	<div class="container-fluid d-flex px-0 mx-auto">
		<div class="w-100 p-0 m-0 position-absolute z-3">
			<?php get_header(); ?>
		</div>
		<div class="sidebar d-none d-lg-block col-lg-3 show h-100 overflow-hidden">
			<div class="d-flex p-2 mt-3 mb-5 bg-dark">
				<div
					class="site-branding show-<?php echo esc_attr(hello_elementor_get_setting('hello_header_logo_type')); ?>">
					<div class="site-logo <?php echo esc_attr(hello_show_or_hide('hello_header_logo_display')); ?>">
						<?php display_selected_logo(); ?>
					</div>
				</div>
			</div>
			<div class="bg-dark sidebar-content js-simplebar simplebar-scrollable-y" data-simplebar>
				<?php
				get_template_part('sidebar-menu');
				?>
			</div>
		</div>
		<div class="main col-12 col-lg-10 mx-auto">
			<main id="content" class="w-100 js-simplebar simplebar-scrollable-y" data-simplebar <?php post_class('site-main'); ?>>
				<div class="page-content">
					<?php if (apply_filters('hello_elementor_page_title', true)): ?>
						<div class="page-header">
							<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
						</div>
					<?php endif; ?>
					<?php the_content(); ?>
				</div>
				<?php
endwhile;
get_footer();
?>
		</main>
	</div>
</div>