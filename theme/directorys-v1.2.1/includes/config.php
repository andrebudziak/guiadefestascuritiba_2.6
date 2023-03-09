<?php

class Hb_Config {

    public function __construct() {
        /**
         * Set the content. This is needed for different plugins
         */
        global $content_width;

        if ( !isset($content_width) ) {
            $content_width = 540;
        }

        /**
         * add translation folder
         */
        define( 'THEME_TEXT_DOMAIN', 'holo' );

        load_theme_textdomain( THEME_TEXT_DOMAIN, HOLO_TEMPLATEDIR . '/includes/languages' );

        add_action( 'init', array($this, 'register_menus') );
        add_action( 'wp_head', array($this, 'set_ajax_url') );
        add_filter( 'query_vars', array($this, 'add_query_var') );

        $this->register_theme_support();
        $this->register_menus();
        $this->register_sidebars();
        $this->init_images_sizes();
    }

    public function register_theme_support() {
        add_theme_support('post-thumbnails');
        add_theme_support( 'automatic-feed-links' );

        add_theme_support( 'post-formats', array( 'video', 'gallery' ) );

        add_post_type_support('site', 'post-formats');
    }

    public function init_images_sizes() {
        add_image_size('site_thumb', 274, 199, true);
        add_image_size('best_site_thumb', 259, 161, true);
        add_image_size('portfolio_thumb', 600, 554, true);
        add_image_size('post_image', 1200, 518, true);
        add_image_size('preview_gallery', 555, 403, true);

//        add_image_size('image-boxes', 360, 192, true);
//        add_image_size('latest-posts-thumb', 263, 175, true);
//        add_image_size('gallery-thumb', 164, 164, true);
//        add_image_size('blog-classic', 1140, 460, true);
//        add_image_size('blog-thumbnail', 774, 277, true);
//        add_image_size('blog-grid', 557, 364, true);
//        add_image_size('blog-personal', 920, 612, true);
//        add_image_size('blog-timeline', 267, 176, true);
//        add_image_size('portfolio-classic', 555, 403, true);
//        add_image_size('portfolio-fancy', 563, 367, true);
//        add_image_size('portfolio-list', 555, 298, true);
//        add_image_size('portfolio-masonry', 292, 244, true);
//        add_image_size('portfolio-masonry-long', 585, 244, true);
//        add_image_size('portfolio-masonry-tall', 292, 489, true);
//        add_image_size('portfolio-full-width', 306, 260, true);
    }

    function register_sidebars() {
        register_sidebar(array(
            'name' => 'Default Sidebar',
            'id' => 'default-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="divider divider-1"><h3>',
            'after_title' => '</h3><div class="separator"></div></div>'
        ));

        register_sidebar(array(
            'name' => 'Post Sidebar',
            'id' => 'post-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="divider divider-1"><h3>',
            'after_title' => '</h3><div class="separator"></div></div>'
        ));

	    register_sidebar(array(
		    'name' => 'Footer Widgets',
		    'id' => 'footer-widgets',
            'before_widget' => '<div id="%1$s" class="widget %2$s col-sm-3 main-el">',
            'after_widget' => '</div>',
            'before_title' => '<div class="divider divider-5"><h3>',
            'after_title' => '</h3><div class="separator"></div></div>'
	    ));
    }

    function set_ajax_url() {
        ?>
        <script type="text/javascript">
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>

    <?php
    }

    function register_menus() {
        register_nav_menus(
            array(
                'top_bar_navigation' => __( 'Top Bar Navigation' ),
                'header_navigation' => __( 'Header Navigation' )
            )
        );
    }

    /**
     * add new query var
     */
    function add_query_var($vars) {

        $vars[] = "search_post_type";
        return $vars;

    }

}

