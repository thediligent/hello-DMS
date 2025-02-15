<?php
/**
 * The template for displaying header.
 *
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
$is_editor = isset($_GET['elementor-preview']);
$site_name = get_bloginfo('name');
$tagline = get_bloginfo('description', 'display');
$header_class = did_action('elementor/loaded') ? hello_get_header_layout_class() : '';
$menu_args = [
	'theme_location' => 'menu-1',
	'fallback_cb' => false,
	'container' => false,
	'echo' => false,
];
$header_nav_menu = wp_nav_menu($menu_args);
$header_mobile_nav_menu = wp_nav_menu($menu_args); // The same menu but separate call to avoid duplicate ID attributes.
?>
<header id="site-header3" class="w-100 site-header dynamic-header position-absolute bg-transparent <?php echo esc_attr($header_class); ?>">
	<div class="container-fluid container-xxl d-flex align-items-center justify-content-end">
		<div class="d-flex">
			<div
				class="site-branding show-<?php echo esc_attr(hello_elementor_get_setting('hello_header_logo_type')); ?>">
				<div class="site-logo <?php echo esc_attr(hello_show_or_hide('hello_header_logo_display')); ?>">
					<?php display_selected_logo(); ?>
				</div>
			</div>
		</div>
		<div class="ms-auto d-none d-lg-flex">
			<?php if ($header_nav_menu): ?>
				<nav class=" site-navigation <?php echo esc_attr(hello_show_or_hide('hello_header_menu_display')); ?>"
					aria-label="<?php echo esc_attr__('Main menu', 'hello-elementor'); ?>">
					<?php
					// PHPCS - escaped by WordPress with "wp_nav_menu"
					echo $header_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				</nav>
			<?php endif; ?>
		</div>
		<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2"
			aria-labelledby="offcanvasNavbar2Label">
			<div class="offcanvas-header">
				<h5 class="offcanvas-title" id="offcanvasNavbar2Label">Menu</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
					aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<?php if ($header_nav_menu): ?>
					<nav class="ms-auto site-navigation">
						<?php
						// PHPCS - escaped by WordPress with "wp_nav_menu"
						echo $header_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</nav>
				<?php endif; ?>
				<form class="d-flex mt-3 mt-lg-0" role="search">
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
						jf-ext-cache-id="2">
					<button class="btn btn-outline-success" type="submit" jf-ext-button-ct="search">Search</button>
				</form>
			</div>
		</div>
		<div class="ms-auto ms-lg-2 form-check form-switch">
			<input class="form-check-input" type="checkbox" role="switch" id="toggleTheme">
			<label class="form-check-label" for="toggleTheme"></label>
		</div>
		<a href="#" class="d-xl-none navbar-toggler" data-bs-toggle="offcanvas"
			data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
			<span class="material-symbols-outlined text-light">
				menu
			</span>
		</a>
		<?php if ($header_mobile_nav_menu): ?>
			<div
				class=" d-none site-navigation-toggle-holder <?php echo esc_attr(hello_show_or_hide('hello_header_menu_display')); ?>">
				<button type="button" class="site-navigation-toggle">
					<span class="site-navigation-toggle-icon"></span>
					<span class="screen-reader-text"><?php echo esc_html__('Menu', 'hello-elementor'); ?></span>
				</button>
			</div>
			<nav class="site-navigation-dropdown <?php echo esc_attr(hello_show_or_hide('hello_header_menu_display')); ?>"
				aria-label="<?php echo esc_attr__('Mobile menu', 'hello-elementor'); ?>" aria-hidden="true" inert>
				<?php
				// PHPCS - escaped by WordPress with "wp_nav_menu"
				echo $header_mobile_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</nav>
		<?php endif; ?>

	</div>
</header>