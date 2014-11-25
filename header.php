<div class="container-fluid mobile-menu">
    <div class="row">
        <div class="container">
            <i class="icon icon-menu"></i>

            <a href="<?php echo esc_url( home_url( '/' ) )?>" title="[you-title]" class="mobile-go-home">
                <img src="<?php echo get_template_directory_uri(); ?>/imgs/logo.svg" alt="" id="mobile-header-logo"> 
            </a>
        </div>
    </div>

    <div class="col-xs-10 col-sm-5 mobile-menu-toggle">
        <div class="row">
            <div class="col-xs-9 phone-contact">
                <i class="icon icon-ico_phone"></i><span>Call Us</span>
            </div>
            <div class="col-xs-3 close-menu">
                <i class="icon icon-close2"></i>
            </div>
        </div>
        <div class="row">
            <?php wp_nav_menu( array( 'theme_location' => 'mobile-header-menu' ) ); ?>
        </div>
    </div>
</div>


<header class="desktop-menu">
    <div class="row">
        <div class="col-sm-3">
            <a href="<?php echo esc_url( home_url( '/' ) )?>" title="[you-title]">
                <img src="<?php echo get_template_directory_uri(); ?>/imgs/logo.svg" alt="" id="header-logo"> 
            </a>
        </div>
        <div class="col-sm-9 menu">
            <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
        </div>
    </div>
</header>