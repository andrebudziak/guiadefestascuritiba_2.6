<?php
// Template name: Empty page

get_header();

$show_sidebar = get_post_meta($post->ID, 'holo_sidebar_show', true);
$sidebar_position = get_post_meta($post->ID, 'holo_sidebar_position', true);

$sidebar_pos_class = '';

if ($show_sidebar) {

    if ( $sidebar_position == 'left' ) {

        $sidebar_pos_class = 'sidebar-left';

    } elseif ( $sidebar_position == 'right' ) {

        $sidebar_pos_class = '';

    }

} else {

    $sidebar_pos_class = 'no-sidebar';

}

?>

<div class="container">

	<div class="row <?php echo $sidebar_pos_class ?>">
		<div class="col-md-9 content-wrapper">

            <?php

            if ( have_posts() ) {
                while ( have_posts() ) {

                    the_post();

                    ?>

                    <?php

                    the_content();
                }
            }

            ?>

		</div>

        <?php

        if ($show_sidebar) {
            get_template_part('templates/sidebar');
        }

        ?>

	</div>

</div>

<?php

get_footer();
