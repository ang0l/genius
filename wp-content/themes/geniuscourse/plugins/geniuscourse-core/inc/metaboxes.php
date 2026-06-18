<?php

/**
 * Добавленике мета-бокса
 */
function geniuscourse_add_metabox()
{

	add_meta_box(
		'car_metabox', // ID метабокса
		esc_html__('Car Settings', 'geniuscourse'), // Заголовок блока настроек
		'geniuscourse_cars_metabox_html', // CallBack-функция, которая является телом метабокса
		'car', // Пост Тайп для которого задается мета-бокс
		'normal', // Отображение метабокса
		'high' // Приоритет. По умолчанию default.
	);
}

add_action('add_meta_boxes', 'geniuscourse_add_metabox');

/**
 * Функция для передачи тела мета-бокса
 */
function geniuscourse_cars_metabox_html($post)
{
	$car_price = get_post_meta($post->ID, 'car_price', true);
	$car_engine = get_post_meta($post->ID, 'car_engine', true);

	/// Генерирую проверку для мета-бокса
	wp_nonce_field('geniuscoursesrandomstring', '_carmetabox');
?>
	<p>
		<label for="car_price"><?= esc_html__('Car Price', 'geniuscourse') ?></label>
		<input type="text" id="car_price" name="car_price" value=<?= esc_attr($car_price) ?>>
	</p>
	<p>
		<label for="car_engine"><?= esc_html__('Car Engine', 'geniuscourse') ?></label>
		<select id="car_engine" name="car_engine">
			<option value=""><?= __('Select Engine', 'geniuscourse') ?></option>
			<option value="manual" <?= $car_engine == 'manual' ? 'selected' : '' ?>><?= __('Manual', 'geniuscourse') ?></option>
			<option value="automatic" <?= $car_engine == 'automatic' ? 'selected' : '' ?>><?= __('Automatic', 'geniuscourse') ?></option>
		</select>
	</p>
<?php

}

function geniuscourse_save_metabox($post_id, $post)
{
	/// Проверяю мета-бокс
	if (!isset($_POST['_carmetabox']) || !wp_verify_nonce($_POST['_carmetabox'], 'geniuscoursesrandomstring')) {
		return $post_id;
	}

	/// Запрет WordPress'у автосохранять пост
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	/// Проверка на нужный Пост Тайп
	if ($post->post_type != 'car') {
		return $post_id;
	}

	/// Проверка, может ли текущий пользователь редактировать пост
	$post_type = get_post_type_object($post->post_type);
	if (!current_user_can($post_type->cap->edit_post, $post_id)) {
		return $post_id;
	}

	/// Для поля Price
	if (isset($_POST['car_price'])) {
		update_post_meta($post_id, 'car_price', sanitize_text_field($_POST['car_price'])); /// Параметры: 1 - id поста, 2 - что менять, 3 - чем менять
		/// sanitize_text_field() очищает входящий текст от потенциальной угрозы
	} else {
		delete_post_meta($post_id, 'car_price'); /// Параметры: 1 - id поста, 2 - что удалить
	}

	/// Для поля Engine
	if (isset($_POST['car_engine'])) {
		update_post_meta($post_id, 'car_engine', sanitize_text_field($_POST['car_engine'])); /// Параметры: 1 - id поста, 2 - что менять, 3 - чем менять
		/// sanitize_text_field() очищает входящий текст от потенциальной угрозы
	} else {
		delete_post_meta($post_id, 'car_engine'); /// Параметры: 1 - id поста, 2 - что удалить
	}

	/// возвращаю id поста
	return $post_id;
}

add_action('save_post', 'geniuscourse_save_metabox', 10, 2); /// Параметры: 1 - хук, 2 - функция, 3 - приоритет, 4 - количество параметров в функции
