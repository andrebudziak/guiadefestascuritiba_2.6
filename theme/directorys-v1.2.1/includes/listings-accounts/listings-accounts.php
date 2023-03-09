<?php

function sync_packages() {

    $old_packages = get_option('ht_user_roles');
    $new_packages = get_option('ht_packages');

    if (count($new_packages) <= 1) {

        $new_account_options_array = array();

		if ($old_packages && is_array($old_packages)) {
				
        	foreach ($old_packages as $package_slug => $package) {

	            $new_account_options_array[$package_slug] = array(
	                'account_name' => $package['account_name'],
	                'account_price' => $package['account_price'],
	                'account_max_items' => $package['account_max_items'],
	                'account_expiration_time' => $package['account_expiration_time'],
	                'cap' => array(
	                    'content' => 1,
	                    'page_builder' => 1,
	                    'contact' => 1,
	                    'schedule' => 1,
	                    'custom_fields' => 1,
	                    'ratings' => 1,
	                    'assign_taxonomy' => 1,
	                    'add_taxonomy' => 1
	                )
	            );

	            $updated_user_role = get_role($package_slug);

	            if ($updated_user_role) {
	                $updated_user_role->add_cap('ht_use_editor');
	                $updated_user_role->add_cap('ht_use_page_builder');
	                $updated_user_role->add_cap('ht_use_contact');
	                $updated_user_role->add_cap('ht_use_schedule');
	                $updated_user_role->add_cap('ht_use_custom_Fields');
	                $updated_user_role->add_cap('ht_use_ratings');
	                $updated_user_role->add_cap('ht_assign_listings_terms');
	                $updated_user_role->add_cap('ht_edit_listings_terms');
	            }

	        }

		}

        update_option('ht_packages', $new_account_options_array);

    }

//    print_r($new_account_options_array);

}

//Change the user role to all users that have the role 'ht_listings_accounts' (deprecated role)
function ht_change_user_roles() {

    global $wpdb;
    $listing_accounts_table_name = $wpdb->prefix . 'ht_listing_accounts';

    $users = get_users(array(
         'role' => 'ht_listings_account'
    ));

    foreach($users as $user) {

        $user_obj = new WP_User($user->ID);

        $user_info = $wpdb->get_results( "SELECT * FROM $listing_accounts_table_name WHERE user_id = $user->ID", ARRAY_A );

        $user_info = $user_info[0];

        $role = $user_info['account_type'];

        $user_obj->add_role($role);
        $user_obj->remove_role('ht_listings_account');

    }

}

function ht_add_default_role() {

    remove_role('ht-default-package');

    add_role(
        'ht-default-package',
        __('Default Package'),
        array(
            'publish_locations' => true,
            'edit_location' => true,
            'delete_location' => true,
            'edit_published_locations' => true,
            'edit_locations' => true,
            'read' => true,
            'upload_files' => true,
            'delete_published_locations' => true,
            'ht_use_editor' => true,
            'ht_use_page_builder' => true,
            'ht_use_contact' => true,
            'ht_use_schedule' => true,
            'ht_use_custom_Fields' => true,
            'ht_use_ratings' => true,
            'ht_assign_listings_terms' => true,
            'ht_edit_listings_terms' => true,
        )
    );


}

$updated_user_role = get_role('ht_listings_full_account');

if ($updated_user_role) {
    $updated_user_role->add_cap('delete_locations');
	$updated_user_role->add_cap('delete_published_locations');
}

function ht_get_accounts_select_markup() {

    $return_markup = '';
    $options_markup = '';

    $custom_roles = get_option( 'ht_packages' );
    $paypal_settings = get_option('ht_paypal_settings');
    $currency_symbol = isset($paypal_settings['paypal_currency_symbol']) ? $paypal_settings['paypal_currency_symbol'] : '';

    unset($custom_roles['ht-default-package']);

    if (is_array($custom_roles) && count($custom_roles) > 1) {
        foreach ($custom_roles as $role_slug => $role) {

            if ($role['account_price'] == 0) {

                $options_markup .= '<option value="' . $role_slug . '">' . $role['account_name'] . '&nbsp;&nbsp;(free)</option>';

            } else {

                $options_markup .= '<option value="' . $role_slug . '">' . $role['account_name'] . '&nbsp;&nbsp;(' . $currency_symbol . $role['account_price'] . ')</option>';

            }

        }

        $return_markup .= '<select name="user_account_type" id="user-account-type">';

        $return_markup .= $options_markup;

        $return_markup .= '</select>';

    } elseif ( !empty($custom_roles) && count($custom_roles) == 1 ) {

        foreach ($custom_roles as $role_slug => $role) {

            return '<input type="text" class="form-control" value="' . $role['account_name'] . '&nbsp;&nbsp;($' . $role['account_price'] . ')" disabled />
                <input type="hidden" name="user_account_type" value="' . $role_slug . '" />';

        }

    } else {

        return '<input type="hidden" name="user_account_type" value="ht-default-package" />';

    }

    return $return_markup;

}

function ht_new_user_notification($user_id, $plaintext_pass = '') {

    $user = new WP_User( $user_id );

    $user_login = stripslashes( $user->user_login );
    $user_email = stripslashes( $user->user_email );

    $message  = sprintf( __('New user registration on %s:'), get_option('blogname') ) . "\r\n\r\n";
    $message .= sprintf( __('Username: %s'), $user_login ) . "\r\n\r\n";
    $message .= sprintf( __('E-mail: %s'), $user_email ) . "\r\n";

    @wp_mail(
        get_option('admin_email'),
        sprintf(__('[%s] New User Registration'), get_option('blogname') ),
        $message
    );

    if ( empty( $plaintext_pass ) )
        return;

    $message  = __('Hi there,') . "\r\n\r\n";
    $message .= sprintf( __("Welcome to %s! Here's how to log in:"), get_option('blogname')) . "\r\n\r\n";
    $message .= wp_login_url() . "\r\n";
    $message .= sprintf( __('Username: %s'), $user_login ) . "\r\n";
    $message .= sprintf( __('Password: %s'), $plaintext_pass ) . "\r\n\r\n";
    $message .= sprintf( __('If you have any problems, please contact me at %s.'), get_option('admin_email') ) . "\r\n\r\n";
    $message .= __('Adios!');

    wp_mail(
        $user_email,
        sprintf( __('[%s] Your username and password'), get_option('blogname') ),
        $message
    );

}

add_action( 'wp_ajax_register_user', 'holo_register_user');
add_action( 'wp_ajax_nopriv_register_user', 'holo_register_user' );

function holo_register_user() {

    global $wpdb;
    $listing_accounts_table_name = $wpdb->prefix . 'ht_listing_accounts';

    $return_data = '';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $account_type = $_POST['account_type'];

    $password = wp_generate_password();

    if (!get_option('users_can_register')) {

        $return_data['error'] = '
            <div class="alert alert-warning">
                    <i class="fa fa-attention pull-left"></i>
                    <div class="text">Users cannot register at this time!</div>
                </div>
        ';

        $json_string = json_encode($return_data);

        echo $json_string;

        die();

    }

    if (!function_exists('curl_version')) {

        $return_data['error'] = '
            <div class="alert alert-danger">
                    <i class="fa fa-attention-circled pull-left"></i>
                    <div class="text">Error! Please contact the administrator.</div>
                </div>
        ';

        $json_string = json_encode($return_data);

        echo $json_string;

        die();

    }

    if (empty($account_type)) {

        $return_data['error'] = '
            <div class="alert alert-warning">
                    <i class="fa fa-attention pull-left"></i>
                    <div class="text">You need to select a package in order to register!</div>
                </div>
        ';

        $json_string = json_encode($return_data);

        echo $json_string;

        die();

    }

    if ( is_email($email) ) {

        $user_id = wp_create_user($username, $password, $email);

        if ($account_type != 'ht-default-package') {

            $accounts_meta = get_option('ht_packages');

        } else {

            $accounts_meta = get_option('ht_default_package');

        }

//        print_r($accounts_meta);

        if (is_object($user_id)) {

            foreach ($user_id->errors as $error => $error_message) {

                $return_data['error'] = '<div class="alert alert-danger">
                        <i class="fa fa-attention-circled pull-left"></i>
                        <div class="text">' . $error_message[0] . '</div>
                    </div>';

            }

        } else {

            $user = new WP_User($user_id);
            $user->set_role($account_type);

            ht_new_user_notification($user_id, $password);

            $credentials['user_login'] = $username;
            $credentials['user_password'] = $password;

            $user_sign = wp_signon($credentials, false);

            $end_days = $accounts_meta[$account_type]['account_expiration_time'];
            $listings_cap = $accounts_meta[$account_type]['account_max_items'];
            $account_price = $accounts_meta[$account_type]['account_price'];

            if ($end_days == 0) {
                $end_date = 0;
            } else {
                $end_date = time() + ($end_days * 24 * 60 * 60);
            }

            if ($account_price == 0) {

                $result = $wpdb->insert(
                    $listing_accounts_table_name,
                    array(
                        'user_id' => $user_id,
                        'account_type' => $account_type,
                        'listings_cap' => $listings_cap,
                        'account_price' => $account_price,
                        'create_date' => current_time( 'mysql' ),
                        'update_date' => current_time( 'mysql' ),
                        'end_date' =>  date( 'Y-m-d H:i:s', $end_date),
                        'payment_check' => 1
                    )
                );

            } else {

                $result = $wpdb->insert(
                    $listing_accounts_table_name,
                    array(
                        'user_id' => $user_id,
                        'account_type' => $account_type,
                        'listings_cap' => $listings_cap,
                        'account_price' => $account_price,
                        'create_date' => current_time( 'mysql' ),
                        'update_date' => current_time( 'mysql' ),
                        'end_date' =>  date( 'Y-m-d H:i:s', $end_date)
                    )

                );

            }

            if ($result == 0) {

                $return_data['error'] =
                    '<div class="alert alert-danger">
                        <i class="fa fa-attention-circled pull-left"></i>
                        <div class="text">Due to some unknown errors, your account couldn\'t be created!</div>
                    </div>';

            } else {

                if ($account_price == 0)  {

                    $return_data['paypal_url'] = admin_url( 'profile.php');

                } else {

                    $page_url = 'http';
                    if(isset($_SERVER['HTTPS']))
                    {
                        if ($_SERVER["HTTPS"] == "on")
                        {
                            $page_url .= 's';
                        }
                    }
                    $page_url .= '://' . $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

                    $args = array(
                        'account_type' => $account_type,
                        'return_url' => admin_url( 'profile.php'),
                        'cancel_url' => admin_url( 'profile.php')
                    );

                    $paypal_url = holo_paypal_process($args);

                    if ($paypal_url !== false) {
                        $return_data['paypal_url'] = $paypal_url;
                    } else {
                        $return_data['error'] = '
                        <div class="alert alert-danger">
                            <i class="fa fa-attention-circled pull-left"></i>
                            <div class="text">Due to some unknown errors, your payment couldn\'t be processed!</div>
                        </div>';
                    }

                }

            }

            $return_data['user_id'] = $user_id;
            $return_data['amount'] = $account_price;

        }

    } else {

        $return_data['error'] = '<div class="alert alert-danger">
                <i class="fa fa-attention-circled pull-left"></i>
                <div class="text">Please insert a valid e-mail!</div>
            </div>';

    }

    $json_string = json_encode($return_data);

    echo $json_string;

    die();

}