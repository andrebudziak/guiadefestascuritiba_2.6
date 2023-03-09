<?php
/**
 * Author Template
 */

get_header();

$query_object = get_queried_object();
$author_id = $query_object->ID;
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 blog-wrapper">

            <div class="row">
                <div class="col-md-11 col-md-offset-1">
                    <div class="author-box main-bg-color alt-text-color clearfix no-spacing">
                        <div class="img-wrap">
                            <?php echo get_avatar(get_the_author_meta('ID'), 91); ?>
                        </div>
                        <div class="text">
                            <div class="author">
                                <?php the_author_meta('display_name', $author_id) ?>
                            </div>

                            <div class="about italic">
                                <?php the_author_meta('user_description', $author_id) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="posts">

                <?php

                get_template_part('templates/loops/loop', 'basic');

                ?>

            </div>

            <?php get_template_part('templates/pagination') ?>

            <?php get_template_part('templates/preloader');  ?>


        </div>

        <?php get_template_part('templates/sidebar') ?>

    </div>
</div>

<?php

get_footer();

?>