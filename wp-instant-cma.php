<?php
/**
 * The Redux Framework Plugin
 *
 * A simple, truly extensible and fully responsive options framework
 * for WordPress themes and plugins. Developed with WordPress coding
 * standards and PHP best practices in mind.
 *
 * Plugin Name:     WP InstantCMA
 * Plugin URI:      
 * Github URI:      
 * Description:     The plugin is for your property assessed for market price.
 * Author:          cwebconsultants
 * Author URI:      http://www.cwebconsultants.com/
 * Version:         3.5.9.8
 * Text Domain:     property_assessment
 * License:         GPL3+
 * License URI:     
 * Domain Path:     InstantCMA/languages
 * Provides:        InstantCMA
 *
 * @package         InstantCMA
 * @author          Dovy Paukstys <dovy@instantcma.com>
 * @author          Kevin Provance <kevin@instantcma.com>
 * @license         GNU General Public License, version 3
 * @copyright       2012-2016 cwebconsultants.com
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    die;
}
error_reporting(0);
//error_reporting(E_ALL ^ E_DEPRECATED);

// Require the main plugin class
require_once plugin_dir_path( __FILE__ ) . 'class.redux-plugin.php';
require plugin_dir_path( __FILE__ ) . 'public/short-codes.php';
require plugin_dir_path( __FILE__ ) . 'public/function/fucntions.php';


// Register hooks that are fired when the plugin is activated and deactivated, respectively.
register_activation_hook( __FILE__, array( 'ReduxFrameworkPlugin', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'ReduxFrameworkPlugin', 'deactivate' ) );

// Get plugin instance
//add_action( 'plugins_loaded', array( 'ReduxFrameworkPlugin', 'instance' ) );

// The above line prevents ReduxFramework from instancing until all plugins have loaded.
// While this does not matter for themes, any plugin using Redux will not load properly.
// Waiting until all plugins have been loaded prevents the ReduxFramework class from
// being created, and fails the !class_exists('ReduxFramework') check in the sample_config.php,
// and thus prevents any plugin using Redux from loading their config file.
ReduxFrameworkPlugin::instance();

define('PROP_PLUGIN_FS_PATH', plugin_dir_path(__FILE__));
define('PROP_PLUGIN_WS_PATH', plugin_dir_url(__FILE__));

require plugin_dir_path( __FILE__ ) . 'ReduxCore/custom_post.php';
?>
