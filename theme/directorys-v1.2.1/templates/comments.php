<div id="comments">

<div class="divider divider-1">
    <h3><?php _e('Comments', THEME_TEXT_DOMAIN) ?></h3><div class="separator"></div>
</div>

<div class="bgblock">

<?php

if (comments_open()) {

    // verifies if the post is protected with password
    if ( post_password_required() ) {
        echo '<p class="nocomments">' . __('This post is password protected. Enter the password to view comments.', THEME_TEXT_DOMAIN) . '.</p>';
        return;
    }

    // checks if there are any posted comments
    if ( have_comments() ) {
        ?>

        <div class="comments-section">
            <h4><?php comments_number( __('No comments', THEME_TEXT_DOMAIN), __('One Comment', THEME_TEXT_DOMAIN), '% ' . __('Comments', THEME_TEXT_DOMAIN) ) ?></h4>

            <ul class="comment-wrap">
                <?php wp_list_comments( array( 'type'=> 'comment', 'callback' => 'holo_custom_comments', 'style' => 'ul' ) ); ?>
            </ul>

        </div>

    <?php
    }
    else {

        ?>

        <div class="comments-section">

            <h4><?php _e('No comments', THEME_TEXT_DOMAIN) ?></h4>

        </div>

        <?php
    }

} else {
    echo '<div class="comment-form"><h3>' . __('Comments are not allowed', THEME_TEXT_DOMAIN) . '</h3></div>';
}

/*
 * generates a custom template for each comment
 * this function is a callback for wp_list_comments
 */
function holo_custom_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>

    <li id="comment-<?php comment_ID() ?>">
        <div class="comment">
            <?php

            echo get_avatar($comment,'50');

            ?>

            <div class="textblock">
                <div class="header-comment">
                    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('Reply', THEME_TEXT_DOMAIN) . ' <i class="fa fa-play-circle-o"></i>', 'before' => '<div class="main-text-color reply">', 'after' => '</div>'))) ?>

                    <div class="author">
                        <?php echo get_comment_author_link() ?>
                    </div>
                    <div class="time"><?php echo get_comment_date() . ' ' . __('at', THEME_TEXT_DOMAIN) . ' ' . get_comment_time() ?></div>
                </div>
                <div class="text">
                    <?php comment_text(); ?>
                </div>

                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php _e('Your comment is awaiting moderation.', THEME_TEXT_DOMAIN) ?></em>
                <?php endif; ?>

            </div>
        </div>

<?php
}

$args = array();

/** displays comments pagination */
paginate_comments_links( $args );

/** the markup used for the comments form */
?>

<div class="comment-form">
    <?php

    global $user_identity, $id, $post_id;

    if ( null === $post_id )
        $post_id = $id;
    else
        $id = $post_id;

    $req = get_option( 'require_name_email' );

    $commenter = wp_get_current_commenter();

    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields =  array(
        'author' => '
            <div class="row">
                <div class="col-sm-4">
                    <input type="text" placeholder="' . __('Name', THEME_TEXT_DOMAIN) . ' *" ' . $aria_req . ' tabindex="3" maxlength="20" size="30"
                           value="' . esc_attr( $commenter['comment_author'] ) . '" name="author" class="form-control">
                </div>',
        'email'  => '
            <div class="col-sm-4">
                <input type="email" placeholder="' . __('Email', THEME_TEXT_DOMAIN) . ' *" ' . $aria_req . ' tabindex="4" maxlength="50"
                       size="30" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" name="email" class="form-control">
            </div>
            ',
        'website' => '
                <div class="col-sm-4">
                    <input type="text" placeholder="' . __('Website', THEME_TEXT_DOMAIN) . '" tabindex="4" maxlength="50" size="30"
                        value="' . esc_attr(  $commenter['comment_author_url'] ) . '" name="website" class="form-control">
                </div>
            </div>'
    );

    $args = array(
        'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_field'        => '
            <div class="row">
                <div class="col-xs-12">

                    <textarea aria-required="true" placeholder="Message *" rows="10" class="form-control"
                              name="comment"></textarea>

                </div>
            </div>',

        'comment_notes_before' => '<p class="comment-notes">' . sprintf( __( 'Your email is %1$snever%2$s published nor shared.', THEME_TEXT_DOMAIN ), '<em>' , '</em>' ) . ( $req ? ' ' . sprintf( __('Required fields are marked %1$s*%2$s', THEME_TEXT_DOMAIN), '<span class="required">', '</span>' ) : '' ) . '</p>',

        'must_log_in'          => '<p id="login-req">' .  sprintf( __('You must be %1$slogged in%2$s to post a comment.', THEME_TEXT_DOMAIN), sprintf('<a href="%s" title ="%s">', esc_attr( wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ), esc_attr__( 'Log in', 'thematic' ) ), '</a>' ). '</p>',

        'logged_in_as'         => '<p id="login"><span class="loggedin">' . sprintf( __('Logged in as %s', THEME_TEXT_DOMAIN ), sprintf( ' <a href="%1$s" title="%2$s">%3$s</a>', admin_url( 'profile.php' ), sprintf( esc_attr__('Logged in as %s', 'thematic'), $user_identity ) , $user_identity ) ) .'</span> <span class="logout">' . sprintf('<a href="%s" title="%s">%s</a>' , esc_attr( wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ), esc_attr__('Log out of this account', 'thematic' ) , __('Log out?', 'thematic' ) ) . '</span></p>',

        'comment_notes_after'  => '',

        'id_form'              => 'commentform',
        'id_submit'            => 'comment-submit',
        'title_reply'          => __('Leave a reply', THEME_TEXT_DOMAIN),
        'title_reply_to'       => __('Post a Reply to %s', THEME_TEXT_DOMAIN),
        'cancel_reply_link'    => __('Cancel reply', THEME_TEXT_DOMAIN),
        'label_submit'         => __('Post Comment', THEME_TEXT_DOMAIN),

    );

    comment_form($args);

    ?>
</div>
</div>

</div>
