<div class="blog-wrapper col-md-9">
    <div class="recent-places sites-listings">
        <div class="post-header clearfix">
            <div class="posts-show-number">Showing <?php echo $wp_query->post_count ?> of <?php echo $wp_query->found_posts ?> Items</div>
            <div class="post-sort-recent">
                <form id="site-filter-form" method="post">
                Count:
                    <select id="site-count" name="count" aria-invalid="false">
                        <option value="cool">10</option>
                        <option value="super cool">15</option>
                        <option value="super cool line">20</option>
                    </select>
                    Sort by: <div class="sortdropdown">Date <i class="fa fa-sort"></i></div>
                    Sort: <div class="sortdropdown">v <i class="fa fa-sort"></i></div>
                </form>
            </div>
        </div>

<?php

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();

        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'site_thumb');

        $contact_fields = get_post_meta($post->ID, 'contact', true);

        $category = wp_get_post_terms($post->ID, 'sites_category');

        $category_info = get_option('taxonomy_' . $category[0]->term_id);

        $category_icon = $category_info['badge'];

        $address = $contact_fields['address'];
        $phone = $contact_fields['phone'];

        if (empty($thumbnail)) {
            $event_thumb = '';
        } else {
            $event_thumb = '<img src="' . $thumbnail[0] . '">';
        }

?>

        <div <?php post_class(); ?>>

            <div class="site-wrapper row">
                <div class="col-md-4 nopaddingright">
                    <div class="picture">
                        <?php echo $event_thumb ?>
                    </div>
                </div>
                <div class="col-md-8 description">
                    <i class="iconstyle"><img src="<?php echo $category_icon ?>" /></i>

                    <div class="col-md-9 descriptioninfo">
                        <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                        <p><?php echo $address['value'] ?></p>
                        <p><?php echo get_the_excerpt() ?></p>
                        <i><?php echo $phone['value'] ?></i>
                    </div>
                    <div class="col-md-3 rating"><p><?php _e('No Rating Yet', THEME_TEXT_DOMAIN) ?></p></div>
                </div>
            </div>

        </div>

    <?php

    endwhile;
endif;

?>

    </div>

<?php

get_template_part('templates/pagination');

wp_reset_query();

?>

</div>