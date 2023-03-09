<?php

global $directorys_options;

$pinned_header_class = (isset($directorys_options['pinned_header']) && $directorys_options['pinned_header'] == 1) ? ' fixed' : '';
$custom_css = ($directorys_options['custom_css'] ? '<style type="text/css">' . $directorys_options['custom_css'] . '</style>' : '');

if ( isset($directorys_options['background_image']) ) {

    $background_image_settings = '';

    foreach ($directorys_options['background_image'] as $css_attr => $value) {

        if ($css_attr == 'background-image') {

            $background_image_settings .= $css_attr . ': url(' . $value . ');';

        } elseif ( !empty($value) && $css_attr !== 'media') {

            $background_image_settings .= $css_attr . ': ' . $value . ';';

        }

    }

    $background_image_style = 'body{' . $background_image_settings . '}' . "\n";

} else {

    $background_image_style = '';

}

$header_styles = '';

$header_background = '';

if ( isset($directorys_options['header_background']) ) {

    foreach ($directorys_options['header_background'] as $css_attr => $value) {

        if ($css_attr == 'background-image') {

            $header_background .= $css_attr . ': url(' . $value . ');';

        } elseif ( !empty($value) && $css_attr !== 'media') {

            $header_background .= $css_attr . ': ' . $value . ';';

        }

    }

}

if ( isset($directorys_options['logo']['height']) && $directorys_options['logo']['height'] > 103) {

    $header_style = 'header a.logo-box img {vertical-align: top;}';

} else {
    $header_style = '';
}

if ( isset($directorys_options['show_button']) && $directorys_options['show_button'] == '1') {

    $show_button = true;

} else {

    $show_button = false;

}

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta http-equiv="Content-Type" content="<?php echo get_bloginfo('html_type'); ?>; charset=<?php echo get_bloginfo('charset'); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <?php if ( true ) { ?>
        <!-- robots -->
        <meta name="robots" content="<?php  ?>" />
        <meta name="googlebot" content="<?php  ?>" />
    <?php } ?>

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <title><?php wp_title( '|', true, 'right' ) ?></title>

    <link href='http://fonts.googleapis.com/css?family=Raleway:600,500,400' rel='stylesheet' type='text/css'>

    <?php if ( isset($directorys_options['favicon']['url']) && !empty($directorys_options['favicon']['url']) ) : ?>
        <link rel="shortcut icon" href="<?php echo $directorys_options['favicon']['url'] ?>">
    <?php endif; ?>

    <?php

    // adds the required javascript for the comments form.
    if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

    wp_head();

    ?>
</head>

<body <?php body_class(); ?>>

<?php echo $custom_css ?>

<?php require_once( HOLO_TEMPLATEDIR . '/includes/css/color_theme.php' ) ?>
<?php require_once( HOLO_TEMPLATEDIR . '/includes/css/fonts.php' ) ?>

<div id="main">

	<header class="head-1<?php echo $pinned_header_class; ?>"<?php echo $header_styles; ?>>

        <?php get_template_part('templates/top_bar') ?>

		<div class="container menu-bar" role="navigation">
				<div class="logo-wrapper">
					<a class="logo-box" href="<?php echo home_url() ?>">
                        <?php if ( isset($directorys_options['logo']) && !empty($directorys_options['logo']['url'])) : ?>

						    <img class="img-responsive" alt="Corex" src="<?php echo $directorys_options['logo']['url'] ?>">

                        <?php elseif ( isset($directorys_options['logo_text']) ) : ?>

                            <h1><?php echo $directorys_options['logo_text'] ?></h1>

                        <?php endif; ?>
					</a>
				</div>

                <div class="mobile-buttons">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar main-bg-color"></span>
                        <span class="icon-bar main-bg-color"></span>
                        <span class="icon-bar main-bg-color"></span>
                    </button>

                    <?php if ($show_button) : ?>

                        <div class="utilities-buttons">
                            <a class="button sm main-bg-color" href="<?php echo isset($directorys_options['button_link']) ? $directorys_options['button_link'] : ''; ?>">
                                <?php echo isset($directorys_options['button_text']) ? $directorys_options['button_text'] : ''; ?>
                            </a>
                        </div>

                    <?php endif; ?>
                </div>

                <?php

                get_template_part('templates/header', 'navigation');

                ?>
		</div>

	</header>

    <?php

    global $under_header;

    ?>

    <div class="home-top">

        <?php $under_header->display(); ?>

    </div>