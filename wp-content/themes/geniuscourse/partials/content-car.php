<article <?php post_class('custom-car-class') ?> id="post-<?php the_ID() ?>" data-post-id="<?php the_ID() ?>">
    My custom Template for Content-Car
    <h1><?php the_title() ?></h1>
    <div>
        <div>
            <?php the_content() ?>
        </div>
        <a href="<?php the_permalink() ?>"><?= esc_html__('Read more', 'geniuscourse') ?></a>
    </div>
</article>