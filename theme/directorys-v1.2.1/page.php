<?php

global $directorys_options;

$show_sidebar = true;

if ( isset($directorys_options['posts_sidebar_position']) ) {

    $sidebar_position = $directorys_options['posts_sidebar_position'];

    if ( $sidebar_position == 'left' ) {

        $sidebar_pos_class = 'sidebar-left';

    } elseif ( $sidebar_position == 'right' ) {

        $sidebar_pos_class = '';

    } else {

        $sidebar_pos_class = 'no-sidebar';

        $show_sidebar = false;

    }

}

get_header();

?>

    <div class="container">

        <div class="row">
            <div class="col-md-9">

                <?php

                if ( have_posts() ) {
                    while ( have_posts() ) {

                        the_post();

                        the_content();
                    }
                }

                ?>

            </div>

            <?php get_template_part('templates/sidebar'); ?>

        </div>

    </div>

<?php

get_footer();