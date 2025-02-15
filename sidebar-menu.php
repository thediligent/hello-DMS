<nav id="sidebar-menu" class="sidebar-nav">
    <?php
    wp_nav_menu(array(
        'theme_location' => 'sidebar-menu',
        'container' => false,
        'menu_class' => 'sidebar-menu',
        'walker' => new Sidebar_Nav_Walker()
    ));
    ?>
</nav>