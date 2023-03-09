<?php

global $directorys_options;

$show_sidebar = true;

if ( isset($directorys_options['archive_sidebar_position']) ) {

    $sidebar_position = $directorys_options['archive_sidebar_position'];

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
        <div class="row <?php echo $sidebar_pos_class ?>">
            <div class="col-sm-9 blog-wrapper">

                <div class="divider divider-1">
                    <h3>Archive</h3><div class="separator"></div>
                </div>

                <div class="blog-wrapper">

                    <div class="posts">

                        <?php

                        get_template_part('templates/loops/loop', 'basic');

                        ?>

                        <?php get_template_part('templates/pagination') ?>

                    </div>

                </div>

            </div>

            <?php if ($show_sidebar) :

            get_template_part('templates/sidebar');

            endif;

            ?>

        </div>
    </div>

<?php

get_footer();

?>