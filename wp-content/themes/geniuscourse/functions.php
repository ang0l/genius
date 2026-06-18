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

/**
 * Подключение класса TGM_Plugin_Activation.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

/**
 * Подключение файла redux-options.php_ (плагин Redux).
 */
require_once get_template_directory() . '/inc/redux-options.php';

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

	/**
	 * Добавление по умолчанию в посты и комментарии RSS-ссылки в заголовок.
	 */
	add_theme_support('automatic-feed-links');

	/*
	 * Добавление тега `<title>` в заголовок документа
	 */
	add_theme_support('title-tag');
}
add_action('after_setup_theme', 'geniuscourse_theme_init', 0);

function geniuscourse_rewrite_rules()
{
	geniuscourse_register_post_type();
	flush_rewrite_rules();
}

add_action('tgmpa_register', 'geniuscourse_register_required_plugins');

function geniuscourse_register_required_plugins()
{
	/*
	 * Массив плагина. Обязательными ключами являются name и slug.
	 */
	$plugins = array(

		array(
			'name'               => 'Genius Course Core Plugin', // Имя плагина.
			'slug'               => 'geniuscourse-core', // Модуль плагина (обычно это имя папки).

			'source'             => get_template_directory() . '/plugins/geniuscourse-core.zip', // Источник плагина.

			'required'           => true, // Если значение равно false, то плагин является только "рекомендуемым", а не обязательным.
			'version'            => '1.0.0.0', // Например, 1.0.0. Если этот параметр установлен, активный плагин должен быть этой версии или выше. Если версия плагина выше, чем версия установленного плагина, пользователь получит уведомление о необходимости обновления плагина.

			'force_activation'   => false, // Если это значение равно true, то плагин активируется при активации темы и не может быть деактивирован до переключения темы.
			'force_deactivation' => false, // Если значение true, плагин деактивируется при переключении темы, что полезно для плагинов, зависящих от конкретной темы.
		),

		array(
			'name'      => 'Advanced Custom Fields', /// Имя взято из репозитория WordPress
			'slug'      => 'advanced-custom-fields', /// Слаг взят из ссылки к репозиторию WordPress
			'required'  => true, /// Мне нужны мета-боксы, а этот плагин работает с мета-боксами, значит он обязателен
		),

		array(
			'name'      => 'Redux Framework', /// Имя взято из репозитория WordPress
			'slug'      => 'redux-framework', /// Слаг взят из ссылки к репозиторию WordPress
			'required'  => true, /// Мне нужны мета-боксы, а этот плагин работает с мета-боксами, значит он обязателен
		),
	);

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

	tgmpa($plugins, $config);
}

/**
 * Установите ширину содержимого в пикселях в зависимости от дизайна темы и таблицы стилей.
 * Приоритет 0, чтобы сделать его доступным для обратных вызовов с более низким приоритетом.
 * @global int $content_width
 */
function geniuscourse_content_width()
{
	$GLOBALS['content_width'] = apply_filters('geniuscourse_content_width', 640);
}
add_action('after_setup_theme', 'geniuscourse_content_width', 0);
