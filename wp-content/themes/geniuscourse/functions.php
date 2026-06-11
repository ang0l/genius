<?php

/**
 * geniuscourse functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package geniuscourse
 */

/// Отсюда буду писать свой код

/**
 * Подключение стилей и скриптов
 */
function geinuscourse_enqueue_scripts()
{
	/// подключаю стили: параметры:
	/// 1 - тема, 2 - путь к файлу стилей, 3 - дополнительные параметры, 4 - версия, 5 - медиа (для всех)
	wp_enqueue_style('geniuscourse', get_template_directory_uri() . '/assets/css/general.css', [], '1.0.0.0', 'all');

	/// подключаю скрипты: параметры:
	/// 1 - тема, 2 - путь к файлу скриптов, 3 - дополнительные параметры (необходимость подгрузить jquery), 4 - версия, 5 - место подключения: true - подвал, false - шапка.
	wp_enqueue_script('geniuscourse', get_template_directory_uri() . '/assets/js/script.js', ['jquery'], '1.0.0.0', true);

	/// поключаю ответы на комментарий. переношу готовый код снизу из функции geniuscourse_scripts(), которую тоже удалил
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'geinuscourse_enqueue_scripts');

/**
 * Регистрация меню
 */
function geniuscourse_theme_init()
{

	register_nav_menus([
		'header_nav' => esc_html__('Header navigation', 'geniuscourse'),
		'footer_nav' => esc_html__('Footer navigation', 'geniuscourse'),
	]);

	/**
	 * Включает по поддержку HTML5 для форм, комментариев и пр.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	/**
	 * Поддержка мультиязычности
	 */
	load_theme_textdomain('geniuscourse', get_template_directory() . '/lang');
}
add_action('after_setup_theme', 'geniuscourse_theme_init', 0);

function geniuscourse_custom_search()
{

	$form = '<form method="get" action="' . home_url("/") . '">
    <input type="search" name="s" value="' . the_search_query() . '">
    <input type="submit">
	<input type="hidden" value="post" name="post_type"
</form>';

	return $form;
}
add_filter('get_search_form', 'geniuscourse_custom_search');















/// ниже код болванки, я его со временем удалю


if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function geniuscourse_setup()
{

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	/// < Angol. Удалил локацию меню Primary содзанную в болванке по умолчанию
	// // This theme uses wp_nav_menu() in one location.
	// register_nav_menus(
	// 	array(
	// 		'menu-1' => esc_html__('Primary', 'geniuscourse'),
	// 	)
	// );


	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'geniuscourse_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'geniuscourse_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function geniuscourse_content_width()
{
	$GLOBALS['content_width'] = apply_filters('geniuscourse_content_width', 640);
}
add_action('after_setup_theme', 'geniuscourse_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function geniuscourse_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'geniuscourse'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'geniuscourse'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'geniuscourse_widgets_init');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
