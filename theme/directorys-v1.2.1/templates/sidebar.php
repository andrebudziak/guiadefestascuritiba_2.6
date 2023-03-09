
<div class="sidebar col-md-3 col-sm-12">

    <?php

    $page_id = get_queried_object_id();

    $sidebar = get_post_meta($page_id, 'holo_sidebar_select', true);

    /** if the sidebar is empty display the default sidebar, else display the chosen sidebar */
    if ( empty($sidebar) ) {

        if ( is_single() ) {

            dynamic_sidebar( 'post-sidebar' );

        } else {

            dynamic_sidebar( 'default-sidebar' );

        }

    } else {

        dynamic_sidebar( $sidebar );

    }

    ?>

</div>


