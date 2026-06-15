<?php

/**
 * Template name: Домашняя страница
 */

// echo 'Тестирую Тестовую страницу как главную';
get_header();
?>

<br>Это файл template-homepage.php<br>

<div>
    <?php
    /// < Angol. Определяю текущую страницу. Для статических страниц эта переменная запроса называется page
    $paged = get_query_var('page') ? get_query_var('page') : 1;
    /// Angol >

    $args = [
        'post_type' => 'car', /// Название Пост Тайпа
        'posts_per_page' => 2, /// Сколько машин загружать на страницу. Если установить '-1', то будут згружаться все машины.

        /// < Angol. Добавляю параметр текущей страницы
        'paged' => $paged,

    ];
    $cars = new WP_Query($args)
    ?>
    <?php if ($cars->have_posts()) : ?>
        <?php while ($cars->have_posts()): ?>
            <?php $cars->the_post() ?>
            <?php get_template_part('partials/content', 'car') ?>
            <br>
        <?php endwhile ?>

        <?php /* < Angol. Подключаю Пагинацию */ ?>
        <?php geinuscourse_paginate($cars) ?>
        <?php /* Angol > */ ?>

    <?php else : ?>
        <?php get_template_part('partials/content', 'none') ?>
    <?php endif ?>
    <?php wp_reset_postdata() /* Снимаю полномочия со своего кастомного query и передаю управление глобальным query */ ?>

    <hr> <?php /* Разделяю блок машин от блока постов */ ?>

    <?php
    unset($args);
    $args = [
        'post_type' => 'post', /// Название Пост Тайпа. В WordPress Пост тайп постов называется post
        'posts_per_page' => -1, /// Сколько постов загружать на страницу.
        'author' => 1, /// Вывод постов конкретного автора по ID (1 - ID Админа)

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

</div>

<?php
// get_sidebar('car');
get_footer();
