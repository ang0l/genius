<article <?php post_class('custom-car-class') ?> id="post-<?php the_ID() ?>" data-post-id="<?php the_ID() ?>">

    <?php

    // has_post_thumbnail()
    // the_post_thumbnail()
    // get_post_thumbnail_id() // Возвращает id тумбы. Иногда нужно получить id тумбы
    // get_the_post_thumbnail()
    // set_post_thumbnail_size()  это ни что иное как нижние три строки:
    //      update_option('thumbnail_size_w', 170);
    //      update_option('thumbnail_size_h', 170);
    //      update_option('thumbnail_corp', true);


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
        <a href="<?php the_permalink() ?>"><?= esc_html__('Read more', 'geniuscourse') ?></a>
    </div>
</article>