<?php

create_test_role();

function create_test_role() {

    remove_role('directorys_test');

    add_role(
        'directorys_test',
        __('Test Account'),
        array(
            'read' => true,
            'publish_locations' => false,
            'edit_published_locations' => false,
            'edit_locations' => true,
            'delete_location' => false,

            'publish_posts' => false,
            'edit_posts' => true,
            'edit_published_posts' => false,
            'delete_posts' => false,

            'publish_pages' => false,
            'edit_pages' => true,
            'edit_published_pages' => false,
            'delete_pages' => false,
        )
    );

}