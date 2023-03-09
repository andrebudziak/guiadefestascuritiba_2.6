<?php

// the class that registers the meta box required for the page builder
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/class-meta-box.php' );

// the abstract class of the registered shortcodes
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/class-abstract-shortcodes.php');

// shortcodes classes
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/row.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/column.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/list.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/list_item.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/button.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/tabs.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/tab.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/text.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/accordion.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/accordion_item.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/testimonials.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/testimonial.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/content_box.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/counters.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/counter.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/persons.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/person.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/divider.php');
//require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/social.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/parteners.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/partener.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/gallery.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/icon_content.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/pricing_table.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/pricing_table_row.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/sites.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/best_sites.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/blog.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/latest_posts.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/callout.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/progress_bars.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/progress_bar.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/message_box.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/form.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/media.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/sidebar.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/login_form.php');
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/shortcodes/register_form.php');

// the page builder class
require_once( HOLO_FRAMEWORK_DIR . '/page-tamer/class-page-tamer.php' );