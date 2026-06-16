<?php

function geinuscourse_acf_metaboxes()
{

	acf_add_local_field_group([
		'key' => 'acf_carsettings', /// ID группы полей
		'title' => 'Car Settings For ACF from Code', /// Заголовок группы полей
		'fields' => [ /// поля [] в данном примере предоставлен минимальны набор ключей для создания поля
			/// Поле text:
			[
				'key' => 'custom_price', /// ID поля
				'label' => 'Car Price', /// Заголовок поля
				'name' => 'custom_price', /// Имя поля
				'type' => 'text', /// Тип поля
			],
			/// Поле select:
			[
				'key' => 'custom_engine_type', /// ID поля
				'label' => esc_html__('Car Engine Type', 'geniuscourse'), /// Заголовок поля
				'name' => 'custom_engine_type', /// Имя поля
				'type' => 'select', /// Тип поля
				'choices' => [ /// Options для Selecta. Ключ - name, Значение - значение.
					'manual' => esc_html__('Manual', 'geniuscourse'),
					'automatic' => esc_html__('Automatic', 'geniuscourse'),
				],
				'allow_null' => 1, /// Разрешаю использовать пустой Option типа "Выбрать"
			]
		],
		'location' => [ /// В какой локации показывать группу
			[
				[
					'param' => 'post_type', /// Делаю сравнение по Пост Тайпу
					'operator' => '==', /// Оператор "равно"
					'value' => 'car', /// Значение, по какому Пост Тайпу ищу
				]
			]
		],
		'menu_order' => 0, /// 0 - без сортировки по умолчанию. Ддля 2-х полей, то указывается первому 1, второму 2.
		'position' => 'normal', /// side |act_acter_title
		'style' => 'default', /// seamless
		'label_placement' => 'top', /// где будет задаваться поле // left
		'instruction_placement' => 'label', /// куда отображать инструкции // field
		'hode_one_screen' => [] /// параметр прячет оределенные окна в админке
	]);
}

add_action('acf/init', 'geinuscourse_acf_metaboxes');
