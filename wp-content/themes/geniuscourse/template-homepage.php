<?php

/**
 * Template name: Домашняя страница
 */

// echo 'Тестирую Тестовую страницу как главную';
get_header();
?>

<div>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()): ?>
            <?php the_post() ?>
            This is file - temlate-homepage.php
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
