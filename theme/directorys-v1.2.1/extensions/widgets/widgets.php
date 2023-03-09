<?php
/**
 * Default Widgets
 *
 * @package WordPress
 * @subpackage Widgets
 */

holo_add_widgets();

function holo_add_widgets() {
    include_once(HOLO_TEMPLATEDIR . '/extensions/widgets/class-flickr-widget.php');
    include_once(HOLO_TEMPLATEDIR . '/extensions/widgets/class-twitter-widget.php');
    include_once(HOLO_TEMPLATEDIR . '/extensions/widgets/class-widget-contact-info.php');
    include_once(HOLO_TEMPLATEDIR . '/extensions/widgets/class-widget-post-tabs.php');
    include_once(HOLO_TEMPLATEDIR . '/extensions/widgets/class-widget-search.php');
    include_once(HOLO_TEMPLATEDIR . '/extensions/widgets/class-widget-recent-comments.php');
    include_once(HOLO_TEMPLATEDIR . '/extensions/widgets/class-widget-text.php');
    include_once(HOLO_TEMPLATEDIR . '/extensions/widgets/class-widget-facebook-like-box.php');
    include_once(HOLO_TEMPLATEDIR . '/extensions/widgets/class-widget-recent-posts.php');
    include_once(HOLO_TEMPLATEDIR . '/extensions/widgets/class-widget-terms.php');
    include_once(HOLO_TEMPLATEDIR . '/extensions/widgets/class-widget-custom-menu.php');
    include_once(HOLO_TEMPLATEDIR . '/extensions/widgets/class-widget-calendar.php');
    include_once(HOLO_TEMPLATEDIR . '/extensions/widgets/class-widget-shortcode.php');
    include_once(HOLO_TEMPLATEDIR . '/extensions/widgets/class-widget-login-form.php');
}

add_action('widgets_init', 'holo_register_corex_widgets');

function holo_register_corex_widgets() {
	register_widget('Holo_Widget_Contact_Info');
	register_widget('Holo_Widget_Post_Tabs');
	register_widget('Holo_Widget_Search');
	register_widget('Holo_Widget_Recent_Comments');
    register_widget('Holo_Widget_Text');
    register_widget('Holo_Widget_Facebook_Like_Box');
    register_widget('Holo_Widget_Recent_Posts');
    register_widget('Holo_Widget_Terms');
    register_widget('Holo_Widget_Custom_Menu');
    register_widget('Holo_Widget_Calendar');
    register_widget('Holo_Widget_Shortcode');
    register_widget('Holo_Widget_Login_Form');
    register_widget('Holo_Widget_Flickr');
}
