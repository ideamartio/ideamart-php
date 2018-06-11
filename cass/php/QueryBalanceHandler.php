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

include_once '../../../lib/cass/QueryBalanceSender.php';
include_once '../../../lib/cass/KLogger.php';
include_once '../conf/cass-conf.php';
ini_set('error_log', 'query-balance-error.log');

$logger = new KLogger ( "cass_debug.log" , KLogger::DEBUG );

//Get data from configuration file
$applicationId = $APP_ID;
$password = $PASSWORD;
$subscriberId = $_POST["msisdn"];
$paymentInstrumentName = $PAYMENT_INSTRUMENT_NAME;
$accountId = $ACCOUNT_ID;
$currency = $CURRENCY;

$logger->LogDebug("QueryBalanceHandler : Received msisdn=".$subscriberId);

// Create the sender object server url
try {
    $sender = new QueryBalanceSender($SEVER_URL_QUERY_BALANCE_SENDER);
    $jsonResponse = $sender->queryBalance($applicationId, $password, $subscriberId, $paymentInstrumentName, $accountId, $currency);
} catch (CassException $ex) {
    error_log("CASS query-balance ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
}
//Get the response data from json
$responseArray = json_decode($jsonResponse, true);
$chargeableBalance = $responseArray['chargeableBalance'];
$statusCode = $responseArray['statusCode'];
$statusDetail = $responseArray['statusDetail'];
$accountStatus = $responseArray['accountStatus'];
$accountType = $responseArray['accountType'];
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
    <h2 class='cass_header' align='center'>Query Balance Response</h2>
    <table width='650' align='center' cellpadding='4' cellspacing='0' class='table table-condensed'>
        <tr>
            <th>Chargeable Balance</th>
            <th>Status Code</th>
            <th>Status Detail</th>
            <th>Account Status</th>
            <th>Account Type</th>
        </tr>
        <tr class='success'>
            <td><?php echo $chargeableBalance?></td>
            <td><?php echo $statusCode ?></td>
            <td><?php echo $statusDetail ?></td>
            <td><?php echo $accountStatus ?></td>
            <td><?php echo $accountType ?></td>
        </tr>
    </table>
    <br/>
    <a href='../html/QueryBalanceSample.html' align='right'>
        <button class='btn btn-success' align='Right'>Back</button>
    </a>
</div>
<div id='footer'>
    <div align='center' style='color: darkgreen'>
        <span>Copyright &#169 2013 hSenid Mobile Solutions (Pvt) Ltd. All Rights Reserved.</span>
    </div>
</div>
</html>