<?php
/*********************************************************************************************

Pagination

*********************************************************************************************/
function wpthemess_paginate($args = null, $query = null, $echo = true) {
    $defaults = array(
        'page' => null, 'pages' => null,
        'range' => 2, 'gap' => 2, 'anchor' => 1,
        'before' => '<div class="pages text-center">', 'after' => '</div>',
        //'title' => __('&nbsp;'),
        'nextpage' => __('&gt;', 'site5framework'), 'previouspage' => __('&lt;', 'site5framework'),
        'echo' => 1,
    );

    $prev_markup = '';
    $next_markup = '';


    $r = wp_parse_args($args, $defaults);
    extract($r, EXTR_SKIP);

    if (!$page && !$pages) {

        if ($query == null) {
            global $wp_query;

            $query = $wp_query;
        }

        /*$args = array(
            'post_type' => 'post',
        );

        $posts = new WP_Query($args);*/

        if (is_front_page()) {

            $page = get_query_var('page') ? get_query_var('page') : 1;

        } else {

            $page = get_query_var('paged') ? get_query_var('paged') : 1;

        }

        if (!isset($posts_per_page)) {
            $posts_per_page = intval(get_query_var('posts_per_page'));
        }

        if ($posts_per_page > 0) {
            $pages = intval(ceil($query->found_posts / $posts_per_page));
        } else {
            $pages = 1;
        }
    }

    $output = "";
    if ($pages > 1) {
        //$output .= "$before<span class='page-title'>$title</span>";

        $prev_show_class = '';
        $next_show_class = '';

        if ($page == 1 && !empty($previouspage)) {
            $prev_show_class = ' inactive';
        }

        if ($page == $pages && !empty($nextpage)) {
            $next_show_class = ' inactive';
        }

        $prev_markup = '
                <a class="button solid md left' . $prev_show_class . '" href="' . get_pagenum_link($page - 1) . '">
                    <i class="fa fa-chevron-left"></i>' . __('Prev', THEME_TEXT_DOMAIN) . '
                </a>
            ';

        $next_markup = '
                <a class="button solid md right' . $next_show_class . '" href="' . get_pagenum_link($page + 1) . '">
                    ' . __('Next', THEME_TEXT_DOMAIN) . '<i class="fa fa-chevron-right"></i>
                </a>
            ';

        $output .= $prev_markup;

        $output .= "$before";
        $ellipsis = "<span class='pagination-gap page'>...</span>";

        $min_links = $range * 2 + 1;
        $block_min = min($page - $range, $pages - $min_links);
        $block_high = max($page + $range, $min_links);
        $left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
        $right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

        if ($left_gap && !$right_gap) {
            $output .= sprintf('%s%s%s',
                wpthemess_paginate_loop(1, $anchor),
                $ellipsis,
                wpthemess_paginate_loop($block_min, $pages, $page)
            );
        }
        else if ($left_gap && $right_gap) {
            $output .= sprintf('%s%s%s%s%s',
                wpthemess_paginate_loop(1, $anchor),
                $ellipsis,
                wpthemess_paginate_loop($block_min, $block_high, $page),
                $ellipsis,
                wpthemess_paginate_loop(($pages - $anchor + 1), $pages)
            );
        }
        else if ($right_gap && !$left_gap) {
            $output .= sprintf('%s%s%s',
                wpthemess_paginate_loop(1, $block_high, $page),
                $ellipsis,
                wpthemess_paginate_loop(($pages - $anchor + 1), $pages)
            );
        }
        else {
            $output .= wpthemess_paginate_loop(1, $pages, $page);
        }

        $output .= $after;

        $output .= $next_markup;
    }

    if ($echo) {
        echo $output;
    }

    return $output;
}

function wpthemess_paginate_loop($start, $max, $page = 0) {
    $output = "";
    for ($i = $start; $i <= $max; $i++) {
        $output .= ($page === intval($i))
            ? '<a href="' . get_pagenum_link($i) . '" class="page active" title="page ' . $i . '">' . $i . '</a>'
            : '<a href="' . get_pagenum_link($i) . '" class="page" title="page ' . $i . '">' . $i . '</a>';
    }
    return $output;
}


?>