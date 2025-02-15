<?php
class Sidebar_Nav_Walker extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="sidebar-nav sub-menu list-unstyled sidebar-dropdown collapse">';
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));

        $is_separator = in_array('menu-separator', $classes);
        $is_dropdown = in_array('menu-dropdown', $classes);

        if ($is_separator) {
            $output .= '<li class="menu-separator"><span>' . $item->title . '</span></li>';
        } elseif ($is_dropdown) {
            $output .= '<li class="sidebar-item ' . $class_names . '">';
            $output .= '<a href="#" class="nav-link dropdown-toggle" data-bs-target="" data-bs-toggle="collapse">' . $item->title . '</a>';
        } else {
            $output .= '<li class="' . $class_names . '">';
            $output .= '<a href="' . $item->url . '">' . $item->title . '</a>';
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}

?>