<div class="woocommerce">
    <div class="products">
<?php

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();

        $comments_number = get_comments_number();
        $attachment_image = wp_get_attachment_image(get_post_thumbnail_id(), 'blog-thumbnail');

        $product_id = get_the_ID();
        $product = new WC_Product( $product_id );

        $count   = $product->get_rating_count();
        $average = $product->get_average_rating();

        ?>

        <?php woocommerce_get_template_part('content', 'product'); ?>

    <?php

    endwhile;
endif;

wp_reset_query();

?>
    </div>
</div>