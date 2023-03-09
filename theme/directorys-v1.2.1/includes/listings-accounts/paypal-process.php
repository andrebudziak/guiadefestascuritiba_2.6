<?php

function holo_paypal_process($args) {

    $paypal_settings = get_option('ht_paypal_settings');
    $listings_user_roles = get_option('ht_packages');

    $account_type = $args['account_type'];
    $PayPalMode 			= $paypal_settings['paypal_sandbox'] ? 'sandbox' : 'live'; // sandbox or live
    $PayPalApiUsername 		= $paypal_settings['paypal_username']; //PayPal API Username
    $PayPalApiPassword 		= $paypal_settings['paypal_password']; //Paypal API password
    $PayPalApiSignature 	= $paypal_settings['paypal_signature']; //Paypal API Signature
    $PayPalCurrencyCode 	= $paypal_settings['paypal_currency']; //Paypal Currency Code
    $PayPalReturnURL 		= $args['return_url']; //Point to process.php page
    $PayPalCancelURL 		= $args['cancel_url']; //Cancel URL if user clicks cancel

    $paypalmode = ($PayPalMode=='sandbox') ? '.sandbox' : '';

//    echo $PayPalApiUsername . ' ' . $PayPalApiPassword . ' ' . $PayPalApiSignature;

    $account_name = $listings_user_roles[$account_type]['account_name'];
    $account_price = $listings_user_roles[$account_type]['account_price'];

    $ItemName = $paypal_settings['paypal_payment_name'] . ' - ' . $account_name; //Item Name
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

        /*
        //Additional products (L_PAYMENTREQUEST_0_NAME0 becomes L_PAYMENTREQUEST_0_NAME1 and so on)
        '&L_PAYMENTREQUEST_0_NAME1='.urlencode($ItemName2).
        '&L_PAYMENTREQUEST_0_NUMBER1='.urlencode($ItemNumber2).
        '&L_PAYMENTREQUEST_0_DESC1='.urlencode($ItemDesc2).
        '&L_PAYMENTREQUEST_0_AMT1='.urlencode($ItemPrice2).
        '&L_PAYMENTREQUEST_0_QTY1='. urlencode($ItemQty2).
        */

        /*
        //Override the buyer's shipping address stored on PayPal, The buyer cannot edit the overridden address.
        '&ADDROVERRIDE=1'.
        '&PAYMENTREQUEST_0_SHIPTONAME=J Smith'.
        '&PAYMENTREQUEST_0_SHIPTOSTREET=1 Main St'.
        '&PAYMENTREQUEST_0_SHIPTOCITY=San Jose'.
        '&PAYMENTREQUEST_0_SHIPTOSTATE=CA'.
        '&PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE=US'.
        '&PAYMENTREQUEST_0_SHIPTOZIP=95131'.
        '&PAYMENTREQUEST_0_SHIPTOPHONENUM=408-967-4444'.
        */

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

    $paypalurl = '';

//Respond according to message we receive from Paypal
    if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {

        //Redirect user to PayPal store with Token received.
        $paypalurl = 'https://www' . $paypalmode . '.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $httpParsedResponseAr["TOKEN"] . '';

    } else {
        //Show error message
//        echo '<div style="color:red"><b>Error : </b>' . urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]) . '</div>';
//        echo '<pre>';
//        print_r($httpParsedResponseAr);
//        echo '</pre>';

        return false;
    }

    return $paypalurl;

}