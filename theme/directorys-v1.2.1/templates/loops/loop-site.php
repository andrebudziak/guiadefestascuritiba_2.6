<?php

global $directorys_options;

$show_sidebar = true;

if ( isset($directorys_options['search_sidebar_position']) ) {

    $sidebar_position = $directorys_options['search_sidebar_position'];

    if ( $sidebar_position == 'left' ) {

        $sidebar_pos_class = 'sidebar-left';

    } elseif ( $sidebar_position == 'right' ) {

        $sidebar_pos_class = '';

    } else {

        $sidebar_pos_class = 'no-sidebar';

        $show_sidebar = false;

    }

}

//$count_options = array('2' => '2', '5' => '5', '10' => '10', '15' => '15', '20' => '20', '30' => '30', '40' => '40', '50' => '50', '100' => '100');
//$sort_by_options = array('name' => 'Name', 'date' => 'Date', 'rating' => 'Rating');
//$sort_options = array('asc' => 'ASC', 'desc' => 'DESC');
//
//$count_options_markup = '';
//$sort_by_options_markup = '';
//$sort_options_markup = '';
//
//foreach ($count_options as $key => $value) {
//
//    if ($key == $count) {
//        $count_options_markup .= '<option value="' . $key . '" selected>' . $value . '</option>';
//    } else {
//        $count_options_markup .= '<option value="' . $key . '">' . $value . '</option>';
//    }
//
//}
//
//foreach ($sort_by_options as $key => $value) {
//
//    if ($key == $sort_by) {
//        $sort_by_options_markup .= '<option value="' . $key . '" selected>' . $value . '</option>';
//    } else {
//        $sort_by_options_markup .= '<option value="' . $key . '">' . $value . '</option>';
//    }
//
//}
//
//foreach ($sort_options as $key => $value) {
//
//    if ($key == $sort) {
//        $sort_options_markup .= '<option value="' . $key . '" selected>' . $value . '</option>';
//    } else {
//        $sort_options_markup .= '<option value="' . $key . '">' . $value . '</option>';
//    }
//
//}

$paged = get_query_var('paged');

if (empty($paged)) {
    $paged = 1;
}

?>

<div class="container">
    <div class="row <?php echo $sidebar_pos_class ?>">

<!--        --><?php //echo $_REQUEST['filter-count'] ?>

        <div class="col-md-9">

            <?php

            $queried_obj = get_queried_object();

            if ($queried_obj->taxonomy == 'sites_category') {

                $category_name = $queried_obj->name;

            }

            ?>

            <div class="divider divider-1">
                <h1 class="title"><?php echo $category_name ?></h1><div class="separator"></div>
            </div>

            <div class="blog-wrapper">
                <div class="recent-places sites-listings">

                    <div class="post-header clearfix">
                        <div class="posts-show-number">Showing <?php echo $wp_query->post_count * $paged ?> of <?php echo $wp_query->found_posts ?> Items</div>
    <!--                    <div class="post-sort-recent">-->
    <!--                        Count:-->
    <!--                        <select id="site-count" name="filter-count" aria-invalid="false">-->
    <!--                            --><?php //echo $count_options_markup ?>
    <!--                        </select>-->
    <!--                        Sort by:-->
    <!--                        <select id="site-sort-by" name="filter-count" aria-invalid="false">-->
    <!--                            --><?php //echo $sort_by_options_markup ?>
    <!--                        </select>-->
    <!--                        Sort:-->
    <!--                        <select id="site-sort" name="filter-count" aria-invalid="false">-->
    <!--                            --><?php //echo $sort_options_markup; ?>
    <!--                        </select>-->
    <!--                    </div>-->
                    </div>

                    <?php

                    $searched_sites = array();

                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();

                            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'site_thumb');

                            $contact_fields = get_post_meta($post->ID, 'contact', true);

                            $category = wp_get_post_terms($post->ID, 'sites_category');

                            $category_info = get_option('taxonomy_' . $category[0]->term_id);

                            $category_icon = $category_info['badge'];

                            $address = $contact_fields['address'];
                            $phone = $contact_fields['phone'];

                            if (empty($thumbnail)) {
                                $event_thumb = '';
                            } else {
                                $event_thumb = '<img src="' . $thumbnail[0] . '">';
                            }

                            ?>

                            <div <?php post_class(); ?>>

                                <div class="site-wrapper clearfix">
                                    <div class="picture">
                                        <?php echo $event_thumb ?>
                                    </div>

                                    <div class="description">
                                        <i class="iconstyle"><img src="<?php echo $category_icon ?>" /></i>

                                        <div class="col-md-9 descriptioninfo">
                                            <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                                            <p><?php echo $address['value'] ?></p>
                                            <p><?php echo holo_get_excerpt_by_id($post->ID, 12) ?></p>
                                            <i><?php echo $phone['value'] ?></i>
                                        </div>
                                        <div class="col-md-3 rating"><p><?php _e('No Rating Yet', THEME_TEXT_DOMAIN) ?></p></div>
                                    </div>
                                </div>

                            </div>

                        <?php

                        }
                    }

                    ?>

                </div>

                <?php

                get_template_part('templates/pagination');

                wp_reset_query();

                ?>

            </div>

        </div>

        <?php

        if ($show_sidebar) :

            get_template_part('templates/sidebar');

        endif;

        ?>

    </div>
</div>