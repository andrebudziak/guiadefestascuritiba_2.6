<?php

/**
 * Class Page_Tamer
 *
 * This class contains functions required for the page builder handlers
 */
class Page_Tamer {

    public $container_shgoogle_map_markerortcode = array('holo_row', 'holo_column');

    public $allowed_shortcodes = array();

    public $shortcodes;

    public $columns;

    public $columns_structures;

    public static $pattern;

    protected static $instance = NULL;

    /**
     * Constructor
     */
    public function __construct() {

        $this->attach_shortcodes();

        $this->register_columns();
        $this->register_columns_structures();

        foreach ( $this->shortcodes as $shortcode_id => $shortcode ) {

            $this->allowed_shortcodes[] = $shortcode_id;

        }

        add_action( 'admin_enqueue_scripts', array($this, 'holo_add_page_tamer_scripts') );

        add_action('wp_ajax_holo_shortcodes_to_markup', array($this,'holo_shortcodes_to_markup'));
        add_action('wp_ajax_holo_get_shortcodes_objects', array($this,'holo_get_shortcodes_objects'));
        add_action('wp_ajax_holo_get_element_data', array($this,'get_element_data'));
        add_action('wp_ajax_holo_get_columns', array($this, 'get_columns'));
        add_action('wp_ajax_holo_get_columns_structures', array($this, 'get_columns_structures'));
        add_action('wp_ajax_holo_parse_shortcode', array($this, 'parse_shortcode'));
        add_action('wp_ajax_holo_get_row_attributes', array($this, 'get_row_attributes'));
        add_action('wp_ajax_holo_get_color_palettes', array($this, 'get_color_palettes'));
	    add_action('wp_ajax_holo_get_editor', array($this, 'get_editor'));
//        add_action( 'after_wp_tiny_mce', array($this,'holo_after_tiny') );

        new Page_Tamer_Meta_Box();

    }

	public function get_editor() {
		$content = '';
		$editor_id = $_POST['id'];

		wp_editor( $content, $editor_id );

		exit();
	}

    public static function get_instance() {

        // create an object
        NULL === self::$instance and self::$instance = new self;

        return self::$instance; // return the object
    }

    public function get_color_palettes() {

        if ( isset($_POST['color_palette']) ) {

            $palettes_options = get_option('holo_color_palettes');

            $palette = $palettes_options[$_POST['color_palette']];

            echo json_encode($palette);

            exit();
        }

        return 0;

    }

    /**
     * Attaches all the shortcodes classes that inherits from the Holo_Abstract_Shortcode class
     */
    public function attach_shortcodes() {

        $classes = array();

        $declared_classes = get_declared_classes();

        foreach ( $declared_classes as $declared_class ) {

            if ( is_subclass_of($declared_class, 'Holo_Abstract_Shortcodes') ) {

                $classes[$declared_class] = new $declared_class;

                $shortcode_name = $classes[$declared_class]->name;

            }

        }

        $this->shortcodes = $classes;

    }

    /**
     * This function is used by "admin_enqueue_scripts" WordPress hook
     *
     * This function enqueue all the required page builder styles and scripts
     */
    public function holo_add_page_tamer_scripts() {

        wp_enqueue_style( 'page-tamer', HOLO_TEMPLATE_DIR_URI . '/framework/page-tamer/css/page-tamer.css' );
        wp_enqueue_style( 'custom-scrollbar', HOLO_TEMPLATE_DIR_URI . '/framework/page-tamer/vendors/custom-scrollbar/jquery.mCustomScrollbar.css' );

        wp_enqueue_script( 'jquery-ui-selectable' );
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( 'jquery-ui-droppable' );

        wp_enqueue_script( 'custom-scrollbar', HOLO_TEMPLATE_DIR_URI . '/framework/page-tamer/vendors/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js', array(), false, true );
        wp_enqueue_script( 'page-tamer-media-upload', HOLO_TEMPLATE_DIR_URI . '/framework/page-tamer/js/media-upload.js', array(), false, true );
        wp_enqueue_script( 'page-tamer-helper-functions', HOLO_TEMPLATE_DIR_URI . '/framework/page-tamer/js/helper-functions.js', array(), false, true );
        wp_enqueue_script( 'page-tamer-color-palette', HOLO_TEMPLATE_DIR_URI . '/framework/page-tamer/js/jquery.color-palette.js', array(), false, true );
        wp_enqueue_script( 'page-tamer-socialform', HOLO_TEMPLATE_DIR_URI . '/framework/page-tamer/js/jquery.socialform.js', array(), false, true );
        wp_enqueue_script( 'page-tamer-holo-modal', HOLO_TEMPLATE_DIR_URI . '/framework/page-tamer/js/jquery.holo-modal.js', array(), false, true );
        wp_enqueue_script( 'page-tamer-templates', HOLO_TEMPLATE_DIR_URI . '/framework/page-tamer/js/templates.js', array(), false, true );
        wp_enqueue_script( 'page-tamer-behaviour', HOLO_TEMPLATE_DIR_URI . '/framework/page-tamer/js/behaviour.js', array(), false, true );
        wp_enqueue_script( 'page-tamer-input-fields', HOLO_TEMPLATE_DIR_URI . '/framework/page-tamer/js/input-fields.js', array(), false, true );
        wp_enqueue_script( 'page-tamer-shortcodes-generator', HOLO_TEMPLATE_DIR_URI . '/framework/page-tamer/js/shortcodes-generator.js', array(), false, true );
        wp_enqueue_script( 'page-tamer', HOLO_TEMPLATE_DIR_URI . '/framework/page-tamer/js/page-tamer.js', array(), false, true );

        wp_localize_script( 'page-tamer', 'tamer_locale', array(
            'main_switch_button' => __('Page Tamer', THEME_TEXT_DOMAIN),
            'main_switch_button_close' => __('Default Editor', THEME_TEXT_DOMAIN),
        ) );

    }

    public function holo_get_shortcodes_objects() {

        $shortcodes_elements = array();

        foreach ( $this->shortcodes as $class=>$shortcode ) {

            $shortcodes_elements[$class] = $shortcode;

        }

        echo json_encode($shortcodes_elements);

        exit();

    }

    public function get_element_data() {

        if ( isset($_POST['element_id']) ) {

            $element_id = $_POST['element_id'];

        }

        echo json_encode($this->shortcodes[$element_id]);

        exit();

    }

    /**
     * This function is used by "wp_ajax_holo_shortcodes_to_markup" WordPress hook
     *
     * It takes the WordPress editor text and check for page builder afferent shortcodes
     */
    public function holo_shortcodes_to_markup() {

        global $shortcode_tags;

//        $shortcode_tags = array_flip(array_merge($this->allowed_shortcodes, $this->container_shortcode));

        Page_Tamer::$pattern = get_shortcode_regex();

        if ( isset($_POST['text']) ) {

            $text = $_POST['text'];

            $text_nodes = preg_split("/" . Page_Tamer::$pattern . "/s", $text);

//            echo $text;

//            print_r($text_nodes);

            foreach ($text_nodes as $node) {

                // if the node is not empty, wrap the registered shortcodes with the page tamer block shortcodes
                if( strlen( trim( $node ) ) == 0 || strlen( trim( strip_tags($node) ) ) == 0) {

                    $escaped_node = preg_quote($node, '/');

                    $patterns = array();
                    $replacements = array();

                    // Check if it's a closing tag
                    if (preg_match('/^<\//', $node)) {

                        $patterns[0] = "/(\]" . $escaped_node . ")/";
//                        $patterns[1] = "/(" . $escaped_node . "\[(?!\[\/))/";

                        $replacements[0] = "]";
//                        $replacements[1] = "[";

                    } else {

                        $patterns[0] = "/(" . $escaped_node . "\[\/)/";
                        $patterns[1] = "/(\]" . $escaped_node . ")/";
                        $patterns[2] = "/(" . $escaped_node . "\[)/";

                        $replacements[0] = "[/";
                        $replacements[1] = "]";
                        $replacements[2] = "[";

                    }

                    // if the not text is not inside another shortcode, wrap it with the afferent block shortcodes
                    $text = preg_replace($patterns, $replacements, $text);

                }  else {

                    $escaped_node = preg_quote($node, '/');

                    // if the not text is not inside another shortcode, wrap it with the afferent block shortcodes
                    $text = preg_replace("/(" . $escaped_node . "(?!\[\/))/", '[holo_row][holo_column size="col-sm-12"]$1[/holo_column][/holo_row]', $text);

                }

            }

//            echo $text;

        }

        // check if the text has any registered shortcodes in it
        $do_shortcode_return = $this->check_for_shortcodes($text);

        echo stripslashes($do_shortcode_return);

        exit();

    }

    public function check_for_shortcodes($text) {

        return preg_replace_callback( "/" . Page_Tamer::$pattern . "/s", array(&$this, 'do_shortcode_tag'), $text);

    }

    /**
     * Callback function for "check_for_shortcodes" function
     * For each page builder registered shortcodes, returns the afferent markup required for the page builder interface.
     *
     * @param $match
     * @return string
     */
    public function do_shortcode_tag($match) {

        global $shortcode_tags;

        //check for enclosing tag or self closing
        $values['closing'] 	= strpos($match[0], '[/' . $match[2] . ']');
        $values['content'] 	= $values['closing'] !== false ? $match[5] : NULL;
        $values['tag']		= $match[2];
        $values['attr']		= shortcode_parse_atts( stripslashes($match[3]) );

        if ( $values['tag'] == 'holo_row' ) {

            $content = $this->simple_text_to_element($values['content']);

            if ( $content ) {
                $content = $this->check_for_shortcodes($content);
            }

            $columns_markup = '';

            foreach ( $this->columns_structures as $columns_structure ) {

                $columns_markup .= '<li class="columns-structure" data-structure="' . $columns_structure['structure'] . '">' . $columns_structure['name'] . '</li>';

            }

            $attributes_string = '';

            if ( !empty($values['attr']) ) {
                foreach ( $values['attr'] as $attribute => $value ) {

                    $attributes_string .= ' ' . $attribute . '="' . $value . '"';

                }
            }

            return
                '<div class="holo-row holo-sortable" data-element-id="holo_row">
                    <div class="row-header clearfix">
                        <ul class="row-columns-structure clearfix">
                            ' . $columns_markup . '
                        </ul>
                        <div class="element-delete"><i class="linecons-trash-1"></i></div>
                        <div class="element-settings"><i class="linecons-cog-1"></i></div>
                    </div>
                    <div class="row-content clearfix">
                        ' . $content . '
                    </div>
                    <div class="element-shortcode" style="display: none">[' . $values['tag'] . $attributes_string . ']</div>
                </div>';

        } elseif ($values['tag'] == 'holo_column') {

            $content = $this->simple_text_to_element($values['content']);

            if ( $content ) {
                $content = $this->check_for_shortcodes($content);
            }

            return
                '<div class="holo-column ' . $values['attr']['size'] . '" data-size="' . $values['attr']['size'] . '">
                    <div class="column-body sortable-columns">
                        ' . $content . '
                    </div>
                 </div>';

        } else {

            foreach ($this->shortcodes as $shortcode_class => $shortcode) {

                if ( $shortcode_class == $values['tag'] ) {

                    $attributes_string = '';

                    $content = $values['content'];

                    if ( is_array($shortcode->attributes) ) {

                        foreach ( $shortcode->attributes as $attribute_id => $attribute ) {

                            $attributes_string .= ' ' . $attribute_id . '="' . $values['attr'][$attribute_id] . '"';

                        }

                        foreach ( $shortcode->style_atts as $attribute_id => $attribute) {

                            if ( isset($values['attr'][$attribute_id]) ) {
                                $attributes_string .= ' ' . $attribute_id . '="' . $values['attr'][$attribute_id] . '"';
                            }

                        }
                    }

                    if ( isset($values['attr']['unique_id']) ) {
                        $attributes_string .= ' unique_id="' . $values['attr']['unique_id'] . '"';
                    }

                    if ( null !== $shortcode->children_class ) {

                        $content = $values['content'];

                    }


                    return
                        '<div class="holo-element" data-element-id="' . $shortcode_class . '">
                            <div class="element-header">
                                <div class="element-drag">
                                    <i class="fa-menu"></i>
                                </div>
                                <span class="shortcode-title"></span>
                                <div class="element-delete"><i class="linecons-trash-1"></i></div>
                                <div class="element-duplicate"><i class="fa-docs"></i></div>
                            </div>
                            <div class="element-body">
                                <i class="' . $shortcode->admin_icon . '"></i>
                                <span class="shortcode-title">' . $shortcode->name . '</span>
                            </div>
                            <div class="element-shortcode" style="display: none">[' . $values['tag'] . $attributes_string . ']' . $content . '[/' . $values['tag'] . ']</div>
                        </div>';

                }

            }

        }

    }

    /**
     * Checks the given text for snippets of text that are not surrounded by any page builder shortcodes
     * and surround it with "[holo_text]" element shortcodes
     *
     * @param $text
     * @return string
     */
    public function simple_text_to_element($text) {

        $content_array = preg_split("/" . Page_Tamer::$pattern . "/s", $text);

        $content = '';

        $content_string = implode('', $content_array);

        if ( trim(strip_tags($content_string)) == '' ) {
            return $text;
        }

        foreach ( $content_array as $content_node ) {

            if( strlen( trim( $content_node ) ) == 0 || strlen( trim( strip_tags($content_node) ) ) == 0) {

            } else {

                $escaped_node = preg_quote($content_node, '/');

                // if the not text is not inside another shortcode, wrap it with the afferent block shortcodes
                $content_text = preg_replace("/(" . $escaped_node . "(?!\[\/))/", '[holo_text]$1[/holo_text]', $text);

                $content .= $content_text;
            }

        }

        return $content;

    }

    /**
     * function that sets the default values and passes them to the user defined editor element
     * which in turn returns the array with the properties to render a new AviaBuilder Canvas Element
     */
    public function prepare_editor_element($content = "", $args = array())
    {
        //set the default content unless it was already passed
        if(empty($content))
        {
            $content = $this->get_default_content($content);
        }

        //set the default arguments unless they were already passed
        if(empty($args))
        {
            $args = $this->get_default_args($args);
        }

        if(isset($args['content'])) unset($args['content']);

        $params['content']   = $content;
        $params['args']      = $args;
        $params['data']      = isset($this->config['modal_data']) ? $this->config['modal_data'] : "";

        //fetch the parameter array from the child classes editor_element function which should descripe the html code
        $params =  $this->editor_element($params);

        // pass the parameters to the create_sortable_editor_element unless a different function for execution was set.
        // if the function is set to "false" we asume that the output is final
        if(!isset($this->config['html_renderer']))
        {
            $this->config['html_renderer'] = "create_sortable_editor_element";
        }

        if($this->config['html_renderer'] != false)
        {
            $output = call_user_func(array($this, $this->config['html_renderer']) , $params );
        }
        else
        {
            $output = $params;
        }

        return $output;
    }

    /**
     *creates the shortcode pattern that only matches Avia Builder Shortcodes
     **/
    static function build_pattern($predefined_tags = false)
    {
        global $shortcode_tags;

        //save the "real" shortcode array
        $old_sc = $shortcode_tags;

        //if we got allowed shortcodes build the pattern. nested shortcodes are also considered but within a separate array
//        if(!empty(ShortcodeHelper::$allowed_shortcodes))
//        {
//            $shortcode_tags = array_flip(array_merge(ShortcodeHelper::$allowed_shortcodes, ShortcodeHelper::$nested_shortcodes));
//        }

        //filter out all elements that are not in the predefined tags array. this is necessary for nested shortcode modal to work properly
        if(is_array($predefined_tags))
        {
            $predefined_tags = array_flip($predefined_tags);
            $shortcode_tags = shortcode_atts($predefined_tags, $shortcode_tags);
        }

        //create the pattern and store it
        ShortcodeHelper::$pattern = get_shortcode_regex();

        //restore original shortcode tags
        $shortcode_tags = $old_sc;

        return ShortcodeHelper::$pattern;
    }

    public function register_columns() {

        $this->columns = array(
            array(
                'id' => 'one-third',
                'name' => 'One Third',
                'html_class' => 'one-third'
            ),
            array(
                'id' => 'two-thirds',
                'name' => 'Two Thirds',
                'html_class' => 'two-thirds'
            ),
            array(
                'id' => 'one-half',
                'name' => 'One Half',
                'html_class' => 'one-half'
            )
        );

        foreach ( $this->columns as $column ) {



        }

    }

    public function get_columns() {

        ob_clean();

        echo json_encode($this->columns);

        die();

    }

    public function register_columns_structures() {

        $this->columns_structures = array(
            array(
                'structure' => 'col-sm-12',
                'name' => '1'
            ),
            array(
                'structure' => 'col-sm-4|col-sm-4|col-sm-4',
                'name' => '1/3 + 1/3 + 1/3'
            ),
            array(
                'structure' => 'col-sm-6|col-sm-6',
                'name' => '1/2 + 1/2'
            ),
            array(
                'structure' => 'col-sm-8|col-sm-4',
                'name' => '2/3 + 1/3'
            ),
            array(
                'structure' => 'col-sm-3|col-sm-3|col-sm-3|col-sm-3',
                'name' => '1/4 + 1/4 + 1/4 + 1/4'
            ),
            array(
                'structure' => 'col-sm-4|col-sm-8',
                'name' => '1/3 + 2/3'
            ),
        );

    }

    public function get_columns_structures() {

        echo json_encode($this->columns_structures);

        die();

    }

    public function parse_shortcode() {

        Page_Tamer::$pattern = get_shortcode_regex();

        $attributes_array = array();

        if ( isset($_POST['shortcode']) ) {

            $shortcode = $_POST['shortcode'];

            $shortcode_attr = preg_replace_callback( "/" . Page_Tamer::$pattern . "/s", array(&$this, 'get_shortcode_attributes'), $shortcode);

            $shortcode_content = $this->parse_shortcode_content($shortcode);

        }

        $attributes = shortcode_parse_atts($shortcode_attr);

        $shortcode_tag = strip_tags($this->parse_shortcode_tag($shortcode));

        if ( !empty($attributes) ) {
            foreach ( $attributes as $attribute => $value ) {

                $obj_attr = $this->shortcodes[$shortcode_tag]->get_atts();

                $attributes_array[$attribute]['type'] = $obj_attr[$attribute]['type'];
                $attributes_array[$attribute]['value'] = $value;

                if ( isset($obj_attr[$attribute]['dependencies']) ) {
                    $attributes_array[$attribute]['dependencies'] = $obj_attr[$attribute]['dependencies'];
                }

            }

            if ( isset($attributes['unique_id']) && !empty($attributes['unique_id'])  ) {
                $shortcode_obj['unique_id'] = $attributes['unique_id'];
            } else {
                $shortcode_obj['unique_id'] = '';
            }
        }

        $shortcode_obj['shortcode'] = $shortcode_tag;

        $shortcode_obj['attributes'] = $attributes_array;
        $shortcode_obj['content'] = stripslashes($shortcode_content);

        if ($shortcode_tag == 'holo_text') {

            /* remove empty p tags */

            $pattern = "/<p[^>]*><\\/p[^>]*>/";

            $shortcode_obj['content'] = preg_replace($pattern, '', $shortcode_obj['content']);

//            echo $shortcode_obj['content'];

        }

        if ( !empty($shortcode_obj['content']) ) {

            $shortcode_obj['children'] = preg_replace_callback( "/" . Page_Tamer::$pattern . "/s", array(&$this, 'get_shortcode_children'), $shortcode_obj['content']);

        }

        foreach ( $this->shortcodes as $shortcode_id => $shortcode ) {

            if ( $shortcode_id == $shortcode_tag ) {

                $shortcode_obj['children_class'] = $shortcode->children_class;

            }

        }

	    ob_end_clean();

        echo json_encode( $shortcode_obj );

        exit();

    }

    public function get_shortcode_children($match) {

        $values['closing'] 	= strpos($match[0], '[/' . $match[2] . ']');
        $values['content'] 	= $values['closing'] !== false ? $match[5] : NULL;
        $values['tag']		= $match[2];
        $values['attr']		= shortcode_parse_atts( stripslashes($match[3]) );

        foreach ($this->shortcodes as $shortcode_class => $shortcode) {

            if ( $shortcode_class == $values['tag'] ) {

                $content = $values['content'];

                $attributes_string = '';

                if ( is_array($shortcode->attributes) ) {

                    foreach ( $shortcode->attributes as $attribute_id => $attribute ) {

                        $attributes_string .= ' ' . $attribute_id . '="' . $values['attr'][$attribute_id] . '"';

                    }

                }

                return
                    '<a class="holo-child" href="#' . $shortcode_class . '-form" rel="leanModal" data-element-id="' . $shortcode_class . '">
                        <div class="child-body">
                            <div class="element-delete"><i class="linecons-trash-1"></i></div>
                            <span class="child-shortcode-title">' . $shortcode->name . '</span>
                        </div>
                        <div class="child-shortcode" style="display: none">[' . $values['tag'] . $attributes_string . ']' . $content . '[/' . $values['tag'] . ']</div>
                    </a>';

            }

        }

    }

    public function get_row_attributes() {

        Page_Tamer::$pattern = get_shortcode_regex();

        if ( isset($_POST['shortcode']) ) {

            $shortcode = $_POST['shortcode'];

            $shortcode_attr = preg_replace_callback( "/" . Page_Tamer::$pattern . "/s", array(&$this, 'get_shortcode_attributes'), $shortcode);

        }

        $attributes = shortcode_parse_atts($shortcode_attr);

        if ( !empty($attributes) ) {
            foreach ( $attributes as $attribute => $value ) {

                $attributes_array[$attribute]['type'] = 'text';
                $attributes_array[$attribute]['value'] = $value;

            }
        }

        echo json_encode( $attributes_array );

        exit();

    }

    public function get_shortcode_attributes($match) {

        //check for enclosing tag or self closing
        $values['closing'] 	= strpos($match[0], '[/' . $match[2] . ']');
        $values['content'] 	= $values['closing'] !== false ? $match[5] : NULL;
        $values['tag']		= $match[2];
        $values['attr']		= shortcode_parse_atts( stripslashes($match[3]) );

        return stripslashes($match[3]);

    }

    public function parse_shortcode_tag($shortcode) {

        Page_Tamer::$pattern = get_shortcode_regex();

        $shortcode_tag = preg_replace_callback( "/" . Page_Tamer::$pattern . "/s", array(&$this, 'get_shortcode_tag'), $shortcode);

        return $shortcode_tag;

    }

    public function get_shortcode_tag($match) {

        return $match[2];

    }

    public function parse_shortcode_content($shortcode) {

        Page_Tamer::$pattern = get_shortcode_regex();

        $shortcode_content = preg_replace_callback(
            "/" . Page_Tamer::$pattern . "/s",
            function ($matches) {
                return $matches[5];
            },
            $shortcode
        );

        return $shortcode_content;
    }

}

add_action( 'init', array( 'Page_Tamer', 'get_instance' ));