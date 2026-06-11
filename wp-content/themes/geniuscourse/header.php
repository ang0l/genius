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

	$hello = esc_html__('Hello', 'geniuscourse'); // возвращает результат перевода
	$hello = esc_html_e('Hello', 'geniuscourse'); // выводит на экран результат перевода

	echo $hello . '<br>';

	$city = 'Krasnodar';
	$country = 'Russia';

	printf(esc_html__('My city %1$s and my country %2$s', 'geniuscourse'), $city, $country);

	/// перевод во множественное число
	$raiting = 4;

	echo '<br>';
	printf(esc_html(_n('%s star', '%s stars', $raiting, 'geniuscourse')), $raiting);

	?>