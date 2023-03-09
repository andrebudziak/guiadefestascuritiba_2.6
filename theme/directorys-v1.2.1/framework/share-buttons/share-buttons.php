<?php

class Holo_Share_Buttons {

    private $post_id = '';
    private $page_permalink = '';
    private $share_buttons = array();
    public $activated_buttons = array();


    public function __construct($post_id) {

        global $corex_options;

        $this->activated_buttons = $corex_options['social_share_buttons']['enabled'];
        $this->post_id = $post_id;
        $this->page_permalink = get_permalink($this->post_id);

        $this->init();
        $this->set_share_links();
        $this->set_share_icons();

    }

    public function init() {

        add_action('wp_enqueue_scripts', array($this, 'include_scripts'));

    }

    public function include_scripts() {

        wp_enqueue_style('holo-share-buttons', HOLO_FRAMEWORK_DIR_URI . '/style.css');

    }

    private function set_share_links() {

        $this->share_buttons['facebook']['link'] = 'http://www.facebook.com/sharer.php?u=' . $this->page_permalink;
        $this->share_buttons['twitter']['link'] = 'http://twitter.com/share?url=' . $this->page_permalink;
        $this->share_buttons['google_plus']['link'] = 'https://plus.google.com/share?url=' . $this->page_permalink;
        $this->share_buttons['diggit']['link'] = 'http://www.digg.com/submit?url=' . $this->page_permalink;
        $this->share_buttons['reddit']['link'] = 'http://reddit.com/submit?url=' . $this->page_permalink;
        $this->share_buttons['linkedin']['link'] = 'http://www.linkedin.com/shareArticle?mini=true&amp;url=' . $this->page_permalink;
        $this->share_buttons['pinterest']['link'] = 'javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;//assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());';
        $this->share_buttons['stumble_upon']['link'] = 'http://www.stumbleupon.com/submit?url=' . $this->page_permalink;
        $this->share_buttons['flattr']['link'] = 'https://flattr.com/submit/auto?user_id=' . $this->page_permalink;
        $this->share_buttons['tumblr']['link'] = 'http://www.tumblr.com/share/link?url=' . $this->page_permalink;

    }

    private function set_share_icons() {

        $this->share_buttons['facebook']['icon'] = '<i class="fa fa-facebook"></i>';
        $this->share_buttons['twitter']['icon'] = '<i class="fa fa-twitter"></i>';
        $this->share_buttons['google_plus']['icon'] = '<i class="fa fa-google-plus"></i>';
        $this->share_buttons['diggit']['icon'] = '<i class="fa fa-diggit"></i>';
        $this->share_buttons['reddit']['icon'] = '<i class="fa fa-reddit"></i>';
        $this->share_buttons['linkedin']['icon'] = '<i class="fa fa-linkedin"></i>';
        $this->share_buttons['pinterest']['icon'] = '<i class="fa fa-pinterest"></i>';
        $this->share_buttons['stumble_upon']['icon'] = '<i class="fa fa-stumble-upon"></i>';
        $this->share_buttons['flattr']['icon'] = '<i class="fa fa-flattr"></i>';
        $this->share_buttons['tumblr']['icon'] = '<i class="fa fa-tumblr"></i>';

    }

    public function display_share_buttons() {

        $share_buttons = '';

        foreach ($this->activated_buttons as $activated_button_key => $activated_button) {

            $button_key = strtolower($activated_button_key);

            if ($button_key !== 'placebo') {

                $button = $this->share_buttons[$button_key];
                $share_buttons .= '<a class="' . $button_key . '" href="' . $button['link'] . '" target="_blank">' . $button['icon'] . '</a>';

            }

        }

        return $share_buttons;

    }

}



function holo_display_share_buttons($post_id, $echo = true) {

    $holo_share = new Holo_Share_Buttons($post_id);

    if ($echo) :

        if ($holo_share->display_share_buttons() !== '') :

        ?>

            <div class="share">
                <i class="fa fa-share">
                    <span class="socials">
                        <?php echo $holo_share->display_share_buttons(); ?>
                    </span>
                </i>

                <div>Share</div>
            </div>

        <?php

        endif;

    else :

        $share_markup = '
            <div class="share">
                <i class="fa fa-share">
                    <span class="socials">
                        ' . $holo_share->display_share_buttons() . '
                    </span>
                </i>

                <div>Share</div>
            </div>
        ';

        return $share_markup;

    endif;

}