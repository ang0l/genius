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

<br>Это файл index.php<br>

<div>
	<?php if (have_posts()) : ?>

		<?php while (have_posts()): ?>
			<?php the_post() ?>
			<?php get_template_part('partials/content') ?>
			<br>
		<?php endwhile ?>

		<?php /* Простая Пагинация
		<?php posts_nav_link(' . ', esc_html__('Prev', 'geniuscourse'), esc_html__('Next', 'geniuscourse')) ?>
		 */ ?>

		<?php /* Ссылки устанавливающиея в разных частяк HTML-кода*/ ?>
		<div class="pagination">
			<div class="prev">
				<?php /* previous_posts_link('%link', __('Prev', 'geniuscourse')) */ ?>
				<?php previous_posts_link(__('Prev', 'geniuscourse')) ?>
			</div>
			<div>HTML-код</div>
			<div class="next">
				<?php /* next_posts_link(__('Next', 'geniuscourse')) */ ?>
				<?php next_posts_link(__('Next', 'geniuscourse')) ?>
			</div>
		</div>


		<?php /* Еще одна пагинация 
		<div class="pagination">
		<?php $args = [
			'prev_text' => esc_html__('Back', 'geniuscourse'),
			'next_text' => esc_html__('Onward', 'geniuscourse'),
		]; ?>
		<?php the_posts_pagination($args) ?>
		</div>
		*/ ?>

		<?php /* Еще одна функция, которая работает еще с более старыми версиями WordPress
		<div class="pagination">
			<?= paginate_links() ?>
		</div>
 		*/ ?>
	<?php else : ?>
		<?php get_template_part('partials/content', 'none') ?>
	<?php endif ?>
</div>

<?php
// get_sidebar('car');
get_footer();
