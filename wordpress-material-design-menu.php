<?php
/*
Plugin Name: WordPress Material Design Menu
Description: Displays Menu - Tablet / Mobile - Bootstrap based. <hr><strong>IMPORTANT</strong> Libraries: Velocity(animations), jQuery(js handler), WMDM(plugin script) | Styles: Bootstrap(Grid), Icofont(Material Icons), WMDM(plugin menu styles)
Version: 0.9
*/
?>

<?php

class WMDM
{
    function __construct() {

        // Load text domain
//        add_action( 'init', array( $this, 'load_localisation' ), 0 );

        // Adding Plugin Menu
        add_action( 'admin_menu', array( &$this, 'wmdm_menu' ) );

        // Load our custom assets.
        add_action( 'admin_enqueue_scripts', array( &$this, 'wmdm_assets' ) );

        add_action( 'wp_head', array( &$this, 'enqueue_libs' ) );

        // Register Settings
        add_action( 'admin_init', array( &$this, 'wmdm_settings' ) );


        // Add Two Menus - Mobile & Tablet
        add_action( 'init', array( &$this, 'register_material_menus' ));

        //  Add Favicon to website frontend
        add_action( 'wp_head', array( &$this, 'print_on_frontend' ) );

        // Add Favicon to website backend
        //add_action( 'admin_head', array( &$this, 'dot_cfi_favicon_backend' ) );
//        add_action( 'login_head', array( &$this, 'dot_cfi_favicon_backend' ) );


    } // end constructor




    /*--------------------------------------------*
     * Admin Menu
     *--------------------------------------------*/

    function wmdm_menu()
    {
        $page_title = __('Material Design Menu', 'wmdm');
        $menu_title = __('Material Design Menu', 'wmdm');
        $capability = 'manage_options';
        $menu_slug = 'wmdm-options';
        $function = array(&$this, 'wmdm_menu_contents');
        add_options_page($page_title, $menu_title, $capability, $menu_slug, $function);

    }

    /*--------------------------------------------*
     * Load Necessary JavaScript Files
     *--------------------------------------------*/

    function wmdm_assets() {
        if (isset($_GET['page']) && $_GET['page'] == 'wmdm-options') {

            wp_enqueue_style( 'thickbox' ); // Stylesheet used by Thickbox
            wp_enqueue_script( 'thickbox' );
            wp_enqueue_script( 'media-upload' );

            wp_register_script('wmdm_admin', plugins_url( '/js/dot_cfi_admin.js' , __FILE__ ), array( 'thickbox', 'media-upload' ));
            wp_enqueue_script('wmdm_admin');

            wp_enqueue_style( 'plugin-admin', plugin_dir_url(__FILE__).'styles/admin-styles.css' );
        }

    }


    function enqueue_libs(){
        wp_enqueue_style( 'bootstrap-base', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css' );
        wp_enqueue_style( 'icofont-base', plugin_dir_url(__FILE__).'style.css' );
        wp_enqueue_style( 'plugin-base', plugin_dir_url(__FILE__).'styles/styles.css' );
        wp_enqueue_script( 'jQuery', 'http://code.jquery.com/jquery-2.1.4.min.js', array(), '1.0.0', true );
        wp_enqueue_script( 'velocity', 'https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js', array(), '1.0.0', true );
        wp_enqueue_script( 'plugin-base', plugin_dir_url(__FILE__).'js/wmdm.js', array(), '1.0.0', true );
    }



    /*--------------------------------------------*
     * Settings & Settings Page
     * dot_cfi_menu_contents
     *--------------------------------------------*/

    public function wmdm_menu_contents()
    {
        ?>
        <div class="wrap">
            <!--<div id="icon-freshdesk-32" class="icon32"><br></div>-->
            <div id="icon-options-general" class="icon32"><br></div>
            <h2><?php _e('Material Design Menu', 'wmdm'); ?></h2>

            <form method="post" action="options.php">
                <?php //wp_nonce_field('update-options'); ?>
                <?php settings_fields('wmdm_settings'); ?>
                <?php do_settings_sections('wmdm_settings'); ?>
                <p class="submit">
                    <input name="Submit" type="submit" class="button-primary"
                           value="<?php _e('Zapisz zmiany', 'wmdm'); ?>"/>
                </p>
            </form>
            <div class="helper">
                <?php echo '
                    <img src="'.plugins_url( '/sprite/class.png' , __FILE__ ).'" alt="" class="img-responsive"/>
                    <h3>Podgląd klas ikon:</h3> <a href="'.plugins_url( '/sprite/sprite.html' , __FILE__ ).'" target="_blank">zobacz podgląd</a>
                    <br><br><hr>
                    <img src="'.plugins_url( '/sprite/buttons.png' , __FILE__ ).'" alt="" class="img-responsive"/>
                    <h3>Pole <i>"link"</i></h3>
                    <p>
                    Linki powinny być zapisane w formacie:<br>
                    <h4><strong>http://</strong>link-do-strony.pl</h4>
                    Dodatkowe opcje to:<br>
                    <strong>mailto:</strong> adres@domena.pl<br>
                    <strong>tel:</strong> +48123456789 (z kierunkowym kraju)<br>
                    <strong>gps:</strong> 54.3610873,18.6900271
                    </p>
                '; ?>
            </div>
        </div>

    <?php
    }

    function wmdm_settings()
    {
        register_setting('wmdm_settings', 'wmdm_settings');
        add_settings_section('boxes', 'Trzy boksy wyświetlane na telefonach', array(&$this, 'section_boxes'), 'wmdm_settings');
        add_settings_section('unfolded', 'Ustawienia nagłówka menu po rozwinięciu', array(&$this, 'section_unfolded'), 'wmdm_settings');
        add_settings_section('logo_login', 'Ustawienia Logo / Panel logowania / Numer telefonu', array(&$this, 'section_logo_login'), 'wmdm_settings');
        add_settings_section('tablet_menu', 'Ustawienia menu na tablecie', array(&$this, 'section_tablet'), 'wmdm_settings');

//        add_settings_field('box_1_image', 'Logo', array( &$this, 'section_box_1_image' ), 'wmdm_settings', 'boxes');

        add_settings_field('box_1', 'Pierwsza Ikona', array( &$this, 'section_box_1' ), 'wmdm_settings', 'boxes');
        add_settings_field('box_2', 'Druga Ikona', array( &$this, 'section_box_2' ), 'wmdm_settings', 'boxes');
        add_settings_field('box_3', 'Trzecia Ikona', array( &$this, 'section_box_3' ), 'wmdm_settings', 'boxes');

        add_settings_field('unfold_1', 'Pojawi się: ', array( &$this, 'section_unfold_1' ), 'wmdm_settings', 'unfolded');

        add_settings_field('logo_login_1', 'Logo', array( &$this, 'section_logo_login_1' ), 'wmdm_settings', 'logo_login');

        add_settings_field('tablet_menu_1', 'Prawa strona paska menu na tablecie', array( &$this, 'section_tablet_menu' ), 'wmdm_settings', 'tablet_menu');

    }


    function  section_tablet_menu(){
        $options = get_option( 'wmdm_settings' );
        ?>
        <span class="radio">
            <label for="tablet_radio_1"><input type="radio" id="tablet_radio_1" name="wmdm_settings[tablet-right-place]" value="logo" <?php checked('logo', $options['tablet-right-place']); ?>/>Logo</label>
            <label for="tablet_radio_2"><input type="radio" id="tablet_radio_2" name="wmdm_settings[tablet-right-place]" value="login" <?php checked('login', $options['tablet-right-place']); ?>/>Link do logowania</label>
            <label for="tablet_radio_3"><input type="radio" id="tablet_radio_3" name="wmdm_settings[tablet-right-place]" value="search" <?php checked('search', $options['tablet-right-place']); ?>/>Wyszukiwarka</label>
        </span>
        <?php
    }

    function section_logo_login_1() {
        $options = get_option( 'wmdm_settings' );
        ?>

        <span class='upload'>
            <img src='<?php echo esc_url( $options["logo_image"] ); ?>' class='preview-upload' /></label>
            <label for="wmdm_settings[logo_image]"><input type='text' id='wmdm_settings[logo_image]' class='regular-text text-upload' name='wmdm_settings[logo_image]' value='<?php echo esc_url( $options["logo_image"] ); ?>'/>
                <input type='button' class='button button-upload' value='Wybierz logo'/></br>
        </span>
        <span class="text">
           <label for="wmdm_settings[login_link]">Link logowania <input type='text' id='wmdm_settings[login_link]' class='regular-text' name='wmdm_settings[login_link]' value='<?php echo esc_url($options["login_link"]); ?>'/></label><br>
           <label for="wmdm_settings[login_phone]">Numer telefonu <input type='text' id='wmdm_settings[login_phone]' class='regular-text' name='wmdm_settings[login_phone]' value='<?php echo $options["login_phone"]; ?>'/></label>
       </span>
    <?php
    }

    function section_box_1() {
        $options = get_option( 'wmdm_settings' );
        ?>

        <span class='text box'>
            <label for="wmdm_settings[box_1_class]">Klasa <input type='text' id='wmdm_settings[box_1_class]' class='regular-text' name='wmdm_settings[box_1_class]' value='<?php echo $options["box_1_class"]; ?>'/></label>
            <label for="wmdm_settings[box_1_label]">Opis <input type='text' id='wmdm_settings[box_1_label]' class='regular-text' name='wmdm_settings[box_1_label]' value='<?php echo $options["box_1_label"]; ?>'/></label>
            <label for="wmdm_settings[box_1_link]">Link <input type='text' id='wmdm_settings[box_1_link]' class='regular-text' name='wmdm_settings[box_1_link]' value='<?php echo $options["box_1_link"] ; ?>'/></label>
        </span>
    <?php
    }
    function section_box_2() {
        $options = get_option( 'wmdm_settings' );
        ?>
        <span class='text box'>
            <label for="wmdm_settings[box_2_class]">Klasa <input type='text' id='wmdm_settings[box_2_class]' class='regular-text' name='wmdm_settings[box_2_class]' value='<?php echo $options["box_2_class"]; ?>'/></label>
            <label for="wmdm_settings[box_2_label]">Opis <input type='text' id='wmdm_settings[box_2_label]' class='regular-text' name='wmdm_settings[box_2_label]' value='<?php echo $options["box_2_label"]; ?>'/></label>
            <label for="wmdm_settings[box_2_link]">Link <input type='text' id='wmdm_settings[box_2_link]' class='regular-text' name='wmdm_settings[box_2_link]' value='<?php echo  $options["box_2_link"]; ?>'/></label>
        </span>
    <?php
    }
    function section_box_3() {
        $options = get_option( 'wmdm_settings' );
        ?>
        <span class='text box'>
            <label for="wmdm_settings[box_3_class]">Klasa <input type='text' id='wmdm_settings[box_3_class]' class='regular-text' name='wmdm_settings[box_3_class]' value='<?php echo $options["box_3_class"]; ?>'/></label>
            <label for="wmdm_settings[box_3_label]">Opis <input type='text' id='wmdm_settings[box_3_label]' class='regular-text' name='wmdm_settings[box_3_label]' value='<?php echo $options["box_3_label"]; ?>'/></label>
            <label for="wmdm_settings[box_3_link]">Link <input type='text' id='wmdm_settings[box_3_link]' class='regular-text' name='wmdm_settings[box_3_link]' value='<?php echo  $options["box_3_link"] ; ?>'/></label>
        </span>
    <?php
    }
    function section_unfold_1() {
        $options = get_option( 'wmdm_settings' );
        ?>
        <span class='radio'>
            <label for="headtype_radio_1"><input type="radio" id="headtype_radio_1" name="wmdm_settings[unfolded_1]" value="find" <?php checked('find', $options['unfolded_1']); ?>/>Wyszukiwarka</label>
            <label for="headtype_radio_2"><input type="radio" id="headtype_radio_2" name="wmdm_settings[unfolded_1]" value="login" <?php checked('login', $options['unfolded_1']); ?>/>Link do logowania</label>
            <label for="headtype_radio_3"><input type="radio" id="headtype_radio_3" name="wmdm_settings[unfolded_1]" value="phone" <?php checked('phone', $options['unfolded_1']); ?>/>Skontaktuj się z nami</label>
        </span>
    <?php
    }








    function register_material_menus() {
        register_nav_menu('tablet-menu-material',__( 'Tablet Material Menu' ));
        register_nav_menu('mobile-menu-material',__( 'Mobile Material Menu' ));
    }


    function section_boxes() 	{
        $options = get_option( 'wmdm_settings' );
//        var_dump($options);

    }

    function section_unfolded(){}
    function section_logo_login(){}
    function section_tablet(){}

    function print_on_frontend(){
        $options = get_option('wmdm_settings');
        include_once 'wmdm-frontend.php';
        print_frontend($options);
    }

}
$wmdm = new WMDM(__FILE__);
