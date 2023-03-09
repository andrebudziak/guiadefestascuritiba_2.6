<?php

$directorys_options_sections[] = array(
    'title' => 'General Settings',
    'icon' => 'el-icon-home',
    'fields' => array(
        array(
            'id'=>'favicon',
            'type' => 'media',
            'title' => __('Favicon', 'redux-framework-demo'),
            'compiler' => 'true',
            'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'subtitle' => __('The uploaded image will be displayed as favicon.', 'redux-framework-demo'),
            'desc'=> '',
        ),
        array(
            'id'        => 'show_go_to_top',
            'type'      => 'switch',
            'title'     => __('Show "GO TO TOP" button', 'redux-framework-demo'),
            'subtitle'  => __('Choose if you want the "GO TO TOP" button to be displayed when the user navigates the pages', 'redux-framework-demo'),
            'default' => '1'
        ),
//        array(
//            'id'        => 'background_image',
//            'type'      => 'background',
//            'title'     => __('Background Image', 'redux-framework-demo'),
//            'subtitle'  => __('The chosen image will be set as the background for your website.<br />', 'redux-framework-demo'),
//            'background-repeat' => true,
//            'background-image' => true,
//            'transparent' => true,
//            'background-position' => true
//        ),
        array(
            'id'        => 'color_theme',
            'type'      => 'color',
            'title'     => __('Main Color Theme', 'redux-framework-demo'),
            'subtitle'  => __('This color is used throughout your website as the main highlighted color.', 'redux-framework-demo'),
            'transparent' => false,
            'default' => '#90c23a'
        ),
        array(
            'id'        => 'second_color_theme',
            'type'      => 'color',
            'title'     => __('Second Color Theme', 'redux-framework-demo'),
            'subtitle'  => __('This color is used throughout your website for the footer and other minor sections.', 'redux-framework-demo'),
            'transparent' => false,
            'default' => '#2C3E52'
        ),
        array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => __('Custom CSS', 'redux-framework-demo'),
            'subtitle' => __('Your custom CSS.', 'redux-framework-demo'),
            'mode'     => 'css',
            'theme'    => 'chrome',
            'default'  => "/* Here goes your CSS code */",
            'options' => array('minLines' => 20, 'maxLines' => 30),
        ),
        array(
            'id'=>'google_analytics',
            'type' => 'ace_editor',
            'title' => __('Google Analytics', 'redux-framework-demo'),
            'subtitle' => __('Insert your google analytics snippet, It will be placed in every page.', 'redux-framework-demo'),
            'mode'     => 'html',
            'theme'    => 'chrome',
            'default'  => "<!-- Here goes your Google Analytics code -->",
        ),
        array(
            'id'        => 'listings_permalink_slug',
            'type'      => 'text',
            'title'     => __('Listings permalink Slug', 'redux-framework-demo'),
            'subtitle'  => __('This will change the name of the name displayed in "listings" permalinks. <br /> This will only take effect if permalinks are "Post Name" type.', 'redux-framework-demo'),
            'default' => 'site'
        ),
        array(
            'id' => 'default_map_latitude',
            'type' => 'text',
            'title' => __('Google Map Default Latitude', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('This is the latitude coordinates the google map shows if there are no sites to show.', 'redux-framework-demo'),
            'default' => '40.7127837'
        ),
        array(
            'id' => 'default_map_longitude',
            'type' => 'text',
            'title' => __('Google Map Default Longitude', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('This is the longitude coordinates the google map shows if there are no sites to show.', 'redux-framework-demo'),
            'default' => '-74.00594130000002'
        ),
        array(
            'id' => 'map_overlay_opacity',
            'type' => 'slider',
            'title' => __('Google Map Overlay Opacity', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('Here you choose how transparent the google map overlay will be.', 'redux-framework-demo'),
            'min' => '0',
            'max' => '1',
            'step' => '.05',
            'resolution' => 0.01,
            'float_mark' => 'decimal',
            'default' => '.7'
        ),
        array(
            'id'        => 'map_geolocation_use',
            'type'      => 'switch',
            'title'     => __('Map Geolocation Use', 'redux-framework-demo'),
            'subtitle'  => __('Choose if you want the GEOLOCATION option to be shown in search.', 'redux-framework-demo'),
            'default' => '1'
        ),
        array(
            'id'        => 'map_geolocation_always_active',
            'type'      => 'switch',
            'title'     => __('Map Geolocation Always Active', 'redux-framework-demo'),
            'subtitle'  => __('Choose if you want the GEOLOCATION feature to be always active. <br /> This will hide the geolocation distance option to viewers.', 'redux-framework-demo'),
            'default' => '0'
        ),
        array(
            'id'        => 'map_length_unit',
            'type'      => 'select',
            'title'     => __('Map Geolocation length unit', 'redux-framework-demo'),
            'subtitle'  => __('Choose the unit of length you want users to use to measure the radius of the search area.', 'redux-framework-demo'),
            'options' => array('km' => 'Kilometers', 'mi' => 'Miles'),
            'default' => 'km'
        ),
        array(
            'id'        => 'map_geolocation_default_distance',
            'type'      => 'slider',
            'title'     => __('Map Geolocation Default Distance', 'redux-framework-demo'),
            'subtitle'  => __('Choose the GEOLOCATION search distance. <br /> If the GEOLOCATION is always active, the user cannot change this value in front-end.', 'redux-framework-demo'),
            'min' => '1',
            'max' => '1000',
            'step' => '1',
            'resolution' => 1,
            'float_mark' => 'decimal',
            'default' => '200'
        ),
        array(
            'id'        => 'map_use_predefined_zoom',
            'type'      => 'switch',
            'title'     => __('Map use predefined zoom', 'redux-framework-demo'),
            'subtitle'  => __('Choose if you want to use predefined zoom. <br /> If you choose to use predefined zoom, your makers might not be centered when they load.', 'redux-framework-demo'),
            'default' => '0'
        ),
        array(
            'id'        => 'map_default_zoom',
            'type'      => 'slider',
            'title'     => __('Map Geolocation Default Zoom', 'redux-framework-demo'),
            'subtitle'  => __('Choose the map starting zoom.', 'redux-framework-demo'),
            'min' => '1',
            'max' => '25',
            'step' => '1',
            'resolution' => 1,
            'float_mark' => 'decimal',
            'default' => '8',
            'required' => array('map_use_predefined_zoom', 'equals', '1')
        ),
        array(
            'id' => 'listing_custom_info_title',
            'type' => 'text',
            'title' => __('Listings Custom Fields Title', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('This is the text associated with the custom fields in "listing" page', 'redux-framework-demo'),
            'default' => 'Other Information'
        ),
        array(
            'id'=>'listings_fallback_featured_image',
            'type' => 'media',
            'title' => __('Fallback Image For Listings Featured Image', 'redux-framework-demo'),
            'compiler' => 'true',
            'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'subtitle' => __('Image size have to be 274x199 or higher.', 'redux-framework-demo'),
            'desc'=> '',
        ),

    )
);

$directorys_options_sections[] = array(
    'title' => 'Header',
    'icon' => '',
    'fields' => array(
        array(
            'id'=>'logo',
            'type' => 'media',
            'title' => __('Logo', 'redux-framework-demo'),
            'compiler' => 'true',
            'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'subtitle' => __('The uploaded image will be used as logo in your header.', 'redux-framework-demo'),
            'default' => array(
                'id' => 93,
                'url' => 'http://dev.holobestthemes.com/wp-content/uploads/2014/08/logo.png',
                'width' => 210,
                'height' => 36,
                'thumbnail' => 'http://dev.holobestthemes.com/wp-content/uploads/2014/08/logo-150x36.png'
            )
        ),
        array(
            'id'=>'mobile_logo',
            'type' => 'media',
            'title' => __('Mobile Logo', 'redux-framework-demo'),
            'compiler' => 'true',
            'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'subtitle' => __('This image is used as the logo on mobile devices.', 'redux-framework-demo'),
            'desc' => 'If you don\'t want a different logo on mobile devices, leave this field empty.'
        ),
        array(
            'id'=>'logo_text',
            'type' => 'text',
            'title' => __('Logo Text', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('This text is shown in your header logo space.<br /> <i>The logo has to be missing</i> .', 'redux-framework-demo')
        ),
        array(
            'id'        => 'pinned_header',
            'type'      => 'switch',
            'title'     => __('Pinned Header', 'redux-framework-demo'),
            'subtitle'  => __('If \'on\', it will make the header to be pinned at the top of the viewport when you are navigating the page.', 'redux-framework-demo'),
            'default' => '1'
        ),
        array(
            'id'        => 'show_button',
            'type'      => 'switch',
            'title'     => __('Show Header Button', 'redux-framework-demo'),
            'subtitle'  => __('Choose if you want the login/register button to be visible in header.', 'redux-framework-demo'),
            'default' => '0'
        ),
        array(
            'id' => 'button_text',
            'type' => 'text',
            'title' => __('Header Button Text', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('This is the text of the header login/register button.', 'redux-framework-demo'),
            'default' => 'LOGIN'
        ),
        array(
            'id' => 'button_link',
            'type' => 'text',
            'title' => __('Header Button Link', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('The link of the login/register page.', 'redux-framework-demo'),
            'default' => wp_login_url()
        ),

    )
);

$directorys_options_sections[] = array(
    'title' => 'Typography',
    'icon' => '',
    'fields' => array(
        array(
            'id'            => 'typography',
            'type'          => 'typography',
            'title'         => __('Typography', 'redux-framework-demo'),
            //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
            'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup'   => false,    // Select a backup non-google font in addition to a google font
            'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
            //'subsets'       => false, // Only appears if google is true and subsets not set to false
            'font-size'     => false,
            'line-height'   => false,
            //'word-spacing'  => true,  // Defaults to false
            //'letter-spacing'=> true,  // Defaults to false
            'color'         => false,
            'text-align' => false,
            //'preview'       => false, // Disable the previewer
            'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
            'output'        => array('h2.site-description'), // An array of CSS selectors to apply this font style to dynamically
            'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
            'units'         => 'px', // Defaults to px
            'subtitle'      => __('This is the typography used throughout the website.', 'redux-framework-demo'),
            'default'       => array(
                'color'         => '#333',
                'font-family'   => 'Raleway',
                'google'        => true,
                'font-backup' => 'sans-serif'
            ),
        ),
    )
);

$directorys_options_sections[] = array(
    'title' => 'Footer',
    'icon' => '',
    'fields' => array(
        array(
            'id'=>'copyright_text',
            'type' => 'textarea',
            'title' => __('Copyright Text', 'redux-framework-demo'),
            'compiler' => 'true',
            'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'subtitle' => __('This text is displayed in the footer copyright bar.', 'redux-framework-demo'),
            'default' => 'Copyright 2013 - DirectoryS - All Rights reserved'
        ),
        array(
            'id'        => 'footer_social',
            'type'      => 'radio',
            'title'     => __('Header Layout', 'redux-framework-demo'),
            'subtitle'  => __('Choose if you want the social icons to be displayed in your footer copyright bar.', 'redux-framework-demo'),
            'options'  => array(
                '0' => 'No',
                '1' => 'Yes',
            ),
            'default' => '1'
        ),
    )
);

$directorys_options_sections[] = array(
    'title' => 'Social Icons',
    'icon' => '',
    'fields' => array(
        array(
            'id'=>'social_facebook',
            'type' => 'text',
            'title' => __('Facebook Link', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('', 'redux-framework-demo'),
            'default' => '#'
        ),
        array(
            'id'=>'social_twitter',
            'type' => 'text',
            'title' => __('Twitter Link', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('', 'redux-framework-demo'),
            'default' => '#'
        ),
        array(
            'id'=>'social_google_plus',
            'type' => 'text',
            'title' => __('Google Plus Link', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('', 'redux-framework-demo'),
            'default' => '#'
        ),
        array(
            'id'=>'social_dribbble',
            'type' => 'text',
            'title' => __('Dribbble Link', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('', 'redux-framework-demo'),
            'default' => '#'
        ),
        array(
            'id'=>'social_vimeo',
            'type' => 'text',
            'title' => __('Vimeo Link', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('', 'redux-framework-demo'),
            'default' => '#'
        ),
        array(
            'id'=>'social_skype',
            'type' => 'text',
            'title' => __('Skype Link', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('', 'redux-framework-demo'),
            'default' => '#'
        ),
        array(
            'id'=>'social_linkedin',
            'type' => 'text',
            'title' => __('Linkedin Link', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('', 'redux-framework-demo'),
            'default' => '#'
        ),
        array(
            'id'=>'social_pinterest',
            'type' => 'text',
            'title' => __('Pinterest Link', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('', 'redux-framework-demo'),
            'default' => '#'
        )
    )
);

$directorys_options_sections[] = array(
    'title' => 'Sidebar Positions',
    'icon' => '',
    'fields' => array(
        array(
            'id'=>'posts_sidebar_position',
            'type' => 'select',
            'title' => __('Single Post Sidebar Position', 'redux-framework-demo'),
            'compiler' => 'true',
            'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'subtitle' => __('Choose what is the position of the sidebar on posts page.', 'redux-framework-demo'),
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'no_show' => 'Don\'t show'
            ),
            'default' => 'right'
        ),
        array(
            'id'=>'sites_sidebar_position',
            'type' => 'select',
            'title' => __('Single Site Sidebar Position', 'redux-framework-demo'),
            'compiler' => 'true',
            'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'subtitle' => __('Choose what is the position of the sidebar on site page.', 'redux-framework-demo'),
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'no_show' => 'Don\'t show'
            ),
            'default' => 'right'
        ),
        array(
            'id'=>'archive_sidebar_position',
            'type' => 'select',
            'title' => __('Archive Page Sidebar Position', 'redux-framework-demo'),
            'compiler' => 'true',
            'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'subtitle' => __('Choose what is the position of the sidebar on archive page.', 'redux-framework-demo'),
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'no_show' => 'Don\'t show'
            ),
            'default' => 'right'
        ),
        array(
            'id'=>'search_sidebar_position',
            'type' => 'select',
            'title' => __('Search Page Sidebar Position', 'redux-framework-demo'),
            'compiler' => 'true',
            'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'subtitle' => __('Choose what is the position of the sidebar on search page.', 'redux-framework-demo'),
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'no_show' => 'Don\'t show'
            ),
            'default' => 'right'
        ),
    )
);

$directorys_options_sections[] = array(
    'title' => 'Header Top Bar',
    'icon' => '',
    'fields' => array(
        array(
            'id'=>'show_top_bar',
            'type' => 'switch',
            'title' => __('Show Header Top Bar', 'redux-framework-demo'),
            'compiler' => 'true',
            'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'subtitle' => __('Choose if you want to show the header top bar.', 'redux-framework-demo'),
        ),
        array(
            'id' => 'show_top_bar_contact',
            'type' => 'switch',
            'title' => __('Show Contact In Top Bar'),
            'subtitle' => __('Choose if you want to display contact info in top bar.')
        ),
        array(
            'id'=>'top_bar_address',
            'type' => 'text',
            'title' => __('Contact Address', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('', 'redux-framework-demo'),
            'required' => array('show_top_bar_contact', '=', '1')
        ),
        array(
            'id'=>'top_bar_phone',
            'type' => 'text',
            'title' => __('Contact Phone', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('', 'redux-framework-demo'),
            'required' => array('show_top_bar_contact', '=', '1')
        ),
        array(
            'id'=>'top_bar_email',
            'type' => 'text',
            'title' => __('Contact Email', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('', 'redux-framework-demo'),
            'required' => array('show_top_bar_contact', '=', '1')
        ),
        array(
            'id'=>'top_bar_website',
            'type' => 'text',
            'title' => __('Contact Website', 'redux-framework-demo'),
            'compiler' => 'true',
            'subtitle' => __('', 'redux-framework-demo'),
            'required' => array('show_top_bar_contact', '=', '1')
        ),
    )
);

$directorys_options_sections[] = array(
    'title' => 'Top Section',
    'icon' => '',
    'desc' => 'This section is used to choose if you want to show "Google Map" and "Listings Filter Bar in pages where the structure is dictated by a template.',
    'fields' => array(
//        array(
//            'id'       => 'map_on_page',
//            'type'     => 'checkbox',
//            'title'    => __('Google Map Everywhere', 'redux-framework-demo'),
//            'subtitle' => __('Check the pages you want the map to be displayed on:', 'redux-framework-demo'),
//            'options'  => array(
//                'index' => 'Index page',
//                'post_single' => 'Post page',
//                'site_single' => 'Site page',
//                'post_archive' => 'Posts archive page',
//                'site_archive' => 'Sites archive page',
//                'post_search' => 'Posts search page',
//                'site_search' => 'Sites search page',
//                'custom' => 'Custom Pages (This will not affect already saved pages. It will just set the Google Map as default option when create a new page.)',
//                'page_404' => '404 page'
//            ),
//            'default' => array(
//                'index' => '1',
//                'post_single' => '0',
//                'site_single' => '0',
//                'post_archive' => '0',
//                'site_archive' => '1',
//                'post_search' => '0',
//                'site_search' => '1',
//                'custom' => '0',
//                'page_404' => '0'
//            )
//        ),
        array(
            'id'=>'top_section_on_index',
            'type' => 'checkbox',
            'title' => __('On Index Page', 'redux-framework-demo'),
            'options' => array(
                'map' => 'Google Map',
                'filter_bar' => 'Filter Bar'
            )
        ),
        array(
            'id'=>'top_section_on_post_single',
            'type' => 'checkbox',
            'title' => __('On Post Page', 'redux-framework-demo'),
            'options' => array(
                'map' => 'Google Map',
                'filter_bar' => 'Filter Bar'
            )
        ),
        array(
            'id'=>'top_section_on_site_single',
            'type' => 'checkbox',
            'title' => __('On Site Page', 'redux-framework-demo'),
            'options' => array(
                'map' => 'Google Map',
                'filter_bar' => 'Filter Bar'
            )
        ),
        array(
            'id'=>'top_section_on_post_archive',
            'type' => 'checkbox',
            'title' => __('On Posts Archive Page', 'redux-framework-demo'),
            'options' => array(
                'map' => 'Google Map',
                'filter_bar' => 'Filter Bar'
            )
        ),
        array(
            'id'=>'top_section_on_site_archive',
            'type' => 'checkbox',
            'title' => __('On Sites Archive Page', 'redux-framework-demo'),
            'options' => array(
                'map' => 'Google Map',
                'filter_bar' => 'Filter Bar'
            )
        ),
        array(
            'id'=>'top_section_on_post_search',
            'type' => 'checkbox',
            'title' => __('On Posts Search Page', 'redux-framework-demo'),
            'options' => array(
                'map' => 'Google Map',
                'filter_bar' => 'Filter Bar'
            )
        ),
        array(
            'id'=>'top_section_on_site_search',
            'type' => 'checkbox',
            'title' => __('On Sites Search Page', 'redux-framework-demo'),
            'options' => array(
                'map' => 'Google Map',
                'filter_bar' => 'Filter Bar'
            ),
            'default' => array(
                'map' => '1',
                'filter_bar' => '1'
            )
        ),
//        array(
//            'id'=>'top_section_on_custom',
//            'type' => 'checkbox',
//            'title' => __('On Custom Page', 'redux-framework-demo'),
//            'options' => array(
//                'map' => 'Google Map',
//                'filter_bar' => 'Filter Bar'
//            )
//        ),
        array(
            'id'=>'top_section_on_page_404',
            'type' => 'checkbox',
            'title' => __('On 404 Page', 'redux-framework-demo'),
            'options' => array(
                'map' => 'Google Map',
                'filter_bar' => 'Filter Bar'
            )
        ),

    )
);


