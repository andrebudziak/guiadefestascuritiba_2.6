<?php


/*resulting pixel = opacity*original + (1-opacity)*background*/
function blend_alpha($background = array(2, 117, 15), $rgba = array(0, 0, 0, 0.15)) {

    $opacity = $rgba[3];

    $bg_r = $background[0];
    $bg_g = $background[1];
    $bg_b = $background[2];

    $org_r = $rgba[0];
    $org_g = $rgba[1];
    $org_b = $rgba[2];

    $r = ceil($opacity * $org_r + (1 - $opacity) * $bg_r);
    $g = ceil($opacity * $org_g + (1 - $opacity) * $bg_g);
    $b = ceil($opacity * $org_b + (1 - $opacity) * $bg_b);

    return 'rgb(' . $r . ',' . $g . ',' . $b . ')';

}

function adjust_brightness($hex, $steps, $return_rgb = false) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Format the hex color string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Get decimal values
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    // Adjust number of steps and keep it inside 0 to 255
    $r = max(0,min(255,$r - $steps));
    $g = max(0,min(255,$g - $steps));
    $b = max(0,min(255,$b - $steps));

    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

    if ($return_rgb) {
        return 'rgb(' . $r . ',' . $g . ',' . $b . ')';
    } else {
        return '#'.$r_hex.$g_hex.$b_hex;
    }
}

function adjust_brightness_by_percent($hex, $percent) {

    // Format the hex color string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Get decimal values
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    // Adjust number of steps and keep it inside 0 to 255
    $r = max(0,min(255,$r + $steps));
    $g = max(0,min(255,$g + $steps));
    $b = max(0,min(255,$b + $steps));

    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

    return '#'.$r_hex.$g_hex.$b_hex;

}

function get_transparent_color($hex, $transparency = 1) {

    $rgb = hex2rgb($hex);

    $transparent_color = 'rgba(' . $rgb[0] . ',' . $rgb[1] . ',' . $rgb[2] . ',' . $transparency . ')';

    return $transparent_color;

}

function hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}

function rgbToHsl( $r, $g, $b ) {
    $oldR = $r;
    $oldG = $g;
    $oldB = $b;

    $r /= 255;
    $g /= 255;
    $b /= 255;

    $max = max( $r, $g, $b );
    $min = min( $r, $g, $b );

    $h;
    $s;
    $l = ( $max + $min ) / 2;
    $d = $max - $min;

    if( $d == 0 ){
        $h = $s = 0; // achromatic
    } else {
        $s = $d / ( 1 - abs( 2 * $l - 1 ) );

        switch( $max ){
            case $r:
                $h = 60 * fmod( ( ( $g - $b ) / $d ), 6 );
                if ($b > $g) {
                    $h += 360;
                }
                break;

            case $g:
                $h = 60 * ( ( $b - $r ) / $d + 2 );
                break;

            case $b:
                $h = 60 * ( ( $r - $g ) / $d + 4 );
                break;
        }
    }

    return array( round( $h, 2 ), round( $s, 2 ), round( $l, 2 ) );
}