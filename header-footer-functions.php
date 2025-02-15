<?php
function custom_hello_elementor_display_header_footer() {
    $header_type = get_query_var('header_type', '');
    
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
        if ( hello_elementor_display_header_footer() ) {
            if ( did_action( 'elementor/loaded' ) && hello_header_footer_experiment_active() ) {
                if ($header_type == '2') {
                    get_template_part( 'template-parts/dynamic-header-2' );
                } elseif ($header_type == '3') {
                    get_template_part( 'template-parts/dynamic-header-3' );
                } else {
                    get_template_part( 'template-parts/dynamic-header' );
                }
            } else {
                get_template_part( 'template-parts/header' );
            }
        }
    }
}