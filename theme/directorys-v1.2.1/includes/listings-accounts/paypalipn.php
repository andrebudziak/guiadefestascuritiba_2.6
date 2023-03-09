<?php

// paypal is going to send a large post to the url we specified in the admin.
// read the post from PayPal system, turn it into a query url,
// and add the 'cmd' validate value to post it back to PayPal.
// this step ensures that the information we received from PayPal is
// legitimate.
$req = 'cmd=_notify-validate';

include_once(dirname(dirname(dirname(dirname(dirname(dirname ( __FILE__ )))))) . '/wp-load.php');

foreach ($_POST as $key => $value) {
    $value = urlencode(stripslashes($value));
    $req .= "&$key=$value";
}

// post back to PayPal system for validation
$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

$fp = fsockopen('ssl://www.paypal.com', 443, $errno, $errstr, 30);

// turn the original post data into an object we can work with
$txn = (object) $_POST;

/* Debugging code*/
$content = serialize($_POST);

if (!empty($_POST)) {
    $myfp = fopen(__DIR__ . "/myText.txt","wb");
    fwrite($myfp, $txn->custom);
    fclose($myfp);
}

echo '<pre>';
var_dump((file_get_contents(__DIR__ . "/myText.txt")));
echo '</pre>';

/* End debugging code*/

if (!$fp) {
    log_error('HTTP CONNECTION ERROR', $_POST);
} else {
    fputs($fp, $header . $req);

    while (!feof($fp)) {
        $res = fgets($fp, 1024);

        // proceed if transaction is verified
        //if (strcmp ($res, "VERIFIED") == 0) {
            // Do some simple error checks:
            // check if the payment_status is Completed
            if ($txn->payment_status == 'Completed') {

                global $wpdb;

                $listing_accounts_table_name = $wpdb->prefix . 'ht_listing_accounts';
                $user_id = get_current_user_id();

                $wpdb->update(
                    $listing_accounts_table_name,
                    array(
                        'payment_check' => '1'
                    ),
                    array( 'user_id' => $txn->custom ),
                    array(
                        '%d'	// value2
                    ),
                    array( '%d' )
                );

            }
            // check that receiver_email is your Primary PayPal email
            if ( $txn->receiver_email != RECEIVER_EMAIL ) {
                log_error('INVALID RECEIVER EMAIL', $txn);
                exit;
            }
            // check that txn_id has not been previously processed
            if ( check_existing_transaction($txn) ) {
                log_error('ALREADY PROCESSED', $txn);
                exit;
            }

            // Here's where the 'custom' magic happens. Use parse_str
            // to take the still url encoded custom str and turn it
            // into an array we can work with
            $custom = array();
            parse_str($txn->custom, $custom);

            // Now we can do things with the $txn and $custom array
            // like add a database record for the user/transaction,
            // send a response email, etc.
        //}
        //else if (strcmp ($res, "INVALID") == 0) {
          //  log_error('TRANSACTION INVALID', $txn);
        //}
    }
}

fclose ($fp);
exit;
?>