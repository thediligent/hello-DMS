<?php
/**
* Template Name: Documenation Page
*
* @package Hello DMS
* @subpackage hello_DMS
* @since hello_DMS 1.0
*/
?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header();

while ( have_posts() ) :
	the_post();
	?>

<main id="content" <?php post_class( 'site-main' ); ?>>

	<?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
		<div class="page-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	<?php endif; ?>

	<div class="page-content">
		<?php the_content(); ?>

		<?php wp_link_pages(); ?>

		<?php if ( has_tag() ) : ?>
		<div class="post-tags">
			<?php the_tags( '<span class="tag-links">' . esc_html__( 'Tagged ', 'hello-elementor' ), ', ', '</span>' ); ?>
		</div>
		<?php endif; ?>
	</div>

	<?php comments_template(); ?>

</main>

	<?php
endwhile;
get_footer();
?>