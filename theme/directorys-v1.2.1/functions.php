<?php

define( 'HOLO_TEMPLATEDIR',  get_template_directory() );
define( 'HOLO_TEMPLATE_DIR_URI', get_template_directory_uri());

define( 'HOLO_FRAMEWORK_DIR', HOLO_TEMPLATEDIR . '/framework');
define( 'HOLO_FRAMEWORK_DIR_URI', HOLO_TEMPLATE_DIR_URI . '/framework');

include_once( HOLO_TEMPLATEDIR . '/includes/enqueue-scripts.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/config.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/helper_functions.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/custom-post-types/sites.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/meta-boxes/class-usage-demo.php' );
//include_once( HOLO_TEMPLATEDIR . '/includes/meta-boxes/dynamic-metaboxes.php' );
include_once( HOLO_TEMPLATEDIR . '/extensions/Header_Nav_Walker.php' );
include_once( HOLO_TEMPLATEDIR . '/extensions/Side_Menu_Nav_Walker.php' );
include_once( HOLO_TEMPLATEDIR . '/extensions/Top_Bar_Nav_Walker.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/admin/pages/importer.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/admin/pages/rating-sets.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/admin/pages/roles.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/imageSmoothArc_optimized.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/listings-accounts/db-create.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/listings-accounts/class-paypal.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/listings-accounts/paypal-process.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/listings-accounts/listings-accounts.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/listings-accounts/listings-user-admin.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/class-google-map.php' );
include_once( HOLO_TEMPLATEDIR . '/includes/listings-accounts/check-paypal-credentials.php' );

new Hb_Config();

include_once( HOLO_FRAMEWORK_DIR . '/font-loader/font-loader.php');
include_once( HOLO_FRAMEWORK_DIR . '/hextorgb.php');
include_once( HOLO_FRAMEWORK_DIR . '/helper_functions.php');
include_once( HOLO_FRAMEWORK_DIR . '/page-tamer/page-tamer.php');
include_once( HOLO_FRAMEWORK_DIR . '/sidebars-generator/class-sidebars-generator.php' );
include_once( HOLO_FRAMEWORK_DIR . '/options/class-options-config.php' );
//include_once( HOLO_FRAMEWORK_DIR . '/breadcrumbs/Breadcrumbs.php' );
//include_once( HOLO_FRAMEWORK_DIR . '/post-loader/post-loader.php' );
//include_once( HOLO_FRAMEWORK_DIR . '/kk-i-like-it/admin.php' );
//include_once( HOLO_FRAMEWORK_DIR . '/share-buttons/share-buttons.php' );
include_once( HOLO_FRAMEWORK_DIR . '/auto_importer/holo_importer.php' );

include_once( HOLO_TEMPLATEDIR . '/extensions/widgets/widgets.php' );

include_once( HOLO_FRAMEWORK_DIR . '/class-holo.php');
include_once( HOLO_FRAMEWORK_DIR . '/pagination.php');
include_once( HOLO_FRAMEWORK_DIR . '/tgm-plugin/recommended-plugins.php');
include_once( HOLO_FRAMEWORK_DIR . '/ratings/ratings.php');
include_once( HOLO_FRAMEWORK_DIR . '/development/devmode.php');
include_once( HOLO_FRAMEWORK_DIR . '/dynamic-meta-boxes/dynamic-meta-boxes.php');
include_once( HOLO_FRAMEWORK_DIR . '/dynamic-meta-boxes/contact-dynamic-meta-box.php');

//add_action( 'admin_init', 'ht_add_custom_fields_callback' );

add_action( 'admin_init', 'ht_add_custom_fields_callback');

function ht_add_custom_fields_callback() {

    $contact = new HT_Contact_Dynamic_Meta_Box('contact', array(
        'id' => 'site_contact',
        'title' => 'Contact',
        'post_type' => 'site',
        'context' => 'normal',
        'priority' => 'high'
    ));

    $custom_fields = new HT_Dynamic_Meta_Boxes('site_custom_fields', array(
        'id' => 'custom_fields',
        'title' => 'Custom Fields',
        'post_type' => 'site',
        'context' => 'normal',
        'priority' => 'high'
    ));

}

//holo_register_meta_boxes();

// initialize visual composer
//include_once( HOLO_TEMPLATEDIR . '/js_composer/js_composer.php' );

//Holo_Track::start();

//set_theme_mod('theme_nav_location', 'cicireli');
//$locations = get_theme_mods();
//
//print_r($locations);

holo_add_admin_menus();

add_action( 'admin_head', 'fb_add_tinymce' );
function fb_add_tinymce() {
	global $typenow;

	// only on Post Type: post and page
//	if( ! in_array( $typenow, array( 'post', 'page' ) ) )
//		return ;

	add_filter( 'mce_external_plugins', 'fb_add_tinymce_plugin' );
	// Add to line 1 form WP TinyMCE
	add_filter( 'mce_buttons', 'fb_add_tinymce_button' );
}

function fb_add_tinymce_plugin( $plugin_array ) {

	$plugin_array['fb_test'] = get_template_directory_uri() . '/framework/page-tamer/js/mce_sc_button.js';
	return $plugin_array;
}

function fb_add_tinymce_button($buttons) {
	array_push($buttons, "fb_test");
	return $buttons;
}

// set editor to 'visual' state
add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );

add_action( 'wp_ajax_google_map_marker', 'ht_google_map_marker');

function ht_google_map_marker() {

    // ex. http://dev.holobest.com/gicqsldy/wp-content/uploads/2013/10/work011.png
    $file_url = $_POST['file_url'];
    $hex_color = $_POST['hex_color'];
    $tag_id = $_POST['tag_id'];

    $rgb = hex2rgb($hex_color);

    $exploded_file_url = explode('/', $file_url);

    $file_name = $exploded_file_url[ count($exploded_file_url) - 1 ];

    $exploded_file_name = explode('.', $file_name);

    $name = $exploded_file_name[0];
    $ext = $exploded_file_name[1];

    $width = 100;

    $file_folder_array = explode('uploads/', $file_url);
    $file_folder = $file_folder_array[1];

    $upload_dir_paths = wp_upload_dir();

    $icon_path = $upload_dir_paths['basedir'] . '/' . $file_folder;

    $pin_src = HOLO_TEMPLATEDIR . '/includes/admin/img/pin.png';

    $pin_dest = $upload_dir_paths['path'] . '/pin-' . $tag_id . '.png';
    $badge_dest = $upload_dir_paths['path'] . '/badge-' . $tag_id . '.' . $ext;

//    resize_image($icon_path, $width);

    $circle_image = ht_make_image_circle($icon_path, $badge_dest, $rgb);

    $pin_image = ht_merge_images($pin_src, $circle_image, $pin_dest);

    $circle_src = HOLO_TEMPLATEDIR . '/includes/admin/img/circle.png';

    $final_circle_image = ht_create_circle_image($circle_src, $circle_image, $badge_dest);

    $return['pin_url'] = $upload_dir_paths['url'] . '/pin-' . $tag_id . '.png';
    $return['badge_url'] = $upload_dir_paths['url'] . '/badge-' . $tag_id . '.' . $ext;

    echo json_encode($return);
    die();

}

function ht_make_image_circle($img_path, $save_path, $badge_color, $width = false) {
    // Created by NerdsOfTech *please keep creation reference *

// Step 1 - Start with image as layer 1 (canvas).
    $img1 = imagecreatefrompng($img_path);

    if ($width !== false) {
        $x = $width;
        $y = $width;
    } else {

        $x = imagesx($img1);
        $y = imagesy($img1);

    }

// Step 3 - Create the ellipse OR circle mask.
//    $e = imagecolorallocate($img2, $badge_color[0], $badge_color[1], $badge_color[2]); // black mask color
//    $black = imagecolorallocate($img2, 0, 0, 0);

    // Step 2 - Create a blank image.
    $img2 = imageCreateTrueColor( 39, 39 );
    imagealphablending($img2,true);
    $color = imageColorAllocate( $img2, 255, 255, 255);
    imagefill( $img2, 0, 0, $color );

    // third party function that creates a smooth elipses
    imageSmoothArc ( $img2, 36/2, 38/2, 34, 34, array($badge_color[0], $badge_color[1], $badge_color[2], 0), 0, 2*M_PI );

// Step 4 - Make shape color transparent
//    imagecolortransparent($img2, $color);

    //~ imagefill($img1, 0, 0, $bg);

// Step 5 - Make shape color transparent
    //~ imagecopymerge($img1, $img2, 0, 0, 0, 0, $x, $y, 100);
    imagecopyresampled($img2, $img1, 1, 0, 0, 0, $x, $y, $x, $y);

// Step 6 - Make outside frame color transparent
    imagecolortransparent($img2, $color);

// Step 7 - Output merged image
    //~ header("Content-type: image/png"); // output header
    //~ imagepng($img1); // output merged image

//    imagefilter($img2, IMG_FILTER_GAUSSIAN_BLUR);
//    imagefilter($img2,IMG_FILTER_CONTRAST,-50);

    imagepng($img2, $save_path);


// Step 8 - Cleanup memory
    imagedestroy($img2); // kill mask first
    imagedestroy($img1); // kill canvas last

    return $save_path;
}

function ht_merge_images($bg_img, $img, $img_dest) {
    $pin = imagecreatefrompng( $bg_img );
    $icon = imagecreatefrompng( $img );

    $width  = imagesx($icon);
    $height = imagesy($icon);

//    $overlay = imagecreatetruecolor(40, 40);
//    $black = imagecolorallocate($overlay, 255, 0, 0);
//    imagefill($overlay, 0, 0, $black);

    imagealphablending($pin, true);
    imagesavealpha($pin, true);

    imagecopymerge($pin, $icon, 4, 5, 0, 0, $width, $width, 100);

    imagepng($pin, $img_dest);

    imagedestroy($pin);
    imagedestroy($icon);

    return $img_dest;
}

function ht_create_circle_image($bg_img, $img, $img_dest) {

    $pin = imagecreatefrompng( $bg_img );
    $icon = imagecreatefrompng( $img );

    $width  = imagesx($icon);
    $height = imagesy($icon);

//    $overlay = imagecreatetruecolor(40, 40);
//    $black = imagecolorallocate($overlay, 255, 0, 0);
//    imagefill($overlay, 0, 0, $black);

    imagealphablending($pin, true);
    imagesavealpha($pin, true);

    imagecopymerge($pin, $icon, 5, 5, 0, 0, $width, $width, 100);

    imagepng($pin, $img_dest);

    imagedestroy($pin);
    imagedestroy($icon);

    return $img_dest;

}

add_action( 'after_switch_theme', 'ht_theme_setup' );

function ht_theme_setup() {

    holo_create_rating_tables();

    ht_add_default_role();

    ht_create_listing_accounts_tables();

    ht_change_user_roles();

    sync_packages();
}

add_filter( 'request', 'ht_my_request_filter' );

function ht_my_request_filter( $query_vars ) {
    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }

    return $query_vars;
}



if ( version_compare(phpversion(), '5.4.0', '>=') ) {
    if (session_status() == PHP_SESSION_NONE) { session_start(); }
} else {
    if (session_id() === '') { session_start(); }
}

if(isset($_GET["token"]) && isset($_GET["PayerID"]))
{
    //we will be using these two variables to execute the "DoExpressCheckoutPayment"
    //Note: we haven't received any payment yet.

    $paypal_settings = get_option('ht_paypal_settings');

    $token = $_GET["token"];
    $payer_id = $_GET["PayerID"];

    //get session variables
    $ItemName 			= $_SESSION['ItemName']; //Item Name
    $ItemPrice 			= $_SESSION['ItemPrice'] ; //Item Price
    $ItemNumber 		= $_SESSION['ItemNumber']; //Item Number
    $ItemDesc 			= $_SESSION['ItemDesc']; //Item Number
    $ItemQty 			= $_SESSION['ItemQty']; // Item Quantity
    $ItemTotalPrice 	= $_SESSION['ItemTotalPrice']; //(Item Price x Quantity = Total) Get total amount of product;
    $TotalTaxAmount 	= $_SESSION['TotalTaxAmount'] ;  //Sum of tax for all items in this order.
    $HandalingCost 		= $_SESSION['HandalingCost'];  //Handling cost for this order.
    $InsuranceCost 		= $_SESSION['InsuranceCost'];  //shipping insurance cost for this order.
    $ShippinDiscount 	= $_SESSION['ShippinDiscount']; //Shipping discount for this order. Specify this as negative number.
    $ShippinCost 		= $_SESSION['ShippinCost']; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.
    $GrandTotal 		= $_SESSION['GrandTotal'];

    $PayPalMode 			= 'live';
    $PayPalCurrencyCode 	= $paypal_settings['paypal_currency'];
    $PayPalApiUsername 		= $paypal_settings['paypal_username']; //PayPal API Username
    $PayPalApiPassword 		= $paypal_settings['paypal_password']; //Paypal API password
    $PayPalApiSignature 	= $paypal_settings['paypal_signature']; //Paypal API Signature

    $padata = 	'&TOKEN='.urlencode($token).
        '&PAYERID='.urlencode($payer_id).
        '&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").

        //set item info here, otherwise we won't see product details later
        '&L_PAYMENTREQUEST_0_NAME0='.urlencode($ItemName).
        '&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($ItemNumber).
        '&L_PAYMENTREQUEST_0_DESC0='.urlencode($ItemDesc).
        '&L_PAYMENTREQUEST_0_AMT0='.urlencode($ItemPrice).
        '&L_PAYMENTREQUEST_0_QTY0='. urlencode($ItemQty).

        /*
        //Additional products (L_PAYMENTREQUEST_0_NAME0 becomes L_PAYMENTREQUEST_0_NAME1 and so on)
        '&L_PAYMENTREQUEST_0_NAME1='.urlencode($ItemName2).
        '&L_PAYMENTREQUEST_0_NUMBER1='.urlencode($ItemNumber2).
        '&L_PAYMENTREQUEST_0_DESC1=Description text'.
        '&L_PAYMENTREQUEST_0_AMT1='.urlencode($ItemPrice2).
        '&L_PAYMENTREQUEST_0_QTY1='. urlencode($ItemQty2).
        */

        '&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemTotalPrice).
        '&PAYMENTREQUEST_0_TAXAMT='.urlencode($TotalTaxAmount).
        '&PAYMENTREQUEST_0_SHIPPINGAMT='.urlencode($ShippinCost).
        '&PAYMENTREQUEST_0_HANDLINGAMT='.urlencode($HandalingCost).
        '&PAYMENTREQUEST_0_SHIPDISCAMT='.urlencode($ShippinDiscount).
        '&PAYMENTREQUEST_0_INSURANCEAMT='.urlencode($InsuranceCost).
        '&PAYMENTREQUEST_0_AMT='.urlencode($GrandTotal).
        '&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode);

    //We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
    $paypal= new Holo_Paypal();
    $httpParsedResponseAr = $paypal->PPHttpPost('DoExpressCheckoutPayment', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

    //Check if everything went ok..
    if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
    {

//        echo '<h2>Success</h2>';
//        echo 'Your Transaction ID : '.urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);

        /*
        //Sometimes Payment are kept pending even when transaction is complete.
        //hence we need to notify user about it and ask him manually approve the transiction
        */

//        if('Completed' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
//        {
//            echo '<div style="color:green">Payment Received! Your product will be sent to you very soon!</div>';
//        }
//        elseif('Pending' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
//        {
//            echo '<div style="color:red">Transaction Complete, but payment is still pending! '.
//                'You need to manually authorize this payment in your <a target="_new" href="http://www.paypal.com">Paypal Account</a></div>';
//        }

        // we can retrive transection details using either GetTransactionDetails or GetExpressCheckoutDetails
        // GetTransactionDetails requires a Transaction ID, and GetExpressCheckoutDetails requires Token returned by SetExpressCheckOut
        $padata = 	'&TOKEN='.urlencode($token);
        $paypal= new Holo_Paypal();
        $httpParsedResponseAr = $paypal->PPHttpPost('GetExpressCheckoutDetails', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

        if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
        {

            global $wpdb;

            $listing_accounts_table_name = $wpdb->prefix . 'ht_listing_accounts';
            $user_id = get_current_user_id();

            $wpdb->update(
                $listing_accounts_table_name,
                array(
                    'payment_check' => '1'
                ),
                array( 'user_id' => $user_id ),
                array(
                    '%d'	// value2
                ),
                array( '%d' )
            );

//            echo '<br /><b>Stuff to store in database :</b><br /><pre>';
            /*
            #### SAVE BUYER INFORMATION IN DATABASE ###
            //see (http://www.sanwebe.com/2013/03/basic-php-mysqli-usage) for mysqli usage

            $buyerName = $httpParsedResponseAr["FIRSTNAME"].' '.$httpParsedResponseAr["LASTNAME"];
            $buyerEmail = $httpParsedResponseAr["EMAIL"];

            //Open a new connection to the MySQL server
            $mysqli = new mysqli('host','username','password','database_name');

            //Output any connection error
            if ($mysqli->connect_error) {
                die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
            }

            $insert_row = $mysqli->query("INSERT INTO BuyerTable
            (BuyerName,BuyerEmail,TransactionID,ItemName,ItemNumber, ItemAmount,ItemQTY)
            VALUES ('$buyerName','$buyerEmail','$transactionID','$ItemName',$ItemNumber, $ItemTotalPrice,$ItemQTY)");

            if($insert_row){
                print 'Success! ID of last inserted record is : ' .$mysqli->insert_id .'<br />';
            }else{
                die('Error : ('. $mysqli->errno .') '. $mysqli->error);
            }

            */

//            echo '<pre>';
//            print_r($httpParsedResponseAr);
//            echo '</pre>';
        } else  {
            echo '<div style="color:red"><b>GetTransactionDetails failed:</b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
            echo '<pre>';
            print_r($httpParsedResponseAr);
            echo '</pre>';

        }

    }else{
        echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
        echo '<pre>';
        print_r($httpParsedResponseAr);
        echo '</pre>';
    }
}

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function ht_wp_title( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }

    global $page, $paged;

    // Add the blog name
    $title .= get_bloginfo( 'name', 'display' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
    }

    // Add a page number if necessary:
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
    }

    return $title;
}
add_filter( 'wp_title', 'ht_wp_title', 10, 2 );

//add_action('wp_ajax_get_map_settings', 'ajax_get_map_settings');
//add_action('wp_ajax_nopriv_get_map_settings', 'ajax_get_map_settings');
//
//function ajax_get_map_settings() {
//
//    $settings = array();
//
//    $settings['map_lat'] = 'lat';
//    $settings['map_long'] = 'long';
//
//    echo json_encode($settings);
//    die();
//
//}

$under_header = '';

add_action ('init', 'init_google_map');

function init_google_map() {
    global $under_header;

    $under_header = HT_Google_Map::get_instance();
}

function wpse35165_role_check()
{
    $custom_cap = 'name_of_your_custom_capability';

    $html = "<hr /><table>";
    $html .= "<caption>List roles in (Blog)</caption>";
    $html .= "<thead><tr><th>Role Name</th><th>Capabilties</th></tr></thead><tbody>";
    foreach ( $GLOBALS['wp_roles'] as $name => $role_obj )
    {

        foreach ($role_obj as $role_name => $role_array) {

            var_dump($role_array);

            $cap = in_array( $custom_cap, $role_array['capabilities'] ) ? $custom_cap : 'n/a';
            $cap = $cap OR in_array( $custom_cap, $role_obj->allcaps ) ? $custom_cap : 'n/a';

        }

        $html .= "<tr><td>{$name}</td><td>{$cap}</td></tr>";
    }
    $html .= '</tbody></table>';

    print $html;
}
//add_action( 'shutdown', 'wpse35165_role_check' );

//$custom_cap = 'name_of_your_custom_capability';
//
//$html = "<hr /><table>";
//$html .= "<caption>List roles</caption>";
//$html .= "<thead><tr><th>Role Name</th><th>Capabilties</th></tr></thead><tbody>";
//foreach ( $GLOBALS['wp_roles'] as $name => $role_obj )
//{
//    print_r($role_obj);
//
//    foreach ($role_obj as $role_name => $role_array) {
//
//        $cap = in_array( $custom_cap, $role_obj['name'] ) ? $custom_cap : 'n/a';
//        $cap = $cap OR in_array( $custom_cap, $role_obj->allcaps ) ? $custom_cap : 'n/a';
//
//    }
//
//    $html .= "<tr><td>{$name}</td><td>{$cap}</td></tr>";
//
//}
//$html .= '</tbody></table>';
//
//echo $html;

add_action( 'do_meta_boxes', 'hide_user_features', 999 );

function hide_user_features() {

//    $updated_user_role = get_role($account_name_slug);

    if ( !current_user_can('manage_options') ) {

        if ( !current_user_can('ht_use_editor') ) {
            remove_post_type_support('site', 'editor');
        }

        if ( !current_user_can('ht_use_page_builder') ) {
            remove_meta_box('page-tamer', 'site', 'normal');
        }

        if ( !current_user_can('ht_use_contact') ) {
            remove_meta_box('site_contact', 'site', 'normal');
        }

        if ( !current_user_can('ht_use_schedule') ) {
            remove_meta_box('site_schedule', 'site', 'normal');
        }

        if ( !current_user_can('ht_use_custom_Fields') ) {
            remove_meta_box('custom_fields', 'site', 'normal');
        }

        if ( !current_user_can('ht_use_ratings') ) {
            remove_meta_box('site_show_rating', 'site', 'normal');
        }

    }

}

$administrator     = get_role('administrator');

$administrator->add_cap('ht_edit_listings_terms');
$administrator->add_cap('ht_assign_listings_terms');

function ht_handle_duplicate_titles_for_sites($new_status, $old_status, $post) {
    // verify this is not an auto save routine.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

    //You should check nonces and permissions here
    if ( !current_user_can( 'edit_page', $post->ID ) )
        return;

    if ($post->post_type != 'site')
        return;

    if ( $new_status !== 'publish' )
        return;

    global $wpdb;

    $return = $wpdb->get_results( "SELECT ID FROM wp_posts WHERE post_title = '" . $post->post_title . "' && post_status = 'publish' && post_type = 'site' ", 'ARRAY_N' );

    if( count( $return ) > 1 ) {

        $post->post_status = 'draft';
        wp_update_post($post);

        $message_string = '
            A Listing with the same name already exists.<br />
            Your listing will be saved as draft. <br /><br />
            <a href="' . get_admin_url() . 'edit.php?post_type=site">&laquo;Go Back</a>';

        wp_die($message_string);

    }
}

add_action('transition_post_status','ht_handle_duplicate_titles_for_sites', 10, 3);

function ht_handle_duplicate_coordinates_for_sites ($post_id, $post, $update) {

    // verify this is not an auto save routine.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

    //You should check nonces and permissions here
    if ( !current_user_can( 'edit_page', $post->ID ) )
        return;

    if ($update == 0)
        return;

    if ($post->post_type != 'site')
        return;

    $this_site_lat = get_post_meta($post_id, 'holo_site_lat_coords', true);
    $this_site_long = get_post_meta($post_id, 'holo_site_long_coords', true);

    global $wpdb;
    $sites = $wpdb->get_results( "SELECT ID FROM wp_posts WHERE post_status = 'publish' && post_type = 'site' ", 'ARRAY_N' );

    $duplicate_coords = false;
    foreach ($sites as $site) {

        $site_id = $site[0];

        $site_lat = get_post_meta($site_id, 'holo_site_lat_coords', true);
        $site_long = get_post_meta($site_id, 'holo_site_long_coords', true);

        if ( $this_site_long != 0 && $this_site_lat != 0 && $this_site_long == $site_long && $this_site_lat == $site_lat && $post_id != $site_id ) {

            $duplicate_coords = true;

        }

    }

    if ($duplicate_coords) {

        $post->post_status = 'draft';

        // Check if this post is not a revision
        if ( ! wp_is_post_revision( $post_id ) ) {

            // unhook this function so it doesn't loop infinitely
            remove_action('wp_insert_post', 'ht_handle_duplicate_coordinates_for_sites');

            // update the post, which calls save_post again
            wp_update_post( $post );

            // re-hook this function
            add_action('wp_insert_post', 'ht_handle_duplicate_coordinates_for_sites');
        }

        $message_string = '
            A Listing with the same coordinates already exists.<br />
            Your listing will be saved as draft. <br /><br />
            <a href="' . get_admin_url() . 'edit.php?post_type=site">&laquo;Go Back</a>';

        wp_die($message_string);

    }

}

add_action('wp_insert_post', 'ht_handle_duplicate_coordinates_for_sites', 10, 3);