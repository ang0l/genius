<?php

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
