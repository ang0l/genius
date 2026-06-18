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
	<?php wp_body_open(); ?>
	Закончился файл Header <br><br>

	<button id="button_car">
		Show All Cars
	</button>
	<div id="car_content" style="background: #e5e5e5; border: 1px solid #000;">

	</div>