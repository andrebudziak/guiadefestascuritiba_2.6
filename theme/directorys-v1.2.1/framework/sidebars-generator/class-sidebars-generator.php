<?php

/**
 * Class holo_sidebar_generator
 *
 * This class contains the functions needed for the widget area
 */
class holo_sidebars_generator
{
    var $paths     = array();
    var $sidebars  = array();
    var $store_index    = '';

    /** constructor */
    function __construct()
    {
        $this->store_index = 'holo_sidebars';
//        $this->title          = THEMENAME ." ". __('Custom Widget Area','avia_framework');

        add_action('load-widgets.php', array(&$this, 'load_assets') , 5 );
        add_action('load-widgets.php', array(&$this, 'add_sidebar_area'), 100);
        add_action('admin_print_scripts', array(&$this, 'show_sidebar_form') );
        add_action('widgets_init', array(&$this, 'register_custom_sidebars') , 1000 );
        add_action('wp_ajax_delete_custom_sidebar', array(&$this, 'holo_delete_custom_sidebar') , 1000 );
        add_action('wp_ajax_nopriv_delete_custom_sidebar', array(&$this, 'holo_delete_custom_sidebar') , 1000 );
    }

    /** load the required scripts and styles */
    function load_assets()
    {
        wp_enqueue_script('holo_sidebar_js' , get_template_directory_uri() . '/framework/sidebars-generator/script.js', array(), false, true);
        wp_enqueue_style( 'holo_sidebar_css' , get_template_directory_uri() . '/framework/sidebars-generator/style.css');
    }

    /** add form markup */
    function show_sidebar_form() {
        $nonce = wp_create_nonce ('holo-delete-custom-sidebar-nonce');
        $nonce = '<input type="hidden" name="holo-delete-custom-sidebar-nonce" value="'.$nonce.'" />';

        echo '<script type="text/html" id="holo-custom-sidebar-form-script">';
        echo '<div class="holo-custom-sidebar-form-wrapper">';
        echo '<p>Here you can create a new sidebar area.</p>';
        echo
            '<form id="holo-form-new-sidebar" method="post">
                <input type="text" name="holo_sidebar_name" value="" />
                <input type="submit" name="sidebar_submit" value="Create Sidebar" />
            </form>';
        echo $nonce;
        echo '</div>';
        echo '</script>';
    }

    /** store the sidebar to the database */
    function add_sidebar_area()
    {
        if(!empty($_POST['holo_sidebar_name']))
        {
            $this->sidebars = get_option($this->store_index);
            $name           = $this->validate_name($_POST['holo_sidebar_name']);

            if(empty($this->sidebars))
            {
                $this->sidebars = array($name);
            }
            else
            {
                $this->sidebars = array_merge($this->sidebars, array($name));
            }

            update_option($this->store_index, $this->sidebars);
            wp_redirect( admin_url('widgets.php') );
            die();
        }
    }

    //delete a sidebar area from the database
    function holo_delete_custom_sidebar()
    {
//        check_ajax_referer('holo-delete-custom-sidebar-nonce');

        if ( !empty($_POST['name']) )
        {
            $name = stripslashes($_POST['name']);
            $this->sidebars = get_option($this->store_index);

            if( ($key = array_search($name, $this->sidebars)) !== false )
            {
                unset($this->sidebars[$key]);
                update_option($this->store_index, $this->sidebars);
                echo $name . " sidebar deleted";
            } else {
                echo 'name: "' . $name . '"';



                die('<br />sidebar deletion error<br />' . json_encode($this->sidebars));
            }
        }

        die();
    }



    //checks the user submitted name and makes sure that there are no identical names
    function validate_name($name)
    {
        $name = trim($name);

        if(empty($GLOBALS['wp_registered_sidebars'])) return $name;

        // an array filled with all existing sidebars names
        $registered = array();

        foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar )
        {
            $registered[] = $sidebar['name'];
        }

        if(empty($this->sidebars)) $this->sidebars = array();
        $registered = array_merge($registered, $this->sidebars);

        if(in_array($name, $registered))
        {
            $counter  = substr($name, -1);

            if(!is_numeric($counter))
            {
                $new_name = $name . " 1";
            }
            else
            {
                $new_name = substr($name, 0, -1) . ((int) $counter + 1);
            }

            $name = $this->validate_name($new_name);
        }

        return $name;
    }



    //register custom sidebar areas
    function register_custom_sidebars()
    {
        if(empty($this->sidebars)) $this->sidebars = get_option($this->store_index);

        $args = array(
            'class' => 'holo-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="divider divider-1"><h3>',
            'after_title' => '</h3><div class="separator"></div></div>'
        );

        if(is_array($this->sidebars))
        {
            foreach ($this->sidebars as $sidebar)
            {
                $args['name'] = $sidebar;
                register_sidebar($args);
            }
        }
    }
}

new holo_sidebars_generator;
