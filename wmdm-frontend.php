
<?php function print_frontend($options){ ?>
    <?php var_dump($options); ?>

    <div class="container visible-xs header-mobile">

    <div class="row depth-1 nav-bar">
        <div class="col-xs-6">
            <i class="icon-menu"><span class="menu-word">Menu</span></i>
        </div>
        <div class="col-xs-6" style="text-align:right;">
            <a href="<?php echo esc_url( home_url( '/' ) )?>" title="<?php bloginfo('name'); ?>" class="mobile-go-home">
                <img src="<?php echo esc_attr( $options['logo_image'] ); ?>" alt="<?php bloginfo('name'); ?>" id="mobile-header-logo">
            </a>
        </div>
    </div>

    <?php if( is_home() ) : ?>
        <div class="q-action-wrapper row">
            <?php $counter = 1; ?>
            <?php while($counter<4) : ?>
                <div class="col-xs-4 q-action">
                    <div>
                        <a href="<?php echo esc_attr( $options['box_'.$counter.'_link'] ); ?>">
                            <i class="<?php echo esc_attr( $options['box_'.$counter.'_class'] ); ?>"></i>
                            <span><?php echo esc_attr( $options['box_'.$counter.'_label'] ); ?></span>
                        </a>
                    </div>
                </div>

                <?php $counter++; endwhile; ?>
        </div>
    <?php endif; ?>
</div>

<div class="container-fluid visible-sm visible-md depth-1 header-mobile tablet" >
    <div class="row" style="padding:10px 0">
        <div class="col-sm-6">
            <i class="icon-bs icon-menu"><span class="menu-word">Menu</span></i>
        </div>
        <div class="col-sm-6">
            <?php if( $options['tablet-right-place'] == 'logo') : ?>
                <a href="<?php echo esc_url( home_url( '/' ) )?>" title="<?php bloginfo('name'); ?>" class="mobile-go-home">
                    <img src="<?php echo esc_attr( get_option('logo_path') ); ?>" alt="<?php bloginfo('name'); ?>" id="mobile-header-logo">
                </a>
            <?php elseif( $options['tablet-right-place'] == 'search') : ?>
                <form role="search" method="get" id="searchform" class="searchform push-right tablet" action="http://beta.bstczew.com/">
                    <input type="text" value="" name="s" id="s" placeholder="szukaj"><i class="md icon-search"></i>
                </form>
            <?php else: ?>
                <a href="http://beta.bstczew.com/strefa-logowania/" class="login-btn" style="float:right">
                    <i class="icon-bs icon-lock"><span>Logowanie</span></i>
                </a>
            <?php endif; ?>
        </div>
    </div>

</div>


<div class="col-xs-10 col-sm-5 mobile-menu-toggle hidden-lg">
    <div class="row toggle-header">
        <div class="col-xs-9 q-bar">
            <?php if( $options['unfolded_1'] == 'phone') : ?>
                <a href="<?php echo $options['login_phone']; ?>"><i class="icon-phone"></i>Skontaktuj się</a>
            <?php elseif( $options['unfolded_1'] == 'find') : ?>
                <form role="search" method="get" id="searchform" class="searchform" action="http://beta.bstczew.com/">
                    <input type="text" value="" name="s" id="s" placeholder="szukaj"><i class="icon-bs icon-search_bs"></i>
                </form>
            <?php else : ?>
                <a href="<?php echo $options['login_link']; ?>"><i class="icon-lock"></i>Logowanie</a>
            <?php endif; ?>
        </div>
        <div class="col-xs-3 close-menu">
            <i class="icon-close"></i>
        </div>
    </div>
    <div class="row visible-xs menu-wrapper">
        <?php wp_nav_menu( array( 'theme_location' => 'mobile-menu-material' ) ); ?>
    </div>
    <div class="row visible-sm visible-md menu-wrapper">
        <?php wp_nav_menu( array( 'theme_location' => 'tablet-menu-material' ) ); ?>
    </div>
</div>
<?php } ?>