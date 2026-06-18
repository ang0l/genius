<?php

/**
 * Plugin Name: Geniuscourse Core
 * Plugin URI: https://github.com/ang0l/genius
 * Description: A plugin that impliments Geniuscourses Functionality
 * Version: 1.0.0.0
 * Requires at least: 5.8
 * Requires PHP: 7.2
 * Author: Angol
 * Author URI: ang0l@mail.ru
 * License: GPLv2 or later
 * Text Domain: geniuscourse-core
 */

// Если обращение не со стороны WordPress значит обращение не из доверенного места - Выход 
if (! function_exists('add_action')) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

/**
 * Подключение персонального виджета.
 */
require plugin_dir_path(__FILE__) . '/inc/widget-about.php';

/**
 * Подключение мета-боксов.
 */
require plugin_dir_path(__FILE__) . '/inc/metaboxes.php';

/**
 * Подключение файла _acf.php_ (плагин Advanced Custom Fields).
 */
require_once plugin_dir_path(__FILE__) . '/inc/acf.php';

/**
 * Подключение файла _custom-post-type.php_ 
 */
require_once plugin_dir_path(__FILE__) . '/inc/custom-post-type.php';
