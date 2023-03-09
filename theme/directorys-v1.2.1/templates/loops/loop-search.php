<?php

if ( get_query_var('search_post_type') ) {

    $search_post_type = get_query_var('search_post_type');

    $wp_query->query['post_type'] = $search_post_type;

    query_posts( $wp_query->query );

    switch($search_post_type) {

        case 'post' :

            get_template_part('templates/loops/search/search', 'posts');

            break;

        case 'page' :

            get_template_part('templates/loops/search/search', 'pages');

            break;

        case 'event' :

            get_template_part('templates/loops/search/search', 'events');

            break;

    }

} else {

    get_template_part('templates/loops/search/search', 'posts');

}