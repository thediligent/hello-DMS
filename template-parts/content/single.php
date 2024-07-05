<?php

/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();

while (have_posts()) :
    the_post();
    if (has_post_thumbnail()) {
?>
        <div class="container-fluid p-0" style="background-size:cover;background-position:center center; background-image:url('<?php the_post_thumbnail_url('full'); ?>')">
            <div class="row py-4">
                <div class="col-12 py-4">
                    <div class="py-4"></div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="container content px-4 px-lg-auto pb-5">
        <div class="row">
            <div class="col-12">
                <?php
                the_content();
                ?>
            </div>
        </div>
    </div>

<?php
endwhile;
get_footer();
?>