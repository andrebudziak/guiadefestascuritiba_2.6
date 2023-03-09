<?php
/**
 * Error 404 Page Template
 */

get_header();

?>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrap-404 bold text-center">
                    4<i class="alt-bg-color main-text-color fa fa-help-circled"></i>4
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 main-el">
            <div class="call">
                <h3 class="main-text-color"><?php _e('File Not Found', THEME_TEXT_DOMAIN) ?></h3>
                <p><?php _e('Sorry, the page you are looking for doesn\'t exist. Take a run around the block or tap the button below.', THEME_TEXT_DOMAIN) ?>.</p>
                <a href="<?php echo home_url(); ?>" class="button solid md blue"><?php _e('Back to home', THEME_TEXT_DOMAIN) ?></a>
            </div>
        </div>
    </div>
</div>
    
<?php

get_footer();

?>