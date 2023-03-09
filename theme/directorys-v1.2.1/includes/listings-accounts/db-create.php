<?php

function ht_create_listing_accounts_tables() {
    global $wpdb;

    $listing_accounts_table_name = $wpdb->prefix . 'ht_listing_accounts';

    $charset_collate = '';

    if ( !empty($wpdb->charset) ) {
        $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
    }

    if ( !empty($wpdb->collate) ) {
        $charset_collate .= " COLLATE {$wpdb->collate}";
    }

    $listing_accounts_create_sql = "CREATE TABLE $listing_accounts_table_name (
      account_id int(9) NOT NULL AUTO_INCREMENT,
      user_id int(9) NOT NULL,
      account_type varchar(255) NOT NULL,
      listings_cap int(9) DEFAULT 0 NOT NULL,
      account_price float(5,2) DEFAULT 0.00 NOT NULL,
      create_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      update_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      end_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      payment_check int(1) DEFAULT 0 NOT NULL,
      UNIQUE KEY (account_id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    dbDelta( $listing_accounts_create_sql );

}