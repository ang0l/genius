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

	<?php

	// if (is_tax()) { /// Для всех страниц с Таксономи
	// if (is_tax('brand')) { /// Для страници с конкретным Таксономи
	// if (is_tax('brand', 'bmw')) { /// Для страници с конкретным Таксономи и конктретным Термом
	if (is_tax('brand', ['bmw', 'volkswagen'])) { /// Для страници с конкретным Таксономи и конктретными Термами переданными массивом
		// echo 'Header for Taxonomy pages'; /// Выводит на странице с Таксономи
		// echo 'Header for Brand pages'; /// Выводит на странице с Таксономи Brand
		// echo 'Header for Brand BMW pages'; /// Выводит на странице с Таксономи бренда BMW, на странице с Mersedes уже не выводится
		echo 'Header for Brand BMW and VolksWagen pages'; /// Выводит на странице с Таксономи бренда BMW и VolksWagen, на странице с Mersedes также не выводится
	} else {
		echo 'Single Header'; /// Выводит на архивных страницах или на всех других, если фильруются конктретные Таксономи и Термы
	}
	?>
	<br>