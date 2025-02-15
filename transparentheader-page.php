<?php
/**
 * Template Name: Transparent Header Page
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
    <div class="container-fluid p-0">
        <div class="w-100 p-0 m-0 position-absolute z-3">
            <?php get_header(); ?>
        </div>
        <div class="m-0">
            <div class="row">
                <div class="col-12">
                    <?php
                    the_content();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
endwhile;
get_footer();
?>