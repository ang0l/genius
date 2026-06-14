<?php

/**
 * Класс персонального виджета
 * 
 * В названии класса каждое слово пишется с большой буквы.
 * Слова разделяются подчеркиванием (?)
 * 
 * @author Angol ang0l@inbox.ru
 * @link https://github.com/ang0l/genius
 */
class Geniuscourse_About_Widget extends WP_Widget
{

	function __construct()
	{
		/// инициализирую класс
		/// параметры:
		/// 1. ID виджета (название класса, но все с мальеньой буквы)
		/// 2. Заголовок виджета
		/// 3. Массив параметров. Я пока передам только описание
		/// Также можно задать класс нейм и в Админке будет специфический класс нейм. Но я его задавать не буду.
		parent::__construct(
			'geniuscourse_about_widget',
			esc_html__('About Widget', 'geniuscourse'),
			esc_html__('Our First Widget', 'geniuscourse'),
		);
	}

	/**
	 * Виджет для форнтенда.
	 * это обязательны метод в классах-виджетах.
	 * здесь будет код, который показватется на фронтенде
	 */
	public function widget($args, $instance)
	{
		extract($args);

		/// создаются переменные для двух полей
		$title = apply_filters('widget_title', $instance['title']); /// Заголовок
		$text = apply_filters('the_content', $instance['text']); /// Контент

		/// вывожу поля
		echo $before_widget;

		if ($title) {
			/// Заголовок есть, вывожу
			echo $before_title;
			echo esc_html($title);
			echo $after_title;
		}

		if ($text) {
			/// Текс тесть, вывожу
			echo wp_kses_post($text);
		}

?>
		<hr>
		<?php
		/// Вставляю блок постов созданный в template-homepage.php
		$args = [
			'post_type' => 'post', /// Название Пост Тайпа. В WordPress Пост тайп постов называется post
			'posts_per_page' => -1, /// Сколько постов загружать на страницу.

		];
		$blogpost = new WP_Query($args)
		?>
		<?php if ($blogpost->have_posts()) : ?>
			<?php while ($blogpost->have_posts()): ?>
				<?php $blogpost->the_post() ?>
				<?php get_template_part('partials/content') ?>
				<br>
			<?php endwhile ?>
		<?php else : ?>
			<?php get_template_part('partials/content', 'none') ?>
		<?php endif ?>
		<?php wp_reset_postdata() /* Снимаю полномочия со своего кастомного query и передаю управление глобальным query */ ?>

	<?php

		echo $after_widget;
	}

	/**
	 * Виджет для бэкенда
	 * Этот метод необходим для того, чтобы у меня была часть бэкенда в админке.
	 * Если я правильно понял, это тоже обязательный метод
	 */
	public function form($instance)
	{
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = '';
		}

		if (isset($instance['text'])) {
			$text = $instance['text'];
		} else {
			$text = '';
		}

		/// Далее HTML-код, который я вынес бы в отдельный файл, ну да ладно
	?>

		<div>
			<label for="<?= $this->get_field_id('title') ?>">
				<?= esc_html('Title', 'geniuscourse') ?>
			</label>

			<input class="widefat" id="<?= $this->get_field_id('title') ?>" name="<?= $this->get_field_name('title') ?>" value="<?= esc_attr($title) ?>" type="text">
		</div>

		<div>
			<label for="<?= $this->get_field_id('text') ?>">
				<?= esc_html('Title', 'geniuscourse') ?>
			</label>

			<textarea class="widefat" id="<?= $this->get_field_id('text') ?>" name="<?= $this->get_field_name('text') ?>"><?= esc_attr($text) ?></textarea>
		</div>

<?php
	}

	/**
	 * Метод для сохнанения информации
	 */
	public function update($new_instance, $old_instance)
	{

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);

		return $instance;
	}
}
