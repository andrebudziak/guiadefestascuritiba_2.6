<?php

global $directorys_options;

$top_bar_address_markup = '';
$top_bar_phone_markup = '';
$top_bar_email_markup = '';
$top_bar_website_markup = '';

if (!empty($directorys_options['top_bar_address'])) {

    $top_bar_address_markup = '<span class="element"><i class="fa fa-home main-text-color"></i> ' . $directorys_options['top_bar_address'] . '</span>';

}

if (!empty($directorys_options['top_bar_phone'])) {

    $top_bar_phone_markup = '<span class="element"><i class="fa fa-phone main-text-color"></i> ' . $directorys_options['top_bar_phone'] . '</span>';

}

if (!empty($directorys_options['top_bar_email'])) {

    $top_bar_email_markup = '<span class="element"><i class="fa fa-mail-alt main-text-color"></i> ' . $directorys_options['top_bar_email'] . '</span>';

}

if (!empty($directorys_options['top_bar_website'])) {

    $top_bar_website_markup = '<span class="element"><i class="fa fa-globe main-text-color"></i> ' . $directorys_options['top_bar_website'] . '</span>';

}

if ( isset($directorys_options['show_top_bar']) && $directorys_options['show_top_bar'] ) :

?>

<div class="top-bar">
    <div class="container">
        <div class="top-contact">

            <?php

            if ($directorys_options['show_top_bar_contact']) {

                echo $top_bar_address_markup;
                echo $top_bar_phone_markup;
                echo $top_bar_email_markup;
                echo $top_bar_website_markup;

            }

            ?>

        </div>

        <?php

        wp_nav_menu(array(
            'theme_location' => 'top_bar_navigation',
            'container' => false,
            'menu_class' => 'top-menu',
            'fallback_cb' => '',
            'walker' => new Top_Bar_Nav_Walker(),
            'depth' => 0,
            'echo' => true,
            'items_wrap' => ' <ul id="%1$s" class="%2$s">%3$s</ul>'
        ));

        ?>
    </div>
</div>

<?php

endif;