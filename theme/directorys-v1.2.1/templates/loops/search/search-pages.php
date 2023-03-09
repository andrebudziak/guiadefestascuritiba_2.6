<?php

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();

        $comments_number = get_comments_number();
        $attachment_image = wp_get_attachment_image(get_post_thumbnail_id(), 'blog-thumbnail');

?>

        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php echo $post_media ?>

            <div class="post-body">
                <h3><a href="<?php echo get_the_permalink() ?>"><?php the_title() ?></a></h3>
                <p class="author">
                    Posted By <a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php the_author(); ?></a>  /
                    <?php
                    if (has_tag()) {
                        the_tags('', ', ', '');
                        echo ' / ';
                    } else {
                        the_category(', ');
                        echo ' / ';
                    }

                    comments_popup_link(
                        "0 " . __('Comments', 'holo_framework'),
                        "1 " . __('Comment', 'holo_framework'),
                        "% " . __('Comments', 'holo_framework'),
                        'comments-link',
                        "" . __('Comments are disabled', 'holo_framework')
                    );

                    ?>

                </p>

                <?php the_excerpt() ?>
            </div>
        </div>

<?php

    endwhile;
endif;

wp_reset_query();

?>