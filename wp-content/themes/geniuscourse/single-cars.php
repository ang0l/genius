<?php

get_header();
?>

My custom Template for Single-Car

<?php
while (have_posts()) :
    the_post();

    get_template_part('partials/content', get_post_type());

    the_post_navigation(
        array(
            'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'geniuscourse') . '</span> <span class="nav-title">%title</span>',
            'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'geniuscourse') . '</span> <span class="nav-title">%title</span>',
        )
    );

    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) {
        comments_template();
    }

endwhile; // End of the loop.

get_footer();
