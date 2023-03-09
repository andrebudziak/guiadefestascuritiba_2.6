<?php


class Breadcrumbs {

    public static $container_tag;
    public static $delimiter;
    public static $beforeElement;
    public static $afterElement;

    public static $home;
    public static $homeLink;

    public static function getBreadcrumbs($container_tag, $beforeElement = '', $afterElement = '') {

        Breadcrumbs::$container_tag = $container_tag;
        Breadcrumbs::$delimiter = ' <span class="divider">/</span> ';
        Breadcrumbs::$home = get_bloginfo('name');
        Breadcrumbs::$homeLink = get_bloginfo('url');
        Breadcrumbs::$beforeElement = $beforeElement;
        Breadcrumbs::$afterElement = $afterElement;

        echo '<' . Breadcrumbs::$container_tag . '>';

        echo '<a href="' . Breadcrumbs::$homeLink . '">' . Breadcrumbs::$home . '</a>';

        echo Breadcrumbs::getLinks();

        echo '</' . Breadcrumbs::$container_tag . '>';
    }

    /**
     * Check what page the user is seeing at this moment. Based on that, we show the links.
     */
    public static function getLinks() {

        global $post;

        if(is_woocommerce())
        {

            $shop_id 	= woocommerce_get_page_id('shop');
            $taxonomy 	= "product_cat";

            if(is_shop())
            {
                if(!empty($shop_id) && $shop_id  != -1) {

                }

//                if ( is_search() ) {
//                    $last = __('Search results for: ','avia_framework').esc_attr($_GET['s']);
//                }
            }

            if(is_product())
            {

                return $shop_id;
//                //fetch all product categories and search for the ones with parents. if none are avalaible use the first category found
//                $product_category = $parent_cat = array();
//                $temp_cats = get_the_terms(get_the_ID(), $taxonomy);
//
//                if(!empty($temp_cats))
//                {
//                    foreach($temp_cats as $key => $cat)
//                    {
//                        if($cat->parent != 0 && !in_array($cat->term_taxonomy_id, $parent_cat))
//                        {
//                            $product_category[] = $cat;
//                            $parent_cat[] = $cat->parent;
//                        }
//                    }
//
//                    //if no categories with parents use the first one
//                    if(empty($product_category)) $product_category[] = reset($temp_cats);
//
//                }
//                //unset the trail and build our own
//                unset($trail);
//
//                $trail[0] = $home;
//                if(!empty($shop_id) && $shop_id  != -1)    $trail = array_merge( $trail, avia_breadcrumbs_get_parents( $shop_id ) );
//                if(!empty($parent_cat)) $trail = array_merge( $trail, avia_breadcrumbs_get_term_parents( $parent_cat[0] , $taxonomy ) );
//                if(!empty($product_category)) $trail[] = '<a href="' . get_term_link( $product_category[0]->slug, $taxonomy ) . '" title="' . esc_attr( $product_category[0]->name ) . '">' . $product_category[0]->name . '</a>';

            }


//            // add the [shop] trail to category/tag pages: [home] [if available:parent shop pages] [shop] [if available:parent categories] [category/tag]
//            if(is_product_category() || is_product_tag())
//            {
//                if(!empty($shop_id) && $shop_id  != -1)
//                {
//                    $shop_trail = avia_breadcrumbs_get_parents( $shop_id ) ;
//                    array_splice($trail, 1, 0, $shop_trail);
//                }
//            }
//
//            if(is_product_tag())
//            {
//                $last = __("Tag",'avia_framework').": ".$last;
//            }
//
//
//            if(!empty($last)) $trail[] = $last;
        }

        if ( is_category() ) {
            global $wp_query;

            $cat_obj = $wp_query->get_queried_object();

            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);

            //todo: Check if get_category_parents works fine
//            if ($thisCat->parent != 0) {
//                echo(get_category_parents($parentCat, TRUE, Breadcrumbs::$delimiter));
//            }

            return Breadcrumbs::$delimiter . Breadcrumbs::$beforeElement . single_cat_title('', false) . Breadcrumbs::$afterElement;
        }

        if ( is_day() ) {
            $year = '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
            $month = '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>';
            $day = Breadcrumbs::$beforeElement . get_the_time('d') . Breadcrumbs::$afterElement;

            return Breadcrumbs::$delimiter . $year . Breadcrumbs::$delimiter . $month . Breadcrumbs::$delimiter . $day;
        }

        if ( is_month() ) {
            $year =  '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
            $month = Breadcrumbs::$beforeElement . get_the_time('F') . Breadcrumbs::$afterElement;

            return Breadcrumbs::$delimiter . $year . Breadcrumbs::$delimiter . $month;
        }

        if ( is_year() ) {
            return Breadcrumbs::$delimiter . Breadcrumbs::$beforeElement . get_the_time('Y') . Breadcrumbs::$afterElement;
        }

        if ( is_search() ) {
            return Breadcrumbs::$delimiter . Breadcrumbs::$beforeElement . __('Search results for:', THEME_TEXT_DOMAIN) . get_search_query() . Breadcrumbs::$afterElement;
        }

        if ( is_tag() ) {
            return Breadcrumbs::$delimiter . Breadcrumbs::$beforeElement . single_tag_title('', false) . Breadcrumbs::$afterElement;
        }

        if ( is_author() ) {
            global $author;
            $userData = get_userdata($author);

            return Breadcrumbs::$delimiter . Breadcrumbs::$beforeElement . $userData->display_name . Breadcrumbs::$afterElement;
        }

        if ( is_404() ) {
            return Breadcrumbs::$delimiter . Breadcrumbs::$beforeElement . __('404 not Found') . Breadcrumbs::$afterElement;
        }

        if ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;

                //todo: find a solution for portfolio link
                if ($slug == 'portfolio') {
//                    $links =  Breadcrumbs::$delimiter . '<a href="' . $options['portfolio-link'] . '/">' . $post_type->labels->singular_name . '</a>' . Breadcrumbs::$delimiter;
//                    return $links . Breadcrumbs::$beforeElement . get_the_title() . Breadcrumbs::$afterElement;
                }
                else {
                    $links = Breadcrumbs::$delimiter . '<a href="' . Breadcrumbs::$homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>' . Breadcrumbs::$delimiter;
                    return $links . Breadcrumbs::$beforeElement . get_the_title() . Breadcrumbs::$afterElement;
                }
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $links = Breadcrumbs::$delimiter . get_category_parents($cat, TRUE, Breadcrumbs::$delimiter);
                return $links . Breadcrumbs::$beforeElement . get_the_title() . Breadcrumbs::$afterElement;
            }
        }

        if ( is_page() && !$post->post_parent ) {
            return Breadcrumbs::$delimiter . Breadcrumbs::$beforeElement . get_the_title() . Breadcrumbs::$afterElement;
        }

        /* check if this is a page that has one or more parents */
        if ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();

            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = Breadcrumbs::$delimiter . ' <a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
            }

            $breadcrumbs = array_reverse($breadcrumbs);

            return implode('', $breadcrumbs) . Breadcrumbs::$delimiter . Breadcrumbs::$beforeElement . get_the_title() . Breadcrumbs::$afterElement;
        }

        //todo: check what appear when page is_attachment()
//        if ( is_attachment() ) {
//            $parent_id  = $post->post_parent;
//            $breadcrumbs = array();
//            while ($parent_id) {
//                $page = get_page($parent_id);
//                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
//                $parent_id    = $page->post_parent;
//            }
//            $breadcrumbs = array_reverse($breadcrumbs);
//            foreach ($breadcrumbs as $crumb) echo ' ' . $crumb . ' ' . Breadcrumbs::$delimiter . ' ';
//            echo Breadcrumbs::$delimiter . ' ' . Breadcrumbs::$beforeElement . '' . get_the_title() . '"' . Breadcrumbs::$afterElement;
//        }


        //todo: make get_query_var() to display pages correctly
//    if ( get_query_var('paged') ) {
//        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
//        echo ('Page') . ' ' . get_query_var('paged');
//        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
//    }

    }

}