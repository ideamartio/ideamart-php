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

include_once '../../lib/sms/SmsDeliveryReport.php';
include_once '../log.php';
ini_set('error_log', 'sms-delivery-report-error.log');

try {
    $receiver = new SmsDeliveryReport(); // Create the Receiver object

    $destinationAddress = $receiver->getDesAddress();
    $timeStamp = $receiver->getTimeStamp();
    $requestId = $receiver->getRequestId();
    $deliveryStatus = $receiver->getDeliveryStatus();

    logFile("Sms delivery report received from SDP : ");
    logFile("[ destinationAddress=$destinationAddress, timeStamp=$timeStamp, requestId=$requestId, deliveryStatus=$deliveryStatus ]");

} catch (SmsException $ex) {
    //throws when failed delivery report receiving
    error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
}
?>