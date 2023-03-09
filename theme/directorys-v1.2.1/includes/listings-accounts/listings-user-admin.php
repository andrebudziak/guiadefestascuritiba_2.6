<?php

define('NO_PAYMENT', 1);
define('EXPIRED_ACCOUNT', 2);
define('FULL_ACCOUNT', 3);

add_action( 'wp_ajax_user_repay', 'holo_user_repay');
add_action( 'wp_ajax_nopriv_user_repay', 'holo_user_repay' );

function holo_user_repay() {

    global $wpdb;

    $return_data = array();

    $listing_accounts_table_name = $wpdb->prefix . 'ht_listing_accounts';
    $user_id = get_current_user_id();

    $user_info = $wpdb->get_results( "SELECT * FROM $listing_accounts_table_name WHERE user_id = $user_id", ARRAY_A );

    $account_type =$user_info[0]['account_type'];

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

    $json_string = json_encode($return_data);

    echo $json_string;

    die();

}

add_action( 'show_user_profile', 'ht_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'ht_extra_user_profile_fields' );

function ht_extra_user_profile_fields( $user ) {

    global $wpdb;

    $listing_accounts_table_name = $wpdb->prefix . 'ht_listing_accounts';
    $user_id = get_current_user_id();
    $account_types = get_option('ht_packages');

    $user_info = $wpdb->get_results( "SELECT * FROM $listing_accounts_table_name WHERE user_id = $user_id", ARRAY_A );

    $submitted_listings =  count( get_posts( array(
        'post_type' => 'site',
        'author'    => get_current_user_id(),
        'nopaging'  => true, // display all posts
    ) ) );

    if (isset($user_info[0])) {

        $date1 = new DateTime();
        $date2 = new DateTime($user_info[0]['end_date']);
        $interval = $date1->diff($date2);

        $account_listings_cap = $account_types[$user_info[0]['account_type']]['account_max_items'];

        if (!empty($user_info)) {

            ?>

            <h3><?php _e("Listings profile information", "blank"); ?></h3>

            <table id="ht-profile-info" class="form-table">
                <tr>
                    <?php if ( !$interval->invert) : ?>

                        <th><label for="expiration-date"><?php _e("Days until account expires "); ?></label></th>
                        <td>
                            <span class="description"><?php echo $interval->days != 0 ? $interval->days . " days " : '&infin;'; ?></span>
                        </td>

                    <?php else : ?>

                        <th><label for="expiration-date"><?php _e("Your account expired "); ?></label></th>
                        <td>
                            <span class="description"><?php echo $interval->days . " days ago"; ?></span>
                        </td>

                    <?php endif; ?>
                </tr>
                <tr>
                    <th><label for="listings-count"><?php _e("Used Listings "); ?></label></th>
                    <td>
                        <span class="description"><?php echo $submitted_listings . ' / '; echo $account_listings_cap != 0 ? $account_listings_cap : '&infin;'; ?></span>
                    </td>
                </tr>
            </table>

        <?php

        }

    }
}


add_action('admin_notices', 'ht_admin_notices');

function ht_admin_notices() {

    global $wpdb, $post;

    $account_status = ht_get_current_account_status();

    if ( $account_status === NO_PAYMENT) :

    ?>

        <div class="error"><p style="display: inline-block;">Your payment is not confirmed yet. If you didn\'t pay, make another payment</p>

            <button id="ht-paypal-repay">Here</button>

        </div>

    <?php

     elseif ( $account_status === EXPIRED_ACCOUNT) :

    ?>

        <div class="error"><p style="display: inline-block;">Your account has expired!</p></div>

    <?php

    elseif ($account_status === FULL_ACCOUNT) :

    ?>

        <div class="error"><p style="display: inline-block;">Your have reached the posted listings cap!</p></div>

    <?php

    endif;

    // Hide page builder button for those who cannot use it
    if (!current_user_can('administrator') && !current_user_can('ht_use_page_builder')) {

        echo '<style type="text/css">.holo-switch-wrapper {display: none}</style>';

    }

}

function ht_get_current_account_status() {

    global $wpdb, $post;

    $listing_accounts_table_name = $wpdb->prefix . 'ht_listing_accounts';
    $user_id = get_current_user_id();
    $user = new WP_User($user_id);

    // Check if is admin panel and if user is not administrator
    if (!is_admin() || in_array('administrator', $user->roles)) {
        return 0;
    }

    $ht_account_info = $wpdb->get_results( "SELECT * FROM $listing_accounts_table_name WHERE user_id = $user_id", ARRAY_A );

    if (!empty($ht_account_info)) {

        $submitted_listings =  count( get_posts( array(
            'post_type' => 'site',
            'author'    => get_current_user_id(),
            'nopaging'  => true, // display all posts
        ) ) );

        $ht_account_info = $ht_account_info[0];

        $date1 = new DateTime();

        $date2 = new DateTime($ht_account_info['end_date']);
        $timestamp_interval = $date2->getTimestamp() - $date1->getTimestamp();

        $expiration_time = '';

        if ( $ht_account_info['payment_check'] == 0) {

            return 1;

        } elseif ($timestamp_interval < 0 && $date2->getTimestamp() != 0) {

            return 2;

        } elseif (($submitted_listings >= $ht_account_info['listings_cap'] + 1) && $ht_account_info['listings_cap'] != 0) {

            return 3;

        } else {

            return 0;

        }

    } else {
        return 0;
    }

}

function ht_handle_full_account_location_submit($new_status, $old_status, $post) {
    // verify this is not an auto save routine.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

    //You should check nonces and permissions here
    if ( !current_user_can( 'edit_page', $post->ID ) )
        return;

    if ( $new_status !== 'publish' )
        return;

    $account_status = ht_get_current_account_status();

    if ( $account_status === NO_PAYMENT ) {

        $post->post_status = 'draft';
        wp_update_post($post);

        $message_string = '
        Your have reached the posted listings cap.<br />
        Your post will be saved as draft. <br /><br />
        <a href="' . get_admin_url() . '/edit.php?post_type=site">&laquo;Go Back</a>';

        wp_die($message_string);

    } elseif ( $account_status === EXPIRED_ACCOUNT ) {

        $post->post_status = 'draft';
        wp_update_post($post);

        $message_string = '
        Your have reached the posted listings cap.<br />
        Your post will be saved as draft. <br /><br />
        <a href="' . get_admin_url() . '/edit.php?post_type=site">&laquo;Go Back</a>';

        wp_die($message_string);

    } elseif ( $account_status === FULL_ACCOUNT ) {

        $post->post_status = 'draft';
        wp_update_post($post);

        $message_string = '
        Your have reached the posted listings cap.<br />
        Your post will be saved as draft. <br /><br />
        <a href="' . get_admin_url() . '/edit.php?post_type=site">&laquo;Go Back</a>';

        wp_die($message_string);

    }
}

add_action('transition_post_status','ht_handle_full_account_location_submit', 10, 3);