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
	load_theme_textdomain('geniuscourse', get_template_directory() . '/languages');

	/**
	 * Поддержка thumbnails
	 */
	add_theme_support('post-thumbnails');

	/**
	 * Поддержка пост-формата
	 */
	add_theme_support('post-formats', [
		'video',
		'image',
		'quote',
		'gallery',
	]);

	/**
	 * Применение форматов к пост тайпу
	 */
	add_post_type_support('Car', 'post-formats');
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

function geniuscourse_register_post_type()
{

	$args = [
		'label' => esc_html__('Car', 'geniuscourse'), /// Название пост тайпа
		'labels' => [ /// Название элементов дизайна (?)
			'name'                  => esc_html_x('Cars', 'Post type general name', 'geniuscourse'),
			'singular_name'         => esc_html_x('Car', 'Post type singular name', 'geniuscourse'),
			'menu_name'             => esc_html_x('Cars', 'Admin Menu text', 'geniuscourse'),
			'name_admin_bar'        => esc_html_x('Car', 'Add New on Toolbar', 'geniuscourse'),
			'add_new'               => esc_html__('Add New', 'geniuscourse'),
			'add_new_item'          => esc_html__('Add New Car', 'geniuscourse'),
			'new_item'              => esc_html__('New Car', 'geniuscourse'),
			'edit_item'             => esc_html__('Edit Car', 'geniuscourse'),
			'view_item'             => esc_html__('View Car', 'geniuscourse'),
			'all_items'             => esc_html__('All Cars', 'geniuscourse'),
			'search_items'          => esc_html__('Search Cars', 'geniuscourse'),
			'parent_item_colon'     => esc_html__('Parent Cars:', 'geniuscourse'),
			'not_found'             => esc_html__('No Cars found.', 'geniuscourse'),
			'not_found_in_trash'    => esc_html__('No Cars found in Trash.', 'geniuscourse'),
			'featured_image'        => esc_html_x('Car Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'geniuscourse'),
			'set_featured_image'    => esc_html_x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'geniuscourse'),
			'remove_featured_image' => esc_html_x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'geniuscourse'),
			'use_featured_image'    => esc_html_x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'geniuscourse'),
			'archives'              => esc_html_x('Car archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'geniuscourse'),
			'insert_into_item'      => esc_html_x('Insert into Car', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'geniuscourse'),
			'uploaded_to_this_item' => esc_html_x('Uploaded to this Car', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'geniuscourse'),
			'filter_items_list'     => esc_html_x('Filter Cars list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'geniuscourse'),
			'items_list_navigation' => esc_html_x('Cars list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'geniuscourse'),
			'items_list'            => esc_html_x('Cars list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'geniuscourse'),

		],
		'supports' => ['author', 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'post-formats',], /// Блоки, которые должны присутствовать в пост тайпе
		'public' => true, /// доступ к пост тайпу из фронт-части сайта
		'publicly_queryable' => true, /// доступ из фронта при обращении по ссылке
		'show_ui' => true, /// Включение интерфейса пост тайпа
		'show_in_menu' => true, /// ссылка в навигации Админки на пост тайп
		'has_archive' => true,
		'show_in_admin_bar' => false, /// Включение/отсключение меню пост тайпа в админском меню (сверху)
		'menu_position' => 100, /// Позиция размещения пост тайпа в навигации Админки
		'menu_icon' => 'dashicons-car', /// иконка. стиль иконки выбирается по ссылке ниже
		'rewrite' => ['slug' => 'cars'],
		'show_in_rest' => true,
	];

	register_post_type('car', $args);
}
add_action('init', 'geniuscourse_register_post_type');

function geniuscourse_rewrite_rules()
{
	geniuscourse_register_post_type();
	flush_rewrite_rules();
}


















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
