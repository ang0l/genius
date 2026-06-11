<form method="get" action="<?= home_url('/') ?>">
    <input type="search" name="s" value="<?php the_search_query() ?>">
    <input type="submit">
    <input type="hidden" value="post" name="post_type">
</form>