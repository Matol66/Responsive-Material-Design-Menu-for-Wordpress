<?php
/*
Plugin Name: WordPress Material Design Menu
Description: Displays Menu - Tablet / Mobile - Bootstrap based
Version: 0.1
*/
?>

<?php

include_once('wmdm-settings.php');


function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


function register_material_menus() {
    register_nav_menu('tablet-menu-material',__( 'Tablet Material Menu' ));
    register_nav_menu('mobile-menu-material',__( 'Mobile Material Menu' ));
}
add_action( 'init', 'register_material_menus' );

function enqueue_libs(){
    wp_enqueue_style( 'bootstrap-base', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css' );
    wp_enqueue_style( 'icofont-base', plugin_dir_url(__FILE__).'style.css' );
    wp_enqueue_style( 'plugin-base', plugin_dir_url(__FILE__).'styles/styles.css' );

    wp_enqueue_script( 'jQuery', 'http://code.jquery.com/jquery-2.1.4.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'velocity', 'https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'plugin-base', plugin_dir_url(__FILE__).'js/wmdm.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_libs' );

function display_menu(){ ?>

    <div class="container visible-xs header-mobile">

        <div class="row depth-1 nav-bar">
            <div class="col-xs-6">
                <i class="icon-menu"><span class="menu-word">Menu</span></i>
            </div>
            <div class="col-xs-6" style="text-align:right;">
                <a href="<?php echo esc_url( home_url( '/' ) )?>" title="<?php bloginfo('name'); ?>" class="mobile-go-home">
                    <img src="<?php echo esc_attr( get_option('logo_path') ); ?>" alt="<?php bloginfo('name'); ?>" id="mobile-header-logo">
                </a>
            </div>
        </div>

        <?php if( is_home() ) : ?>
            <div class="q-action-wrapper row">
            <?php $counter = 1; ?>
            <?php while($counter<4) : ?>
                <div class="col-xs-4 q-action">
                    <div>
                        <a href="<?php echo esc_attr( get_option('link'.$counter) ); ?>">
                            <i class="icon-<?php echo esc_attr( get_option('ico'.$counter) ); ?>"></i>
                            <span><?php echo esc_attr( get_option('label'.$counter) ); ?></span>
                        </a>
                    </div>
                </div>

            <?php $counter++; endwhile; ?>
            </div>
        <?php endif; ?>

        <div class="col-xs-10 col-sm-5 mobile-menu-toggle">
            <div class="row toggle-header">
                <div class="col-xs-9 phone-contact">
                    <?php if(get_option('headtype')['radio1'] == 'find') : ?>
                        <form role="search" method="get" id="searchform" class="searchform" action="http://beta.bstczew.com/">
                            <input type="text" value="" name="s" id="s" placeholder="szukaj..."><i class="icon-bs icon-search_bs"></i>
                        </form>
                    <?php else : ?>
                        LOOGOWNAIE
                    <?php endif; ?>
                </div>
                <div class="col-xs-3 close-menu">
                    <i class="icon-close"></i>
                </div>
            </div>
            <div class="row menu-wrapper">
                <?php wp_nav_menu( array( 'theme_location' => 'mobile-menu-material' ) ); ?>
            </div>
        </div>
    </div>

    <div class="container-fluid visible-sm visible-md depth-1 header-mobile tablet" >
        <div class="row" style="padding:10px 0">
            <div class="col-sm-6">
                <i class="icon-bs icon-menu"><span class="menu-word">Menu</span></i>
            </div>
            <div class="col-sm-6">
                <?php if(get_option('tablet-right')['radio2'] == 'logo') : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) )?>" title="<?php bloginfo('name'); ?>" class="mobile-go-home">
                        <img src="<?php echo esc_attr( get_option('logo_path') ); ?>" alt="<?php bloginfo('name'); ?>" id="mobile-header-logo">
                    </a>
                <?php else: ?>
                    <a href="http://beta.bstczew.com/strefa-logowania/" class="login-btn" style="float:right">
                        <i class="icon-bs icon-lock"><span>&nbsp;&nbsp;&nbsp;Logowanie</span></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-xs-10 col-sm-5 mobile-menu-toggle">
            <div class="row toggle-header">
                <div class="col-xs-9 phone-contact">
                    <?php if(get_option('headtype')['radio1'] == 'find') : ?>
                    <form role="search" method="get" id="searchform" class="searchform" action="http://beta.bstczew.com/">
                        <input type="text" value="" name="s" id="s" placeholder="szukaj"><i class="icon-bs icon-search_bs"></i>
                        <!--<input type="submit" id="searchsubmit" value="Szukaj">-->
                    </form>
                    <?php else : ?>
                        <i class="icon-lock"></i>Logowanie
                    <?php endif; ?>
                </div>
                <div class="col-xs-3 close-menu">
                    <i class="icon-bs icon-close"></i>
                </div>
            </div>
            <div class="row">
                <?php wp_nav_menu( array( 'theme_location' => 'tablet-menu-material' ) ); ?>
            </div>
        </div>
    </div>

<?php }
add_action('wp_head','display_menu');

