<?php
/**
 * Created by JetBrains PhpStorm.
 * User: oshan
 * Date: 3/14/13
 * Time: 10:40 AM
 * To change this template use File | Settings | File Templates.
 */

include_once '../../../lib/lbs/LbsClient.php';
include_once '../../../lib/lbs/LbsRequest.php';
include_once '../../../lib/lbs/LbsResponse.php';
include_once "../../../lib/lbs/KLogger.php";
include '../conf/lbs-conf.php';

$log = new KLogger ( "lbs_debug.log" , KLogger::DEBUG );

$subscriberId = "tel:".$_POST['msisdn'];
$log->LogDebug("Received msisdn = ".$subscriberId);

$request = new LbsRequest($LBS_QUERY_SERVER_URL);
$request->setAppId($APP_ID);
$request->setAppPassword($PASSWORD);
$request->setSubscriberId($subscriberId);
$request->setServiceType($SERVICE_TYPE);
$request->setFreshness($FRESHNESS);
$request->setHorizontalAccuracy($HORIZONTAL_ACCURACY);
$request->setResponseTime($RESPONSE_TIME);

function getModifiedTimeStamp($timeStamp){
    try {
        $date= new DateTime($timeStamp,new DateTimeZone('Asia/Colombo'));
    } catch (Exception $e) {
        echo $e->getMessage();
        exit(1);
    }
    return $date->format('Y-m-d H:i:s');
}

$lbsClient = new LbsClient();
$lbsResponse = new LbsResponse($lbsClient->getResponse($request));
$lbsResponse->setTimeStamp(getModifiedTimeStamp($lbsResponse->getTimeStamp()));//Changing the timestamp format. Ex: from '2013-03-15T17:25:51+05:30' to '2013-03-15 17:25:51'
$log->LogDebug("Lbs response:".$lbsResponse->toJson());
echo $lbsResponse->toJson();

?>
