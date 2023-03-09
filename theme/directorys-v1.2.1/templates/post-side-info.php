<?php

global $post;
global $corex_options;

$show_likes = false;

if ($corex_options['posts_show_likes']) {

    $show_likes = true;

}

?>

<div class="text-center stats hidden-sm hidden-xs col-md-1">
    <div class="date">
        <div class="day light main-text-color"><?php echo get_the_date('d') ?></div>
        <div class="month"><?php echo get_the_date('M') ?></div>
    </div>

    <?php if ($show_likes) : ?>

        <div class="likes">
            <?php echo kkLikeButton(); ?>
        </div>

    <?php endif; ?>

    <?php holo_display_share_buttons($post->ID) ?>
</div>