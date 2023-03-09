<div class="sg-controls hidden-xs">

<?php

global $post;

$prev_post = get_previous_post();

if ($prev_post) :

    $attachment_image = wp_get_attachment_image(get_post_thumbnail_id($prev_post->ID), 'thumbnail');

    ?>

    <a class="left" href="<?php echo get_permalink($prev_post->ID) ?>">
        <i class="fa fa-chevron-left"></i>
        <div class="preview">
            <div class="title">
                <?php echo get_the_title($prev_post->ID) ?>
            </div>

            <?php if ($attachment_image) : ?>

            <div class="thumb">
                <?php echo $attachment_image; ?>
            </div>

            <?php endif; ?>
        </div>
    </a>

<?php
endif;

$next_post = get_next_post();

if ($next_post) :

    $attachment_image = wp_get_attachment_image(get_post_thumbnail_id($next_post->ID), 'thumbnail');

    ?>

    <a class="right" href="<?php echo get_permalink($next_post->ID) ?>">
        <i class="fa fa-chevron-right"></i>
        <div class="preview">

            <?php if ($attachment_image) : ?>

            <div class="thumb">
                <?php echo $attachment_image; ?>
            </div>

            <?php endif; ?>

            <div class="title">
                <?php echo get_the_title($next_post->ID) ?>
            </div>
        </div>
    </a>

<?php

endif;

?>
</div>