<?php

if (! is_active_sidebar('carsidebar')) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <?php dynamic_sidebar('carsidebar'); ?>
</aside><!-- #secondary -->