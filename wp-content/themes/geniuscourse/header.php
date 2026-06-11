<?php

/**
 * Шапка для темы
 *
 * @link https://github.com/ang0l
 * @author Angol ang0l@inbox.ru
 * @package geniuscourse
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	Закончился файл Header <br>
	<?php wp_body_open(); ?>
	<?php

	// esc_attr() // используется для ескейпа атрибутов
	// esc_html() // для ескейпа html-тегов
	// esc_url() // для ссылок
	// wp_kses() // имеет 2 парамтеро: тег и массив атрибутов для этого тега. пропускает только тот html, который я разрешаю
	// wp_kses_post() // содержит все разрешенные для поста теги. похож на wp_kses(), но с 1 параметром
	// wp_kses_data() // содержит все разрешенные для комментариев теги. похож на wp_kses(), но с 1 параметром
	// esc_js() // для вставки js-кода, например в кнопку обработчик событий
	// esc_textarea() // предназначен для текстового поля textarea

	// $name = 'Andrey Golovushkin "Angol"'; // пример для инпута
	$name = 'Andrey Golovushkin <strong>Angol';

	echo esc_html($name); // выводит на экран тег <strong> ввиде читаемого текста


	?>

	<!--<input name="aethor" value="<?php /*= $name*/ ?>"> -->
	<?php /* выводится только часть текста, т.к. двойные кавычки в нике закрывают значение параметра vslue */ ?>
	<?php /*<input name="aethor" value="<?= esc_attr($name) ?>"> <?php /* d WordPress правильно так. Так будет выводиться вся строка */ ?>