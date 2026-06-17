<article <?php post_class('custom-car-class') ?> id="post-<?php the_ID() ?>" data-post-id="<?php the_ID() ?>">

    <?php

    if (has_post_thumbnail(get_the_ID())) { // проверяет, есть ли у данного поста картинка, возвращает bool. get_the_ID() возвращает id поста.
        the_post_thumbnail('car-cover'); // Генерирует Thumblnail. В параметре идентификатор нужной нам картинки, заданный в functions.php
        // get_the_post_thumbnail(get_the_ID(), 'car-cover') // Выводит тумбу
        echo get_the_post_thumbnail(get_the_ID(), [100, 100]); // Выводит тумбу с размерами 100х100px
    }

    ?>
    <h1><?php the_title() ?></h1>
    <div>
        <div>
            <?php the_content() ?>
        </div>
        <div>
            <?php /* 1 - ID поста, 2 - ключ, 3 - true строка, false массив */ ?>
            <?= get_post_meta(get_the_ID(), 'custom_price', true) /* из _acf.php */ ?>
            <?= get_post_meta(get_the_ID(), 'car_price', true) /* из _metaboxes.php */  ?>
            <?= get_post_meta(get_the_ID(), 'custom_engine_type', true) /* из _acf.php */  ?>
            <?php print_r(get_post_meta(get_the_ID(), 'custom_engine_type', false)) ?>
        </div>
        <a href="<?php the_permalink() ?>"><?= esc_html__('Read more', 'geniuscourse') ?></a>
    </div>
</article>