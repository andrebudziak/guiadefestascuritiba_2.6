<div class="blog-wrapper col-md-9">

<?php

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();

        $comments_number = get_comments_number();
        $attachment_image = wp_get_attachment_image(get_post_thumbnail_id(), 'blog-thumbnail');

?>

        <div class="element row">

            <?php get_template_part('templates/post', 'side-info') ?>

            <div class="col-md-11">
                <div class="post-media">
                    <div class="image">
                        <div class="overlay">
                            <i class="fa fa-share md"></i>
                        </div>
                        <?php echo $attachment_image ?>
                    </div>
                </div>

                <div class="body">
                    <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                    <p><span class="main-text-color">08:00 AM - 16:00 PM</span><span class="post-links"> / at <a>Grand Hotel Italia</a> </span></p>
                    <p class="text"><?php the_excerpt() ?>
                        <span class="read-link main-text-color"><a href="#">Read More </a><i class="fa fa-play-circle-o"></i></span> </p>

                </div>
            </div>
            <div class="col-md-11 col-md-offset-1">
                <div class="sep-line"></div>
            </div>
        </div>

    <?php

    endwhile;
endif;

wp_reset_query();

?>

    <?php get_template_part('templates/pagination') ?>

</div>