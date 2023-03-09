<?php

/**
 * Class Page_Tamer_Meta_Box
 *
 * This class contains a set of functions that register and handle the meta box required for the page builder
 *
 */
class Page_Tamer_Meta_Box {

    public function __construct() {

        add_action( 'admin_init', array(&$this, 'register_page_tamer_meta_box') );
        add_action( 'save_post', array(&$this, 'save_post') );

    }

    /**
     * Registers the meta box
     */
    public function register_page_tamer_meta_box() {

        $screens = array('page', 'post', 'site');

        foreach ($screens as $screen) {
            add_meta_box(
                'page-tamer',
                'Page Tamer',
                array(&$this, 'create_page_tamer_metabox'),
                $screen,
                'normal',
                'high'
            );
        }

    }

    /**
     * Meta box registration callback
     * This function prepare the markup required for the page builder container
     */
    public function create_page_tamer_metabox() {

        global $post;

        $custom = get_post_custom($post->ID);

        if ( !empty($custom) ) {

        }

        ?>

        <div class="loading-screen" style="margin: 100px auto; height: 32px; width: 32px;">
            <img src="<?php echo HOLO_FRAMEWORK_DIR_URI ?>/page-tamer/css/img/preloader.gif" height="32" width="32" />
        </div>

        <div class="page-tamer-items-pane clearfix">

        </div>

        <div class="page-tamer-container">

            <div class="holo-planner-buttons">

                <button id="holo-new-row" class="button-primary">New Row</button>

            </div>

            <div class="holo-planner-workspace"></div>

            <!--<div id="list-form" class="white-popup-block">

                <h1>List Form</h1>

                <fieldset style="border:0;">
                    <ol></ol>

                    <button class="save-button">Save List</button>
                </fieldset>
            </div>

            <div id="list-item-form" class="white-popup-block">

                <h1>List Item Form</h1>

                <fieldset style="border:0;">
                    <ol></ol>

                    <button class="save-item-button">Save List Item</button>
                </fieldset>
            </div>

            <div id="button-form" class="white-popup-block">

                <h1>Button Form</h1>

                <fieldset style="border:0;">
                    <ol></ol>

                    <button class="save-button">Save Button</button>
                </fieldset>
            </div>-->

        </div>

    <?php
    }

    /**
     * This function is used by the "save_post" WordPress hook
     */
    public function save_post($post_id) {
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return;
        }

        if ( isset($_POST['post_type'])) {
            if ('page' != $_POST['post_type']) {
              return;
            }
        }

        return;

    }

}