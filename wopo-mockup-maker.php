<?php
/**
 * Plugin Name:       WoPo Mockup Maker
 * Plugin URI:        https://wopoweb.com/contact-us/
 * Description:       Easy way to create device mockups on your site
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            WoPo Web
 * Author URI:        https://wopoweb.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wopo-web-torrent
 * Domain Path:       /languages
 */

add_shortcode('wopo-mockup-maker', 'wopomm_shortcode');
function wopomm_shortcode( $atts = [], $content = null) {
    wp_enqueue_style('wopo-mockup-maker',plugin_dir_url(__FILE__)."/assets/css/device-mockups.min.css");
    wp_add_inline_style('wopo-mockup-maker',"
        .device .button {
            background: transparent !important;
            border: none;        
        }
        .device .screen{
            overflow: hidden;
        }
    ");

    $atts = array_change_key_case((array) $atts, CASE_LOWER);
    $atts = shortcode_atts(array(
        "device" => "iPhone5",
        "orientation" => "portrait",
        "color" => "black"
    ),$atts);

    ob_start();
    ?>
    <div class="device-wrapper">
        <div class="device" data-device="<?php esc_attr_e($atts['device']) ?>" data-orientation="<?php esc_attr_e($atts['orientation']) ?>" data-color="<?php esc_attr_e($atts['color']) ?>">
            <div class="screen">
            <?php echo do_shortcode($content) ?>
            <div class="button">
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}