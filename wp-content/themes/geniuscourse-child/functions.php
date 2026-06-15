<?php

function geniuscourse_child_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('New Pages Sidebar', 'geniuscourse'), /// Имя сайдбара
            'id' => 'newsidebar', /// ID сайдбара. Должен быть уникальным
            'description' => esc_html__('Appear as a Sidebar on New Pages.', 'geniuscourse'), /// Описание сайдбара
            'before_widget' => '<section id="%1$s" class="widget %2$s">', /// Вывод HTML-тега до виджета
            'after_widget' => '</section>', /// Вывод HTML-тега после виджета
            'before_title' => '<h2 class="widget-title">', /// Открытие заголовка виджета
            'after_title' => '</h2>', /// Закрытие заголовка виджета
        )
    );
}
add_action('widgets_init', 'geniuscourse_child_widgets_init');
