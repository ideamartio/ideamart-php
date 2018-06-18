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

include_once "KLogger.php";
class LbsClient{
    var $log;

    public function __construct(){
        $this->log = new KLogger ( "lbs_client_debug.log" , KLogger::DEBUG );
    }

    public function getResponse(LbsRequest $request){
        $this->log->LogDebug("Request: ".$request->toJson());
        $ch = curl_init($request->getServer());
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request->toJson());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $this->log->LogDebug("Response:".$response);
        curl_close($ch);
        return $response;
    }
}

?>