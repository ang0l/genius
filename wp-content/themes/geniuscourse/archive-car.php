<?php

/**
 * Шаблон для вывода архивных страниц Автомобилей
 *
 * @link https://github.com/ang0l/genius
 *
 * @package geniuscourse
 */

get_header();
?>

<br>Это файл archive-car.php<br>

<div>
	<header class="page-header">
		<?php
		the_archive_title('<h1 class="page-title">', '</h1>');
		the_archive_description('<div class="archive-description">', '</div>');
		?>
	</header><!-- .page-header -->

	<?php /* < Angol. 33. Персональная пагинация */ ?>
	<?php
	/// Получаю параметр страницы
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	/// Создается объект от глобального WP_Query
	$cars = new WP_Query(['post_type' => 'car', 'posts_per_page' => 2, 'paged' => $paged]);
	/// Далее для пагинации задается вывод информации от $cars.
	?>
	<?php /* if (have_posts()) : */ ?>
	<?php /* while (have_posts()): */ ?>
	<?php /* the_post() */ ?>
	<?php if ($cars->have_posts()) : ?>
		<?php while ($cars->have_posts()): ?>
			<?php $cars->the_post() ?>
			<?php /* Angol > */ ?>

			<?php get_template_part('partials/content', 'car') ?>

			<div class="pagination">

				<?php /* < Angol 2. Рефакторинг с переносом ниженаписанного кода в файл functions.php */ ?>
				<?php /* < Angol 1. Для вывода правильного количества страниц в Пагинации добавляю параметры в функцию */ ?>
				<?php /*= paginate_links() */ ?>
				<?php /*
				$big = 999999999; // Нереально большое число

				echo paginate_links(array(
					'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
					'format' => '?paged=%#%',
					'current' => max(1, get_query_var('paged')),

					/// < Angol. Меняю объект, из которого я получаю количество страниц
					/// 'total' => $the_query->max_num_pages
					'total' => $cars->max_num_pages
					/// Angol >

				)); */
				?>
				<?php geinuscourse_paginate($cars) ?>
				<?php /* Angol 1 > */ ?>
				<?php /* Angol 2 > */ ?>

			</div>

		<?php endwhile ?>
	<?php else : ?>
		<?php get_template_part('partials/content', 'none') ?>
	<?php endif ?>
</div>


<?php
// get_sidebar('car');
get_footer();
