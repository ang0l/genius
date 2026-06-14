<?php

/**
 * Шаблон главной страницы
 *
 * Это наиболее общий файл шаблона в теме WordPress
 * и один из двух необходимых файлов для темы (другой - style.css).
 * Он используется для отображения страницы, когда больше ничего конкретного совпадает с запросом. 
 * Он объединяет домашнюю страницу, когда не существует файла home.php.
 *
 * @link https://github.com/ang0l/genius
 * @author Angol ang0l@inbox.ru
 * @package geniuscourse
 */

get_header();
?>

<div>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()): ?>
			<?php the_post() ?>
			<?php get_template_part('partials/content') ?>
			<br>
		<?php endwhile ?>
	<?php else : ?>
		<?php get_template_part('partials/content', 'none') ?>
	<?php endif ?>
</div>

<?php
get_sidebar('car');
get_footer();
