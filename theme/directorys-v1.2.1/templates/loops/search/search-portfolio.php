<?php

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();

        $comments_number = get_comments_number();
        $attachment_image = wp_get_attachment_image(get_post_thumbnail_id(), 'blog-thumbnail');

?>

<div class="col-sm-3 main-el isotope-element">
    <div class="portfolio item">
        <div class="top">
            <a class="overlay mgp-img" href="../../images/image-standard-1-lg.jpg">
                <i class="fa fa-search md alt-text-color"></i>
            </a>
            <?php echo $attachment_image; ?>
        </div>

        <div class="bot">
            <h5><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID) ?></a>
                <span class="stats pull-right">
        74
                    <a href="#"><i class="fa fa-heart"></i></a>
                    <span class="sep"></span>
                    <a href="#" class="share"><i class="fa fa-share"></i></a>
                    <span class="socials">
                        <a class="pinterest" href="#"> <i class="fa fa-pinterest"></i> </a>
                        <a class="gplus" href="#"> <i class="fa fa-google-plus"></i> </a>
                        <a class="twitter" href="#"> <i class="fa fa-twitter"></i> </a>
                        <a class="facebook" href="#"> <i class="fa fa-facebook"></i> </a>
                    </span>
                </span>


            </h5>
        </div>
    </div>
</div>

<?php

    endwhile;
endif;

wp_reset_query();

?>

<?php get_template_part('templates/pagination') ?>