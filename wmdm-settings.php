<?php
/**
 * Created by PhpStorm.
 * User: DDS
 * Date: 2015-05-07
 * Time: 13:00
 */


add_action('admin_menu', 'my_plugin_menu');
function my_plugin_menu() {
    add_menu_page('Material Design Menu Settings', 'Material Design Menu', 'administrator', 'wmdm-settings', 'wmdm_settings_page', 'dashicons-art');
}
function wmdm_settings_page() { ?>

    <div class="wrap">




        <h2>Ustawienia Menu</h2>
        <form method="post" action="options.php">
            <h3>Ikony</h3>
            <hr/>
            <?php settings_fields( 'wmdm-settings-group' ); ?>
            <?php do_settings_sections( 'wmdm-settings-group' ); ?>
            <?php $wmdm_options = get_option('headtype'); ?>
            <?php $wmdm_options_2 = get_option('tablet-right'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Ikona</th>
                    <td><input type="text" name="ico1" value="<?php echo esc_attr( get_option('ico1') ); ?>" /></td>

                    <th scope="row">Link</th>
                    <td><input type="text" name="link1" value="<?php echo esc_attr( get_option('link1') ); ?>" /></td>

                    <th scope="row">Podpis</th>
                    <td><input type="text" name="label1" value="<?php echo esc_attr( get_option('label1') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Ikona</th>
                    <td><input type="text" name="ico2" value="<?php echo esc_attr( get_option('ico2') ); ?>" /></td>

                    <th scope="row">Link</th>
                    <td><input type="text" name="link2" value="<?php echo esc_attr( get_option('link2') ); ?>" /></td>

                    <th scope="row">Podpis</th>
                    <td><input type="text" name="label2" value="<?php echo esc_attr( get_option('label2') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Ikona</th>
                    <td><input type="text" name="ico3" value="<?php echo esc_attr( get_option('ico3') ); ?>" /></td>

                    <th scope="row">Link</th>
                    <td><input type="text" name="link3" value="<?php echo esc_attr( get_option('link3') ); ?>" /></td>

                    <th scope="row">Podpis</th>
                    <td><input type="text" name="label3" value="<?php echo esc_attr( get_option('label3') ); ?>" /></td>
                </tr>
            </table>
            <h3>Po rozwinięciu</h3>
            <hr/>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Po rozwinięciu</th>
                    <td>
                        <input type="radio" name="headtype[radio1]" value="find" <?php checked('find', $wmdm_options['radio1']); ?>/>Wyszukiwarka<br>
                        <input type="radio" name="headtype[radio1]" value="login" <?php checked('login', $wmdm_options['radio1']); ?>/>Link do logowania
                    </td>
                </tr>
            </table>
            <h3>Logo & Link</h3>
            <hr/>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Pełna ścieżka do pliku z Logo</th>
                    <td>
                        <input type="text" name="logo_path" value="<?php echo esc_attr( get_option('logo_path') ); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Pełna strony</th>
                    <td>
                        <input type="text" name="login_path" value="<?php echo esc_attr( get_option('login_path') ); ?>" />
                    </td>
                </tr>
            </table>
            <h3>Material Menu - Tablet</h3>
            <hr/>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Prawa strona paska</th>
                    <td>
                        <input type="radio" name="tablet-right[radio2]" value="logo" <?php checked('logo', $wmdm_options_2['radio2']); ?>/>Logo<br>
                        <input type="radio" name="tablet-right[radio2]" value="login" <?php checked('login', $wmdm_options_2['radio2']); ?>/>Link do logowania
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>

        </form>
<!--        <pre>-->
<!--            --><?php //var_dump($wmdm_options); ?>
<!--        </pre>-->
    </div>

<?php
}

add_action( 'admin_init', 'wmdm_settings' );
function wmdm_settings() {
    register_setting( 'wmdm-settings-group', 'ico1' );
    register_setting( 'wmdm-settings-group', 'ico2' );
    register_setting( 'wmdm-settings-group', 'ico3' );
    register_setting( 'wmdm-settings-group', 'link1' );
    register_setting( 'wmdm-settings-group', 'link2' );
    register_setting( 'wmdm-settings-group', 'link3' );
    register_setting( 'wmdm-settings-group', 'label1' );
    register_setting( 'wmdm-settings-group', 'label2' );
    register_setting( 'wmdm-settings-group', 'label3' );
    register_setting( 'wmdm-settings-group', 'headtype' );
    register_setting( 'wmdm-settings-group', 'tablet-right' );
    register_setting( 'wmdm-settings-group', 'logo_path' );
    register_setting( 'wmdm-settings-group', 'login_path' );
}