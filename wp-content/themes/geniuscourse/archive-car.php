<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

    <?php if (have_posts()) : ?>
        <?php while (have_posts()): ?>
            <?php the_post() ?>
            <?php get_template_part('partials/content') ?>

            <div class="pagination">
                <?= paginate_links() ?>
            </div>

        <?php endwhile ?>
    <?php else : ?>
        <?php get_template_part('partials/content', 'none') ?>
    <?php endif ?>
</div>


<?php
// get_sidebar('car');
get_footer();
