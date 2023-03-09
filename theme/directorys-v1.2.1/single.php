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
    <div class="row <?php echo $sidebar_pos_class ?>">
        <div class="col-md-9 blog-wrapper">

<?php

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();

        $post_media = holo_get_media_by_post_format($post->ID, 'post_image');

        ?>

            <div class="post">

                <?php echo $post_media ?>

                <div class="post-body">
                    <h1 class="title"><a href="<?php echo get_the_permalink() ?>"><?php the_title() ?></a></h1>
                    <p class="author">
                        <?php _e('Posted By', THEME_TEXT_DOMAIN) ?> <a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php the_author(); ?></a> /
                        <?php echo '<span> ' . get_the_date('', $post->ID) . '</span>' ?> /
                        <?php
                        if (has_tag()) {
                            the_tags('', ', ', '');
                            echo ' / ';
                        } else {
                            the_category(', ');
                            echo ' / ';
                        }

                        comments_popup_link(
                            "0 " . __('Comments', THEME_TEXT_DOMAIN),
                            "1 " . __('Comment', THEME_TEXT_DOMAIN),
                            "% " . __('Comments', THEME_TEXT_DOMAIN),
                            'comments-link',
                            "" . __('Comments are disabled', THEME_TEXT_DOMAIN)
                        );

                        ?>

                    </p>

                    <?php the_content() ?>
                </div>
            </div>

            <?php


                endwhile;
            endif;

            ?>

            <?php

            comments_template('/templates/comments.php');

            ?>

        </div>

        <?php if ($show_sidebar) : ?>

        <?php

        get_template_part('templates/sidebar');

        ?>


        <?php endif; ?>

    </div>

</div>

<?php

get_footer();