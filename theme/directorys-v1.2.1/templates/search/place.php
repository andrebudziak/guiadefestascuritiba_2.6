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

$count_options = array('2' => '2', '5' => '5', '10' => '10', '15' => '15', '20' => '20', '30' => '30', '40' => '40', '50' => '50', '100' => '100');
$sort_by_options = array('name' => __('Name', THEME_TEXT_DOMAIN), 'date' => __('Date', THEME_TEXT_DOMAIN), 'rating' => __('Rating', THEME_TEXT_DOMAIN));
$sort_options = array('asc' => 'ASC', 'desc' => 'DESC');

$count_options_markup = '';
$sort_by_options_markup = '';
$sort_options_markup = '';

$count = $_REQUEST['count'];
$sort_by = $_REQUEST['sort-by'];
$sort = $_REQUEST['sort'];

foreach ($count_options as $key => $value) {

    if ($key == $count) {
        $count_options_markup .= '<option value="' . $key . '" selected>' . $value . '</option>';
    } else {
        $count_options_markup .= '<option value="' . $key . '">' . $value . '</option>';
    }

}

foreach ($sort_by_options as $key => $value) {

    if ($key == $sort_by) {
        $sort_by_options_markup .= '<option value="' . $key . '" selected>' . $value . '</option>';
    } else {
        $sort_by_options_markup .= '<option value="' . $key . '">' . $value . '</option>';
    }

}

foreach ($sort_options as $key => $value) {

    if ($key == $sort) {
        $sort_options_markup .= '<option value="' . $key . '" selected>' . $value . '</option>';
    } else {
        $sort_options_markup .= '<option value="' . $key . '">' . $value . '</option>';
    }

}

?>

<div class="container">
    <div class="row <?php echo $sidebar_pos_class ?>">
        <div class="blog-wrapper col-md-9">
            <div class="recent-places sites-listings">

                <?php

                $paged = get_query_var('paged');

                if (empty($paged)) {
                    $paged = 1;
                }

                $search_category = $_REQUEST['category'];
                $search_location = $_REQUEST['location'];

                $location_query = (!empty($search_location) ? ' & sites_location=' . $search_location : '');
                $category_query = (!empty($search_category) ? ' & sites_category=' . $search_category : '');
                $count_query = ' & posts_per_page=' . $count . '&paged=' . $paged;
                $sort_by_query = (!empty($sort_by) ? ' & orderby=' . $sort_by : '');
                $sort_query = (!empty($sort) ? '& order=' . $sort : '');

                if (!empty($s) && $s !== ' ') {
                    $query = 's=' . $s . ' & post_type=site' . $category_query . $location_query . $count_query . $sort_by_query . $sort_query . '';
                } else {
                    $query = 'post_type=site' . $category_query . $location_query . $count_query . $sort_by_query . $sort_query . '';
                }

                query_posts( $query );

                ?>

                <div class="post-header clearfix">
                    <div class="posts-show-number"><?php echo __('Showing', THEME_TEXT_DOMAIN) . ' ' . $wp_query->post_count * $paged . ' ' . __('of', THEME_TEXT_DOMAIN) . ' ' . $wp_query->found_posts . ' ' . __('Items', THEME_TEXT_DOMAIN); ?></div>
                    <div class="post-sort-recent">
                        <?php _e('Count', THEME_TEXT_DOMAIN); ?>:
                        <select id="site-count" name="filter-count" aria-invalid="false">
                            <?php echo $count_options_markup ?>
                        </select>
                        <?php _e('Sort by', THEME_TEXT_DOMAIN); ?>:
                        <select id="site-sort-by" name="filter-count" aria-invalid="false">
                            <?php echo $sort_by_options_markup ?>
                        </select>
                        <?php _e('Sort', THEME_TEXT_DOMAIN); ?>:
                        <select id="site-sort" name="filter-count" aria-invalid="false">
                            <?php echo $sort_options_markup; ?>
                        </select>
                    </div>
                </div>

                <?php

                $searched_sites = array();

                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();

                        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'site_thumb');
                        $fallback_thumb = $directorys_options['listings_fallback_featured_image']['url'];
                        $fallback_thumb = holo_get_image_by_size($fallback_thumb, 274, 199);

                        $contact_fields = get_post_meta($post->ID, 'contact', true);

                        $category = wp_get_post_terms($post->ID, 'sites_category');

                        if (!empty($category)) {
                            $category_info = get_option('taxonomy_' . $category[0]->term_id);

                            $category_icon = '<img src="' . $category_info['badge'] . '" />';
                        } else {

                            $category_icon = '';

                        }

                        $address = isset($contact_fields['address']) ? $contact_fields['address'] : array('value' => '');
                        $phone = isset($contact_fields['phone']) ? $contact_fields['phone'] : array('value' => '') ;

                        if (empty($thumbnail)) {
                            $event_thumb ='<img src="' . $fallback_thumb . '">';
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
                                    <i class="iconstyle"><?php echo $category_icon ?></i>

                                    <div class="col-md-9 descriptioninfo">
                                        <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                                        <p><?php echo $address['value'] ?></p>
                                        <p><?php echo holo_get_excerpt_by_id($post->ID, 12) ?></p>
                                        <i><?php echo $phone['value'] ?></i>
                                    </div>
                                    <div class="col-md-3 rating"><?php echo holo_get_ratings($post->ID) ?></div>
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

        <?php

        if ($show_sidebar) :

        get_template_part('templates/sidebar');

        endif;

        ?>

    </div>
</div>