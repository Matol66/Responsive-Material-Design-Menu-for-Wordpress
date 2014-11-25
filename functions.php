<?php
 function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'mobile-header-menu' => __( 'Mobile Menu' ),
    )
  );
}
add_action( 'init', 'register_my_menus' );
?>