<?php
/**
 *   (C) Copyright 1997-2013 hSenid International (pvt) Limited.
 *   All Rights Reserved.
 *
 *   These materials are unpublished, proprietary, confidential source code of
 *   hSenid International (pvt) Limited and constitute a TRADE SECRET of hSenid
 *   International (pvt) Limited.
 *
 *   hSenid International (pvt) Limited retains all title to and intellectual
 *   property rights in these materials.
 */

include_once '../../../lib/cass/DirectDebitSender.php';
include_once '../../../lib/cass/KLogger.php';
include_once '../conf/cass-conf.php';
ini_set('error_log', 'direct-debit-error.log');

$logger = new KLogger ( "cass_debug.log" , KLogger::DEBUG );

//Get data from configuration file
$applicationId = $APP_ID;
$password = $PASSWORD;
$externalTrxId = $EXTERNAL_TRX_ID;
$subscriberId = $_POST["msisdn"];
$paymentInstrumentName = $PAYMENT_INSTRUMENT_NAME;
$accountId = $ACCOUNT_ID;
$currency = $CURRENCY;
$amount = $_POST["amount"];

$logger->LogDebug("DirectDebitHandler : Received msisdn=".$subscriberId);
$logger->LogDebug("DirectDebitHandler : Received amount=".$amount);

// Create the sender object server url
try {
    $sender = new DirectDebitSender($SEVER_URL_DIRECT_DEBIT_SENDER);
    $jsonResponse = $sender->cass($applicationId, $password, $externalTrxId, $subscriberId, $paymentInstrumentName, $accountId, $currency, $amount);
} catch (CassException $ex) {
    error_log("CASS direct-debit ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
}
//Get the response data from json
$responseArray = json_decode($jsonResponse, true);
$statusCode = $responseArray['statusCode'];
$timeStamp = $responseArray['timeStamp'];
$shortDescription = $responseArray['shortDescription'];
$statusDetail = $responseArray['statusDetail'];
$externalTrxId = $responseArray['externalTrxId'];
$longDescription = $responseArray['longDescription'];
$internalTrxId = $responseArray['internalTrxId'];

//Create a html page to using php to show the response data
?>


<html>
<head>
    <link href='../bootstrap/css/bootstrap.css' rel='stylesheet'>
    <link href='../custom-css/custom.css' rel='stylesheet'>
</head>
<body class='boby-padding'>
<div class='navbar navbar-inverse navbar-fixed-top'>
    <div class='navbar-inner'>
        <div class='container'>
            <a class='brand' href='http://www.ideamart.lk/' target='_blank'>IdeaMart</a>
            <ul class='nav'>
                <li><a href='../html/DirectDebitSampleApp.html'>Direct Debit</a>
                </li>
                <li><a class='active' href='../html/QueryBalanceSample.html'>Query Balance</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class='query-content-unit'>
    <h2 class='cass_header' align='center'>Direct-Debit Response</h2>
    <table width='650' align='center' cellpadding='4' cellspacing='0' class='table table-condensed'>
        <tr>
            <th>Status Code</th>
            <th>Time Stamp</th>
            <th>Short Description</th>
            <th>Status Detail</th>
            <th>External Trx-Id</th>
            <th>Long Description</th>
            <th>Internal Trx-Id</th>
        </tr>
        <tr class='success'>
            <td><?php echo $statusCode?></td>
            <td><?php echo $timeStamp ?></td>
            <td><?php echo $shortDescription ?></td>
            <td><?php echo $statusDetail ?></td>
            <td><?php echo $externalTrxId ?></td>
            <td><?php echo $longDescription ?></td>
            <td><?php echo $internalTrxId ?></td>
        </tr>
    </table>
    <br/>
    <a href='../html/DirectDebitSampleApp.html' align='right'>
        <button class='btn btn-success' align='Right'>Back</button>
    </a>
</div>
<div id='footer'>
    <div align='center' style='color: darkgreen'>
        <span>Copyright &#169 2013 hSenid Mobile Solutions (Pvt) Ltd. All Rights Reserved.</span>
    </div>
</div>
</html>

