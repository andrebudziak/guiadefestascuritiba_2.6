<?php

add_action('wp_ajax_paypal_connection_check', 'check_paypal_credentials');

function check_paypal_credentials() {

    $paypal_settings = get_option('ht_paypal_settings');

    $PayPalMode 			= $paypal_settings['paypal_sandbox'] ? 'sandbox' : 'live'; // sandbox or live
    $PayPalApiUsername 		= $paypal_settings['paypal_username']; //PayPal API Username
    $PayPalApiPassword 		= $paypal_settings['paypal_password']; //Paypal API password
    $PayPalApiSignature 	= $paypal_settings['paypal_signature']; //Paypal API Signature
    $PayPalCurrencyCode 	= $paypal_settings['paypal_currency']; //Paypal Currency Code
    $PayPalReturnURL 		= 'http://google.com'; //Point to process.php page
    $PayPalCancelURL 		= 'http://google.com'; //Cancel URL if user clicks cancel

    $paypalmode = ($PayPalMode=='sandbox') ? '.sandbox' : '';

//    echo $PayPalApiUsername . ' ' . $PayPalApiPassword . ' ' . $PayPalApiSignature;

    $account_price = 0.01;

    $ItemName = 'Test'; //Item Name
    $ItemPrice = $account_price; //Item Price
    $ItemNumber = 1; //Item Number
    $ItemDesc = ''; //Item Number
    $ItemQty = 1; // Item Quantity
    $ItemTotalPrice = ($ItemPrice * $ItemQty); //(Item Price x Quantity = Total) Get total amount of product;

//Other important variables like tax, shipping cost
    $TotalTaxAmount = 0;  //Sum of tax for all items in this order.
    $HandalingCost = 0;  //Handling cost for this order.
    $InsuranceCost = 0;  //shipping insurance cost for this order.
    $ShippinDiscount = 0; //Shipping discount for this order. Specify this as negative number.
    $ShippinCost = 0; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.

//Grand total including all tax, insurance, shipping cost and discount
    $GrandTotal = ($ItemTotalPrice + $TotalTaxAmount + $HandalingCost + $InsuranceCost + $ShippinCost + $ShippinDiscount);

//Parameters for SetExpressCheckout, which will be sent to PayPal
    $padata = '&METHOD=SetExpressCheckout' .
        '&RETURNURL=' . urlencode($PayPalReturnURL) .
        '&CANCELURL=' . urlencode($PayPalCancelURL) .
        '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode("SALE") .

        '&L_PAYMENTREQUEST_0_NAME0=' . urlencode($ItemName) .
        '&L_PAYMENTREQUEST_0_NUMBER0=' . urlencode($ItemNumber) .
        '&L_PAYMENTREQUEST_0_DESC0=' . urlencode($ItemDesc) .
        '&L_PAYMENTREQUEST_0_AMT0=' . urlencode($ItemPrice) .
        '&L_PAYMENTREQUEST_0_QTY0=' . urlencode($ItemQty) .

        '&NOSHIPPING=1' . //set 1 to hide buyer's shipping address, in-case products that does not require shipping

        '&PAYMENTREQUEST_0_ITEMAMT=' . urlencode($ItemTotalPrice) .
        '&PAYMENTREQUEST_0_TAXAMT=' . urlencode($TotalTaxAmount) .
        '&PAYMENTREQUEST_0_SHIPPINGAMT=' . urlencode($ShippinCost) .
        '&PAYMENTREQUEST_0_HANDLINGAMT=' . urlencode($HandalingCost) .
        '&PAYMENTREQUEST_0_SHIPDISCAMT=' . urlencode($ShippinDiscount) .
        '&PAYMENTREQUEST_0_INSURANCEAMT=' . urlencode($InsuranceCost) .
        '&PAYMENTREQUEST_0_AMT=' . urlencode($GrandTotal) .
        '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode($PayPalCurrencyCode) .
        '&LOCALECODE=GB' . //PayPal pages to match the language on your website.
        '&LOGOIMG=' . //site logo
        '&CARTBORDERCOLOR=FFFFFF' . //border color of cart
        '&ALLOWNOTE=1';

############# set session variable we need later for "DoExpressCheckoutPayment" #######
    $_SESSION['ItemName'] = $ItemName; //Item Name
    $_SESSION['ItemPrice'] = $ItemPrice; //Item Price
    $_SESSION['ItemNumber'] = $ItemNumber; //Item Number
    $_SESSION['ItemDesc'] = $ItemDesc; //Item Number
    $_SESSION['ItemQty'] = $ItemQty; // Item Quantity
    $_SESSION['ItemTotalPrice'] = $ItemTotalPrice; //(Item Price x Quantity = Total) Get total amount of product;
    $_SESSION['TotalTaxAmount'] = $TotalTaxAmount;  //Sum of tax for all items in this order.
    $_SESSION['HandalingCost'] = $HandalingCost;  //Handling cost for this order.
    $_SESSION['InsuranceCost'] = $InsuranceCost;  //shipping insurance cost for this order.
    $_SESSION['ShippinDiscount'] = $ShippinDiscount; //Shipping discount for this order. Specify this as negative number.
    $_SESSION['ShippinCost'] = $ShippinCost; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.
    $_SESSION['GrandTotal'] = $GrandTotal;


//We need to execute the "SetExpressCheckOut" method to obtain paypal token
    $paypal = new Holo_Paypal();
    $httpParsedResponseAr = $paypal->PPHttpPost('SetExpressCheckout', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

    if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {

        $return_data['message'] = '<div style="color:green"><b>Success!</b></div>';

        $return_data = json_encode($return_data);

        echo $return_data;

        exit();

    } else {

        $return_data['message'] = '<div style="color:red"><b>Error : </b>' . urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]) . '</div>';
        $return_data['error_meta'] = $httpParsedResponseAr;

        $return_data = json_encode($return_data);

        echo $return_data;

        exit();

    }

}