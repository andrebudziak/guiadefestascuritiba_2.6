<?php

global $directorys_options;

$show_sidebar = true;

if ( isset($directorys_options['search_sidebar_position']) ) {

    $sidebar_position = $directorys_options['search_sidebar_position'];

    if ( $sidebar_position == 'left' ) {

        $sidebar_pos_class = 'sidebar-left';

    } elseif ( $sidebar_position == 'right' ) {

        $sidebar_pos_class = '';

    } else {

        $sidebar_pos_class = 'no-sidebar';

        $show_sidebar = false;

    }

}

?>

<div class="container">
    <div class="row <?php echo $sidebar_pos_class; ?>">

        <div class="col-md-9 blog-wrapper">

            <div class="divider divider-1">
                <h3>SEARCH</h3><div class="separator"></div>
            </div>

            <div>

                <?php

                get_template_part('templates/loops/loop', 'basic');

                ?>

                <?php get_template_part('templates/pagination') ?>

            </div>

        </div>

        <?php

        if ($show_sidebar) :

        get_template_part('templates/sidebar');

        endif;

        ?>

    </div>
</div>