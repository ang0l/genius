<?php
get_header();

/// Ищу название бренда в Терме, чтобы добавить его в заголовок
/// В функции задаю параметры:
/// 1. поиск по слагу;
/// 2. текущий Терм;
/// 3. текущую Таксономи.
/// Возвращает объект текущего Терма
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

// echo '<pre>';
// print_r($term);
// echo '</pre>';
/// Нашел откуда взять имя Терма

echo $term->name;

/// Далее беру HTML-код из index.php
?>

<div>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()): ?>
            <?php the_post() ?>
            <?php get_template_part('partials/content', 'car') ?> <?php /* /// Взял контент из шаблона машин */ ?>
            <br>
        <?php endwhile ?>
    <?php else : ?>
        <?php get_template_part('partials/content', 'none') ?>
    <?php endif ?>
</div>

<?php
/// Подключаю Подвал
get_footer();
