<?php

if (!defined('PHP_VERSION')) {
    define ( 'PHP_VERSION', (float)phpversion() );
}

if ( PHP_VERSION >= 5.3 ) {
    include_once(dirname(__FILE__) . '/codebird-php/codebird-v2.3.3/src/codebird.php');

} else {
    include_once(dirname(__FILE__) . '/codebird-php/codebird-v2.3.2/src/codebird.php');
}

add_action('widgets_init', 'register_twitter_widget');

function register_twitter_widget() {
    register_widget('Holo_Widget_Latest_Tweets');
}

/*********************************************************************************************

Register Twitter Widget

 *********************************************************************************************/
class Holo_Widget_Latest_Tweets extends WP_Widget {
    function __construct() {
        parent::__construct(false, $name = 'DirectoryS Twitter Widget', array( 'description' => 'Displays your latest tweets.' ) );
    }

    function retrieve_tweets( $widget_id, $instance, $auth_args ) {

        if ( !empty($auth_args['consumer_key']) && !empty($auth_args['consumer_secret']) ) {

            // check php version
            if ( PHP_VERSION >= 5.3 ) {
                \Codebird\Codebird::setConsumerKey( $auth_args['consumer_key'], $auth_args['consumer_secret'] );
                $cb = \Codebird\Codebird::getInstance();
            } else {
                Codebird::setConsumerKey( $auth_args['consumer_key'], $auth_args['consumer_secret'] );
                $cb = Codebird::getInstance();
            }

            $cb->setToken( $auth_args['access_token'], $auth_args['access_secret'] );
            $timeline = $cb->statuses_userTimeline( 'screen_name=' . $instance['screen_name']. '&count=' . $instance['num_tweets'] . '&exclude_replies=true' );
            return $timeline;
        }
        else {
            return 'Authentication to twitter server failed! Please make sure that your "consumer key" and "consumer secret" are not empty.';
        }

    }

    function save_tweets( $widget_id, $instance, $auth_args ) {
        $timeline = $this->retrieve_tweets( $widget_id, $instance, $auth_args );
        $tweets = array( 'tweets' => $timeline, 'update_time' => time() + ( 60 * 5 ) );
        update_option( 'my_tweets_' . $widget_id, $tweets );
        return $tweets;
    }

    function get_tweets( $widget_id, $instance, $auth_args ) {
        $tweets = get_option( 'my_tweets_' . $widget_id );
        if( empty( $tweets ) OR time() > $tweets['update_time'] ) {
            $tweets = $this->save_tweets( $widget_id, $instance, $auth_args );
        }
        return $tweets;
    }


    /*
     * Displays the widget form in the admin panel
     */
    function form( $instance ) {

        $instance = wp_parse_args((array) $instance, array(
            'title' => '',
            'screen_name' => '',
            'num_tweets' => '',
            'consumer_key' => '',
            'consumer_secret' => '',
            'access_token' => '',
            'access_secret' => ''
        ));

        $widget_title = esc_attr( $instance['widget_title'] );
        $screen_name = (!empty($instance['consumer_secret']) ? esc_attr( $instance['screen_name'] ) : 'andreiholo');
        $num_tweets = (!empty($instance['consumer_secret']) ? esc_attr( $instance['num_tweets'] ) : 2);
        $consumer_key = (!empty($instance['consumer_key']) ? esc_attr( $instance['consumer_key'] ) : 'xUjV3oGlpE7Ou6aO2Jl2g');
        $consumer_secret = (!empty($instance['consumer_secret']) ? esc_attr( $instance['consumer_secret'] ) : 'U7Vx7aSIbFGC78HChxoWf1J7gft5QrvljJrFeQ');
        $access_token = esc_attr( $instance['access_token'] );
        $access_secret = esc_attr( $instance['access_secret'] );

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php _e('Widget Title:', 'site5framework') ?></label>
            <input id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" type="text" value="<?php echo $widget_title; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'screen_name' ); ?>"><?php _e('Screen name:', 'site5framework') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'screen_name' ); ?>" name="<?php echo $this->get_field_name( 'screen_name' ); ?>" type="text" value="<?php echo $screen_name; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'num_tweets' ); ?>"><?php _e('Number of Tweets:', 'site5framework') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'num_tweets' ); ?>" name="<?php echo $this->get_field_name( 'num_tweets' ); ?>" type="text" value="<?php echo $num_tweets; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'consumer_key' ); ?>"><?php _e('Consumer Key:', 'site5framework') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" type="text" value="<?php echo $consumer_key; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'consumer_secret' ); ?>"><?php _e('Consumer Secret:', 'site5framework') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'consumer secret' ); ?>" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" type="text" value="<?php echo $consumer_secret; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'access_token' ); ?>"><?php _e('Access Token:', 'site5framework') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" type="text" value="<?php echo $access_token; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'access_secret' ); ?>"><?php _e('Access Secret:', 'site5framework') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'access_secret' ); ?>" name="<?php echo $this->get_field_name( 'access_secret' ); ?>" type="text" value="<?php echo $access_secret; ?>" />
        </p>

    <?php
    }
    /*
     * Renders the widget in the sidebar
     */
    function widget( $args, $instance ) {

        $consumer_key = $instance['consumer_key'];
        $consumer_secret = $instance['consumer_secret'];
        $access_token = $instance['access_token'];
        $access_secret = $instance['access_secret'];

//        \Codebird\Codebird::setConsumerKey( $consumer_key, $consumer_secret );

        $auth_args['consumer_key'] = $consumer_key;
        $auth_args['consumer_secret'] = $consumer_secret;
        $auth_args['access_token'] = $access_token;
        $auth_args['access_secret'] = $access_secret;

        $tweets = $this->get_tweets($args['widget_id'], $instance, $auth_args);

        echo $args['before_widget'];
        ?>


        <!-- start twitter widget -->
        <?php echo $args['before_title']; ?><?php echo $instance['widget_title']; ?><?php echo $args['after_title'];

        echo '<div class="tweets-boxes">';

        if (is_array($tweets['tweets']) || is_object($tweets['tweets'])) {
            foreach( $tweets['tweets'] as $tweet ) {
                if( is_object( $tweet ) ) {
                    $tweet_text = htmlentities($tweet->text, ENT_QUOTES);
                    $tweet_text = preg_replace( '/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', 'http://$1', $tweet_text );

                    ?>

                    <div class="tweet-box">
                        <p>
                            <i>@<span class="main-text-color"><?php echo $tweet->user->screen_name ?></span></i>
                            <?php echo $tweet_text ?>
<!--                            <a class="time" href="--><?php //echo $tweet->entities->urls[0]->url ?><!--">-->
                                <i style="white-space: nowrap;" class="main-text-color">(<?php echo human_time_diff( strtotime( $tweet->created_at ) ) ?> ago)</i>
<!--                            </a>-->
                        </p>
                    </div>

                    <?php

                }
            }
        }
        else {
            echo $tweets['tweets'];
        }
        echo '</div>';

        echo $args['after_widget'];
    }
};
