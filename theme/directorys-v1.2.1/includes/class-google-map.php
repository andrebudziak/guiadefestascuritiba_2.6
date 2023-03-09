<?php

class HT_Google_Map {

    private static $instance;
    private $directorys_options;
    public $page_id;
    public $show_search_section;
    public $top_section; // 'none', 'map' or 'slider'
    public $page_type;
    public $markers;

    public $map_lat;
    public $map_long;
    public $map_overlay_opacity;
    public $use_geolocation;
    public $geolocation_always_active;
    public $theme_color;
    public $second_theme_color;
    public $map_default_zoom;
    public $map_length_unit;

    public $search_category;
    public $search_location;
    public $search_distance;
    public $is_geolocation_active;
    public $count;
    public $sort_by;
    public $sort;
    public $search;

    public $user_marker;
    public $clusters_icon;

    function __construct() {

        global $directorys_options;
        global $post, $_REQUEST;

        $this->directorys_options = $directorys_options;

        $this->_populate_default_options();
        $this->_populate_search_attributes();

        add_action('wp_ajax_get_map_data', array($this, 'get_map_data_callback'));
        add_action('wp_ajax_nopriv_get_map_data', array($this, 'get_map_data_callback'));

        $this->markers = $this->get_sites();
    }

    public static function get_instance() {

        if (!isset(self::$instance)) {

            $class = __CLASS__;
            self::$instance = new $class();

        }

        return self::$instance;

    }

    public function get_map_data_callback() {

        $settings = array();

        $settings['settings']['map_lat'] = $this->map_lat;
        $settings['settings']['map_long'] = $this->map_long;
        $settings['settings']['overlay_opacity'] = $this->map_overlay_opacity;
        $settings['settings']['user_marker'] = $this->user_marker;
        $settings['settings']['search_distance'] = $this->search_distance;
        $settings['settings']['theme_color'] = $this->theme_color;
        $settings['settings']['second_theme_color'] = $this->second_theme_color;
        $settings['settings']['clusters_icon'] = $this->clusters_icon;
        $settings['settings']['map_default_zoom'] = (int)$this->map_default_zoom;
        $settings['settings']['map_length_unit'] = $this->map_length_unit;

        if ($this->is_geolocation_active || $this->geolocation_always_active) {
            $settings['settings']['is_geolocation_active'] = 1;
        } else {
            $settings['settings']['is_geolocation_active'] = 0;
        }

        $settings['markers_data'] = $this->markers;

        echo json_encode($settings);
        die();

    }

    private function _populate_default_options() {

        $this->user_marker = HOLO_TEMPLATE_DIR_URI . '/includes/admin/img/pin-user.png';
        $this->clusters_icon = HOLO_TEMPLATE_DIR_URI . '/includes/admin/img/circle.png';
        $this->map_lat = isset($this->directorys_options['default_map_latitude']) ? $this->directorys_options['default_map_latitude'] : 0;
        $this->map_long = isset($this->directorys_options['default_map_longitude']) ? $this->directorys_options['default_map_longitude'] : 0;
        $this->map_overlay_opacity = isset($this->directorys_options['map_overlay_opacity']) ? $this->directorys_options['map_overlay_opacity'] : 0;
        $this->use_geolocation = isset($this->directorys_options['map_geolocation_use']) ? $this->directorys_options['map_geolocation_use'] : 1;
        $this->geolocation_always_active = isset($this->directorys_options['map_geolocation_always_active']) ? $this->directorys_options['map_geolocation_always_active'] : 0;
        $this->theme_color = $this->directorys_options['color_theme'];
        $this->second_theme_color = $this->directorys_options['second_color_theme'];
        $this->map_length_unit = isset($this->directorys_options['map_length_unit']) ? $this->directorys_options['map_length_unit'] : 'km';

        if ( isset($this->directorys_options['map_use_predefined_zoom']) && $this->directorys_options['map_use_predefined_zoom'] ) {
            $this->map_default_zoom = isset($this->directorys_options['map_default_zoom']) ? $this->directorys_options['map_default_zoom'] : 8;
        } else {
            $this->map_default_zoom = 0;
        }

    }

    private function _populate_search_attributes() {

        $this->search = (isset($_REQUEST['s']) ? $_REQUEST['s'] : '');
        $this->search_category = (isset($_REQUEST['category']) ? $_REQUEST['category'] : '');
        $this->search_location = (isset($_REQUEST['location']) ? $_REQUEST['location'] : '');
        $this->is_geolocation_active = (isset($_REQUEST['use_geolocation']) && $_REQUEST['use_geolocation'] == 1 ? 1 : 0);
        $this->search_distance = (isset($_REQUEST['search_distance']) ? $_REQUEST['search_distance'] : $this->directorys_options['map_geolocation_default_distance']);

        $this->count = (isset($_REQUEST['count']) ? $_REQUEST['count'] : '');
        $this->sort_by = (isset($_REQUEST['sort-by']) ? $_REQUEST['sort-by'] : '');
        $this->sort = (isset($_REQUEST['sort']) ? $_REQUEST['sort'] : '');

    }

    public function get_page_type() {

        if (is_home()) {
            $this->page_type = 'index';
            return;
        }

        if (is_singular('post')) {
            $this->page_type = 'post_single';
            return;
        }

        if (is_singular('site')) {
            $this->page_type = 'site_single';
        }

        if (is_archive()) {
            $this->page_type = 'post_archive';
            return;
        }

        if (is_post_type_archive('site')) {
            $this->page_type = 'site_archive';
            return;
        }

        if (is_search() && get_query_var('search_post_type') == 'place') {
            $this->page_type = 'site_search';
            return;
        }

        if (is_search()) {
            $this->page_type = 'post_search';
            return;
        }

        if (is_page()) {
            $this->page_type = 'custom';
            return;
        }

        if (is_404()) {
            $this->page_type = 'page_404';
            return;
        }

    }

    public function display() {

        $this->get_page_type();

        $this->page_id = get_queried_object_id();

        if($this->page_type != 'custom') {

            if ( isset($this->directorys_options['top_section_on_' . $this->page_type]) && isset($this->directorys_options['top_section_on_' . $this->page_type]['map']) ) {

                $this->top_section = 'map';

            } else {
                $this->top_section = 'none';
            }

            if ( isset($this->directorys_options['top_section_on_' . $this->page_type]) && isset($this->directorys_options['top_section_on_' . $this->page_type]['filter_bar']) ) {
                $this->show_search_section = true;
            } else {
                $this->show_search_section = false;
            }

        } else {

            $this->top_section = get_post_meta($this->page_id, 'holo_page_top_section', true);
            $this->show_search_section = get_post_meta($this->page_id, 'holo_page_show_filter', true);

        }

        if ($this->top_section == 'map') {

            $this->display_map();

        } elseif ($this->top_section == 'slider') {

            $this->display_slider();

        }

        if ($this->show_search_section) {

            $this->display_search_section();

        }

    }

    public function display_slider() {

        // check if it is a custom page
        if ($this->page_id) {

            $slider = get_post_meta($this->page_id, 'holo_page_top_slider', true);

            ?>

            <div class="holo-main-slider">

                <?php

                if ( function_exists('putRevSlider') ) {
                    putRevSlider( $slider );
                }

                ?>

            </div>

        <?php
        }

    }

    public function display_search_section() {

        $site_categories_options_markup = '';
        $site_locations_options_markup = '';

        $site_cat_terms = get_terms('sites_category');
        $site_loc_terms = get_terms('sites_location');

        $site_categories_options_markup .= '<option value="" selected>' . __('All Categories', THEME_TEXT_DOMAIN) . '</option>';

        $site_cat_children = array();
        $site_cat_items = array();

        foreach($site_cat_terms as $term) {

            if ($term->parent != 0) {

                $term->name = '&nbsp;&nbsp;-' . $term->name;

                $site_cat_children[$term->parent][$term->term_id] = $term;

            } else {

                $site_cat_items[$term->term_id] = $term;

            }

        }

        foreach ($site_cat_items as $key => $item) {

            if (isset($site_cat_children[$key])) {
                foreach ($site_cat_children[$key] as $child_key => $child) {

                    $site_cat_items = array_insert_after($key, $site_cat_items, $child->term_id, $child);

                }
            }

        }

        foreach($site_cat_items as $term) {

            if ($this->search_category == $term->slug) {
                $site_categories_options_markup .= '<option value="' . $term->slug . '" selected>' . $term->name . '</option>';
            } else {
                $site_categories_options_markup .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
            }

        }

        $site_locations_options_markup .= '<option value="" selected>' . __('All Locations', THEME_TEXT_DOMAIN) . '</option>';

        $site_loc_children = array();
        $site_loc_items = array();

        foreach($site_loc_terms as $term) {

            if ($term->parent != 0) {

                $term->name = '&nbsp;&nbsp;-' . $term->name;

                $site_loc_children[$term->parent][$term->term_id] = $term;

            } else {

                $site_loc_items[$term->term_id] = $term;

            }

        }

        foreach ($site_loc_items as $key => $item) {

            if (isset($site_loc_children[$key])) {
                foreach ($site_loc_children[$key] as $child_key => $child) {

                    $site_loc_items = array_insert_after($key, $site_loc_items, $child->term_id, $child);

                }
            }

        }

        foreach ($site_loc_items as $key => $item) {

            if ($this->search_location == $item->slug) {
                $site_locations_options_markup .= '<option value="' . $item->slug . '" selected>' . $item->name . '</option>';
            } else {
                $site_locations_options_markup .= '<option value="' . $item->slug . '">' . $item->name . '</option>';
            }

        }

        ?>

        <div class="bgheader">
            <div class="container header">
                <form id="search-filter-form" role="search" method="get" class="search-form"
                      action="<?php echo esc_url(home_url('/')) ?>">
                    <div class="input">
                        <input type="search" class="textinput"
                               placeholder="<?php _e('Search keyword here', THEME_TEXT_DOMAIN) ?>..."
                               value="<?php echo trim(get_search_query()) ?>" name="s"
                               title="<?php _e('Search for', THEME_TEXT_DOMAIN) ?>:"/>
                        <input type="hidden" name="search_post_type" value="place"/>
                        <i class="fa fa-search"></i>
                    </div>
                    <div class="input dropdown">
                        <select id="google-map-location-filter" name="location" class="filter-dropdown custom-dropdown"
                                aria-invalid="false">
                            <?php echo $site_locations_options_markup ?>
                        </select>
                    </div>
                    <div class="input dropdown">
                        <select id="google-map-category-filter" name="category" class="filter-dropdown custom-dropdown"
                                aria-invalid="false">
                            <?php echo $site_categories_options_markup ?>
                        </select>
                    </div>

                    <?php if ( $this->use_geolocation && !$this->geolocation_always_active ) : ?>

                        <div class="bara">
                            <div id="slider" class="slider" data-popup-enabled="true"></div>
                            <input type="hidden" name="search_distance" value="<?php echo $this->search_distance ?>"/>
                        </div>

                        <div class="geolocation-use">
                            <input type="hidden" name="use_geolocation" value="" />
                            <i class="fa-check-empty"></i>
                            <i class="fa-check"></i>
                        </div>

                    <?php endif; ?>

                    <div class="search">
                        <input type="submit" id="searchsubmit" class="button solid main-bg-color" value="<?php _e('Search', THEME_TEXT_DOMAIN) ?>"/>
                    </div>

                    <input type="hidden" id="listings-filter-count" name="count" value="<?php echo $this->count ?>"/>
                    <input type="hidden" id="listings-filter-sort-by" name="sort-by" value="<?php echo $this->sort_by ?>"/>
                    <input type="hidden" id="listings-filter-sort" name="sort" value="<?php echo $this->sort ?>"/>
                    <input type="hidden" id="site-archive" value="<?php echo get_post_type_archive_link( 'site' ) ?>" />
                </form>
            </div>
        </div>

        <?php

    }

    public function display_map() {

        wp_enqueue_script('ht-google-map', HOLO_INCLUDES_DIR_URI . '/js/google-map.js', array(), false, true);

        ?>

        <div class="map">
            <div id="main-map-canvas"></div>
        </div>

        <?php

    }

    /**
     * Returns an array of Sites
     *
     * @return array
     */
    public function get_sites() {

        $s = $this->search;

        $sites = array();

        if ( !isset($s) ) { $s = ''; }
        if ($s === ' ') { $s = ''; }

        $category_query = (!empty($this->search_category) ? ' & sites_category=' . $this->search_category : '');
        $location_query = (!empty($this->search_location) ? ' & sites_location=' . $this->search_location : '');

        $search_query = new WP_Query( 'post_type=site & s=' . $s . ' & showposts=-1 ' . $category_query . $location_query . ''  );

        $searched_sites = array();

        if ($search_query->have_posts()) {
            while($search_query->have_posts()) {
                $search_query->the_post();

                $post = $search_query->post;

                $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');

                $site_categories = wp_get_post_terms($post->ID, 'sites_category');
                $site_locations = wp_get_post_terms($post->ID, 'sites_location');

                if (!empty($site_categories) && !is_object($site_categories)) {

                    $site_icon = get_option('taxonomy_' . $site_categories[0]->term_id);

                    $site_icon = $site_icon['pin'];

                    $site_category_id = $site_categories[0]->term_id;

                } else {

                    $site_icon = HOLO_INCLUDES_DIR_URI . '/admin/img/pin-default.png';

                    $site_category_id = 0;

                }

                $contact_fields = get_post_meta($post->ID, 'contact', true);
                $address_field = isset($contact_fields['address']) ? $contact_fields['address'] : array('value' => '');

                $site = array();

                $site['category'] = $site_category_id;
                $site['location'] = '';
                $site['lat'] = get_post_meta($post->ID, 'holo_site_lat_coords', true);
                $site['lng'] = get_post_meta($post->ID, 'holo_site_long_coords', true);
                $site['pin'] = $site_icon;
                $site['title'] = get_the_title($post->ID);
                $site['address'] = $address_field['value'];
                $site['permalink'] = get_the_permalink($post->ID);
                $site['thumb'] = $thumbnail[0];

                $sites[] = $site;
            }
        }

//        print_r($sites);
        return $sites;

    }

}