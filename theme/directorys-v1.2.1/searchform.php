<?php
/**
 * Search Form Template
 */
?>

<div class="search-container sidebar-search-container">
    <form role="search" method="get" action="<?php esc_url( home_url('/') ) ?>">
        <i class="icon-search search-box-icon"></i>
        <input type="text" name="s" class="search-box" value="<?php get_search_query() ?>" placeholder="<?php _e('Search', THEME_TEXT_DOMAIN); ?>" />
    </form>
</div>

