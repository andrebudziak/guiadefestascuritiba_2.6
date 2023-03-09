<?php

function holo_create_rating_tables() {
    global $wpdb;

    $rating_sets_table_name = $wpdb->prefix . 'rating_sets';
    $rating_terms_table_name = $wpdb->prefix . 'rating_terms';
    $ratings_table_name = $wpdb->prefix . 'ratings';
    $reviews_table_name = $wpdb->prefix . 'reviews';
    $ratings_log_table_name = $wpdb->prefix . 'rating_logs';

    $charset_collate = '';

    if ( !empty($wpdb->charset) ) {
        $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
    }

    if ( !empty($wpdb->collate) ) {
        $charset_collate .= " COLLATE {$wpdb->collate}";
    }

    $rating_sets_create_sql = "CREATE TABLE $rating_sets_table_name (
      set_id int(9) NOT NULL AUTO_INCREMENT,
      set_name varchar(55) NOT NULL,
      UNIQUE KEY (set_id)
    ) $charset_collate;";

    $rating_terms_create_sql = "CREATE TABLE $rating_terms_table_name(
      term_id int(9) NOT NULL AUTO_INCREMENT,
      term_name varchar(55) NOT NULL,
      rating_set int(9) NOT NULL,
      UNIQUE KEY (term_id)
    ) $charset_collate;";

    $reviews_create_sql = "CREATE TABLE $reviews_table_name (
      review_id int(9) NOT NULL AUTO_INCREMENT,
      review_post_id int(9) NOT NULL,
      review_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      review_content varchar(255),
      user_name varchar(55),
      UNIQUE KEY (review_id)
    ) $charset_collate;";

    $ratings_create_sql = "CREATE TABLE $ratings_table_name (
      rating_id int(9) NOT NULL AUTO_INCREMENT,
      rating_term int(9) NOT NULL,
      rating_value int(2) NOT NULL,
      post_id int(9) NOT NULL,
      UNIQUE KEY (rating_id)
    ) $charset_collate;";

    $ratings_log_create_sql = "CREATE TABLE $ratings_log_table_name (
      log_id int(9) NOT NULL AUTO_INCREMENT,
      post_id int(9) NOT NULL,
      user_id int(9) NOT NULL,
      log_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      user_ip varchar(20) NOT NULL,
      UNIQUE KEY (log_id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    if ($wpdb->get_var("SHOW TABLES LIKE '$rating_sets_table_name'") != $rating_sets_table_name) {

        dbDelta( $rating_sets_create_sql );

        $wpdb->insert( $rating_sets_table_name, array('set_id' => 1,'set_name' => 'default') );

    }

    if ($wpdb->get_var("SHOW TABLES LIKE '$rating_terms_table_name'") != $rating_terms_table_name) {

        dbDelta( $rating_terms_create_sql );

        $wpdb->insert($rating_terms_table_name, array('term_name' => 'rating 1', 'rating_set' => 1));
        $wpdb->insert($rating_terms_table_name, array('term_name' => 'rating 2', 'rating_set' => 1));
        $wpdb->insert($rating_terms_table_name, array('term_name' => 'rating 3', 'rating_set' => 1));
        $wpdb->insert($rating_terms_table_name, array('term_name' => 'rating 4', 'rating_set' => 1));
        $wpdb->insert($rating_terms_table_name, array('term_name' => 'rating 5', 'rating_set' => 1));

    }

    dbDelta( $ratings_create_sql );
    dbDelta( $reviews_create_sql );
    dbDelta( $ratings_log_create_sql );

    // add a new column to "ratings" table
    // version affected: 1.2.0
    $row = $wpdb->get_row( "SELECT * FROM information_schema.COLUMNS
        WHERE TABLE_NAME = 'wp_ratings'
        AND COLUMN_NAME = 'review_id'"
    );

    if( !isset($row) ){

        $wpdb->query("ALTER TABLE $ratings_table_name ADD review_id INT(9) NOT NULL");

    }

}
