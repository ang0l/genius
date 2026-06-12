<?php

/**
 * Шаблон подвала темы
 *
 * @link https://github.com/ang0l
 * @author Angol ang0l@inbox.ru
 * @package geniuscourse
 */

?>

<br><br>Начинается файл Footer<br>
<?php
wp_nav_menu([
    'theme_location' => 'footer_nav',
])
?>

<?php wp_footer(); ?>

</body>

</html>