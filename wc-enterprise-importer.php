<?php
/**
 * Plugin Name: WooCommerce Enterprise Importer
 * Plugin URI: https://condixia.com
 * Author: Mahim Zaman (Condixia)
 * Author URI: https://mahimzaman.com
 * Description: Enterprise-grade WooCommerce bulk product importer.
 * Version: 1.0.0
 * Requires Plugins: woocommerce
 */

if (!defined('ABSPATH')) {
    exit;
}

define('WCEI_VERSION', '1.0.0');
define('WCEI_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('WCEI_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once WCEI_PLUGIN_PATH . 'includes/Core/Plugin.php';

\WCEI\Core\Plugin::instance();