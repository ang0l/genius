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
 * Регистрация области виджетов.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function geinuscourse_paginate($query)
{
	$big = 999999999; // Нереально большое число

	/// < Angol. Определяю на каком типе страницы нахожусь (сингл или архив)
	$paged = '';
	if (is_singular()) {
		$paged = get_query_var('page');
	} else {
		$paged = get_query_var('paged');
	}
	/// Angol >

	echo paginate_links(
		array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, $paged),
			'total' => $query->max_num_pages
		)
	);
}

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

	register_sidebar(
		array(
			'name'          => esc_html__('Car Pages Sidebar', 'geniuscourse'), /// Имя сайдбара
			'id'            => 'carsidebar', /// ID сайдбара. Должен быть уникальным
			'description'   => esc_html__('Appear as a Sidebar on Car Pages.', 'geniuscourse'), /// Описание сайдбара
			'before_widget' => '<section id="%1$s" class="widget %2$s">', /// Вывод HTML-тега до виджета
			'after_widget'  => '</section>', /// Вывод HTML-тега после виджета
			'before_title'  => '<h2 class="widget-title">', /// Открытие заголовка виджета
			'after_title'   => '</h2>', /// Закрытие заголовка виджета
		)
	);

	register_widget('geniuscourse_about_widget');
}
add_action('widgets_init', 'geniuscourse_widgets_init');

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

	add_image_size('car-cover', 240, 188);

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
	 * Применение форматов к Пост Тайпу
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
	if (!taxonomy_exists('brand')) { /// если не существует Таксономи brand
		$args = [
			'hierarchical' => false, /// Древовидная структура. У меня термы по бренду не поддерживают древовидньсть, поэтому false.
			'labels' => [ /// Все необходимое для перевода.
				'name'              => esc_html_x('Brands', 'taxonomy general name', 'geniuscourse'),
				'singular_name'     => esc_html_x('Brand', 'taxonomy singular name', 'geniuscourse'),
				'search_items'      => esc_html__('Search Brands', 'geniuscourse'),
				'all_items'         => esc_html__('All Brands', 'geniuscourse'),
				'parent_item'       => esc_html__('Parent Brand', 'geniuscourse'),
				'parent_item_colon' => esc_html__('Parent Brand:', 'geniuscourse'),
				'edit_item'         => esc_html__('Edit Brand', 'geniuscourse'),
				'update_item'       => esc_html__('Update Brand', 'geniuscourse'),
				'add_new_item'      => esc_html__('Add New Brand', 'geniuscourse'),
				'new_item_name'     => esc_html__('New Brand Name', 'geniuscourse'),
				'menu_name'         => esc_html__('Brand', 'geniuscourse'),
			],
			'show_ui' => true, /// Включение интерфейса Таксономи
			'rewrite' => ['slug' => 'brands'], /// слаг для Таксономи
			'query_var' => true, /// загружаем Таксономи по переменной запроса: ...?query_var=brands
			'show_in_rest' => true, /// Включение редактора Gutenberg
			'show_admin_column' => true, /// Включение колонки в список всех Термов
		];

		register_taxonomy('brand', ['car'], $args);
	}

	unset($args);

	$args = [
		'hierarchical' => true, /// Древовидная структура.
		'labels' => [ /// Все необходимое для перевода.
			'name'              => esc_html_x('Manufactures', 'taxonomy general name', 'geniuscourse'),
			'singular_name'     => esc_html_x('Manufacture', 'taxonomy singular name', 'geniuscourse'),
			'search_items'      => esc_html__('Search Manufactures', 'geniuscourse'),
			'all_items'         => esc_html__('All Manufactures', 'geniuscourse'),
			'parent_item'       => esc_html__('Parent Manufacture', 'geniuscourse'),
			'parent_item_colon' => esc_html__('Parent Manufacture:', 'geniuscourse'),
			'edit_item'         => esc_html__('Edit Manufacture', 'geniuscourse'),
			'update_item'       => esc_html__('Update Manufacture', 'geniuscourse'),
			'add_new_item'      => esc_html__('Add New Manufacture', 'geniuscourse'),
			'new_item_name'     => esc_html__('New Manufacture Name', 'geniuscourse'),
			'menu_name'         => esc_html__('Manufacture', 'geniuscourse'),
		],
		'show_ui' => true, /// Включение интерфейса Таксономи
		'rewrite' => ['slug' => 'manufactures'], /// слаг для Таксономи
		'query_var' => true, /// загружаем Таксономи по переменной запроса: ...?query_var=manufactures
		'show_in_rest' => true, /// Включение редактора Gutenberg
		'show_admin_column' => true, /// Включение колонки в список всех Термов
	];

	register_taxonomy('manufacture', ['car'], $args);
	unset($args);

	$args = [
		'label' => esc_html__('Car', 'geniuscourse'), /// Название Пост Тайпа
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
		'supports' => ['author', 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'post-formats',], /// Блоки, которые должны присутствовать в Пост Тайпе
		'public' => true, /// доступ к Пост Тайпу из фронт-части сайта
		'publicly_queryable' => true, /// доступ из фронта при обращении по ссылке
		'show_ui' => true, /// Включение интерфейса Пост Тайпа
		'show_in_menu' => true, /// ссылка в навигации Админки на Пост Тайп
		'has_archive' => true,
		'show_in_admin_bar' => false, /// Включение/отсключение меню Пост Тайпа в админском меню (сверху)
		'menu_position' => 100, /// Позиция размещения Пост Тайпа в навигации Админки
		'menu_icon' => 'dashicons-car', /// иконка. стиль иконки выбирается по ссылке ниже
		'rewrite' => ['slug' => 'cars'], /// слаг для Пост Тайпа
		'show_in_rest' => true, /// Включение редактора Gutenberg
	];

	register_post_type('car', $args);
}
add_action('init', 'geniuscourse_register_post_type');

function geniuscourse_rewrite_rules()
{
	geniuscourse_register_post_type();
	flush_rewrite_rules();
}

add_action('tgmpa_register', 'geniuscourse_register_required_plugins');

/**
 * Зарегистрируйте необходимые плагины для этой темы.
 *
 * В этом примере мы регистрируем пять плагинов:
 * - один из них входит в состав библиотеки TGMPA
 * - два из внешнего источника, один из произвольного источника, один из репозитория GitHub
 * - два из репозитория .org, где один демонстрирует использование аргумента `is_callable`
 *
 * Переменные, передаваемые в функцию `tgmpa()`, должны быть:
 * - массив плагина;
 * - опционально конфигурационный массив.
 * Если вы ничего не меняете в массиве конфигурации, вы можете удалить массив и удалить
 * переменную из вызова функции: `tgmpa( $plugins );`.
 * В этом случае будут использованы настройки TGMPA по умолчанию.
 *
 * Эта функция подключена к `tgmpa_register`, которая запускается при выполнении действия WP `init` с приоритетом 10.
 */
function geniuscourse_register_required_plugins()
{
	/*
	 * Массив плагина. Обязательными ключами являются name и slug.
	 */
	$plugins = array(

		// Это пример того, как включить плагин в комплекте с темой.
		array(
			'name'               => 'Genius Course Core Plugin', // Имя плагина.
			'slug'               => 'geniuscourse-core', // Модуль плагина (обычно это имя папки).

			/// < Angol. Устанавливаю путь к источнику плагина
			// 'source'             => get_template_directory() . '/lib/plugins/tgm-example-plugin.zip', // Источник плагина.
			'source'             => get_template_directory() . '/plugins/geniuscourse-core.zip', // Источник плагина.
			/// Angol>

			'required'           => true, // Если значение равно false, то плагин является только "рекомендуемым", а не обязательным.

			/// < Angol. Устанавливаю версию
			// 'version'            => '', // Например, 1.0.0. Если этот параметр установлен, активный плагин должен быть этой версии или выше. Если версия плагина выше, чем версия установленного плагина, пользователь получит уведомление о необходимости обновления плагина.
			'version'            => '1.0.0.0', // Например, 1.0.0. Если этот параметр установлен, активный плагин должен быть этой версии или выше. Если версия плагина выше, чем версия установленного плагина, пользователь получит уведомление о необходимости обновления плагина.
			/// Angol >

			'force_activation'   => false, // Если это значение равно true, то плагин активируется при активации темы и не может быть деактивирован до переключения темы.
			'force_deactivation' => false, // Если значение true, плагин деактивируется при переключении темы, что полезно для плагинов, зависящих от конкретной темы.

			/// < Angol. Удаляю незаданные значения
			// 'external_url'       => '', // Если задано, переопределяет URL API по умолчанию и указывает на внешний URL.
			// 'is_callable'        => '', // Если задан, этот вызываемый параметр будет проверяться на доступность, чтобы определить, активен ли плагин.
			/// Angol >
		),

		/// < Agnol. Подключаться с внешнего источника не буду, поэтому удаляю этот массив.
		// // Это пример того, как включить плагин из внешнего источника в вашу тему.
		// array(
		// 	'name'         => 'TGM New Media Plugin', // Имя плагина.
		// 	'slug'         => 'tgm-new-media-plugin', // Модуль плагина (обычно это имя папки).
		// 	'source'       => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // Источник плагина.
		// 	'required'     => true, // Если значение false, то плагин является только "рекомендуемым", а не обязательным.
		// 	'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // Если задано, переопределяет URL API по умолчанию и указывает на внешний URL.
		// ),
		/// Angol >

		/// < Agnol. Подключаться с Github не буду, поэтому удаляю этот массив.
		// // Это пример того, как включить плагин из репозитория GitHub в вашу тему.
		// // Это предполагает, что код плагина находится в корневом каталоге репозитория GitHub,
		// // а не в подкаталоге ('/src') репозитория.
		// array(
		// 	'name'      => 'Adminbar Link Comments to Pending',
		// 	'slug'      => 'adminbar-link-comments-to-pending',
		// 	'source'    => 'https://github.com/jrfnl/WP-adminbar-comments-to-pending/archive/master.zip',
		// ),
		/// Angol >

		// Включение плагина из репозитория WordPress.
		array(
			/// < Angol. Настраиваю плагин WordPress
			// 'name'      => 'BuddyPress',
			// 'slug'      => 'buddypress',
			// 'required'  => false,
			'name'      => 'Advanced Custom Fields', /// Имя взято из репозитория WordPress
			'slug'      => 'advanced-custom-fields', /// Слаг взят из ссылки к репозиторию WordPress
			'required'  => true, /// Мне нужны мета-боксы, а этот плагин работает с мета-боксами, значит он обязателен
		),

		// Включение плагина из репозитория WordPress.
		array(
			'name'      => 'Redux Framework', /// Имя взято из репозитория WordPress
			'slug'      => 'redux-framework', /// Слаг взят из ссылки к репозиторию WordPress
			'required'  => true, /// Мне нужны мета-боксы, а этот плагин работает с мета-боксами, значит он обязателен
		),

		/// < Angol. От автора курса - не нужный массив
		// // Это пример использования функциональности 'is_callable'. Например, у пользователя
		// // может быть установлен WPSEO *или* WPSEO Premium. В последнем случае slug будет другим, т.е.
		// // 'wordpress-seo-premium'.
		// // Установив 'is_callable' либо для функции из этого плагина, либо для метода класса
		// // `array( 'class', 'method' )` аналогично тому, как вы подключаетесь к action и filter, TGMPA все равно
		// // может распознать установленный плагин.
		// array(
		// 	'name'        => 'WordPress SEO by Yoast',
		// 	'slug'        => 'wordpress-seo',
		// 	'is_callable' => 'wpseo_init',
		// ),
		/// Angol >

	);

	/// < Agnol. Этот массив с настройками автор курса рекомендует не менять.
	/*
	 * Массив параметров конфигурации. Измените каждую строку по мере необходимости.
	 *
	 * TGMPA скоро начнет предоставлять локализованные текстовые строки. Если у вас уже есть доступные переводы наших стандартных
	 * строк, пожалуйста, помогите нам сделать TGMPA еще лучше, предоставив нам доступ к этим переводам или
	 * отправив запрос на обновление с помощью po-файлов с переводами.
	 *
	 * Раскомментируйте строки в массиве config только в том случае, если вы хотите их настроить.
	 */
	$config = array(
		'id'           => 'geniuscourse',          // Уникальный ID для хэширования уведомлений для нескольких экземпляров TGMPA.
		'default_path' => '',                      // Абсолютный путь к подключаемым плагинам по умолчанию.
		'menu'         => 'tgmpa-install-plugins', // Слаг меню.
		'has_notices'  => true,                    // Показывать уведомления администратора или нет.
		'dismissable'  => true,                    // Если значение равно false, пользователь не может отклонить придирчивое сообщение.
		'dismiss_msg'  => '',                      // Если значение 'dismissable' равно false, то это сообщение будет выведено в верхней части nag.
		'is_automatic' => false,                   // Автоматически активировать плагины после установки или нет.
		'message'      => '',                      // Сообщение для вывода непосредственно перед таблицей плагинов.

	);
	/// Angol >

	tgmpa($plugins, $config);
}

/**
 * Подключение персонального виджета.
 */
require get_template_directory() . '/inc/widget-about.php';

/**
 * Подключение мета-боксов.
 */
require get_template_directory() . '/inc/metaboxes.php';

/**
 * Подключение класса TGM_Plugin_Activation.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';















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
