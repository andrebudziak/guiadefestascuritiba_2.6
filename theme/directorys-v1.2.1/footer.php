<?php

global $directorys_options;

$copyright_text = isset($directorys_options['copyright_text']) && !empty($directorys_options['copyright_text']) ? '&#169; ' . $directorys_options['copyright_text'] : '';
$google_analytics = isset($directorys_options['google_analytics']) ? $directorys_options['google_analytics'] : '';

?>

<footer>
	<div id="footer">
		<div class="container">
			<div class="row">

				<?php dynamic_sidebar( 'footer-widgets' ); ?>

			</div>
		</div>
	</div>
	<div id="botbar">
		<div class="container">
            <p class="copyright-text">
                <?php echo $copyright_text ?>
            </p>

            <span class="socials">

                <?php

                $facebook_markup = '';
                $twitter_markup = '';
                $google_markup = '';
                $dribbble_markup = '';
                $vimeo_markup = '';
                $skype_markup = '';
                $linkedin_markup = '';
                $pinterest_markup = '';
                $rss_markup = '';

                if (!empty($directorys_options['social_facebook'])) {
                    $facebook_markup = '<a data-toggle="tooltip" title="Facebook" class="facebook" href="' . $directorys_options['social_facebook'] . '" target="_blank"> <i class="fa fa-facebook"></i> </a>';
                }

                if (!empty($directorys_options['social_twitter'])) {
                    $twitter_markup = '<a data-toggle="tooltip" title="Twitter" class="twitter" href="' . $directorys_options['social_twitter'] . '" target="_blank"> <i class="fa fa-twitter"></i> </a>';
                }

                if (!empty($directorys_options['social_google_plus'])) {
                    $google_markup = '<a data-toggle="tooltip" title="Google Plus" class="google_plus" href="' . $directorys_options['social_google_plus'] . '" target="_blank"> <i class="fa fa-gplus"></i> </a>';
                }

                if (!empty($directorys_options['social_dribbble'])) {
                    $dribbble_markup = '<a data-toggle="tooltip" title="Dribbble" class="dribbble" href="' . $directorys_options['social_dribbble'] . '" target="_blank"> <i class="fa fa-dribbble"></i> </a>';
                }

                if (!empty($directorys_options['social_vimeo'])) {
                    $vimeo_markup = '<a data-toggle="tooltip" title="Vimeo" class="vimeo" href="' . $directorys_options['social_vimeo'] . '" target="_blank"> <i class="fa fa-vimeo-squared"></i> </a>';
                }

                if (!empty($directorys_options['social_skype'])) {
                    $skype_markup = '<a data-toggle="tooltip" title="Skype" class="skype" href="' . $directorys_options['social_skype'] . '" target="_blank">  <i class="fa fa-skype"></i> </a>';
                }

                if (!empty($directorys_options['social_linkedin'])) {
                    $linkedin_markup = '<a data-toggle="tooltip" title="Linkedin" class="linkedin" href="' . $directorys_options['social_linkedin'] . '" target="_blank"> <i class="fa fa-linkedin"></i> </a>';
                }

                if (!empty($directorys_options['social_pinterest'])) {
                    $pinterest_markup = '<a data-toggle="tooltip" title="Pinterest" class="pinterest" href="' . $directorys_options['social_pinterest'] . '" target="_blank"> <i class="fa fa-pinterest-circled"></i> </a>';
                }

                if (!empty($directorys_options['social_RSS'])) {
                    $rss_markup = '<a data-toggle="tooltip" title="RSS" class="rss" href="' . $directorys_options['social_RSS'] . '" target="_blank"> <i class="fa fa-rss"></i> </a>';
                }

                echo $facebook_markup;
                echo $twitter_markup;
                echo $google_markup;
                echo $dribbble_markup;
                echo $vimeo_markup;
                echo $skype_markup;
                echo $linkedin_markup;
                echo $pinterest_markup;
                echo $rss_markup;

                ?>

            </span>

		</div>
	</div>
</footer>

<?php

if ($directorys_options['show_go_to_top']) {

    ?>

    <div id="totop" class="collapsed">
        <i class="fa fa-up-open"></i>
    </div>

    <?php

}

?>

</div> <!-- #main -->

<?php echo $google_analytics; ?>

<?php wp_footer() ?>
</body>

<?php //get_template_part('/templates/test-zone') ?>
</html>

