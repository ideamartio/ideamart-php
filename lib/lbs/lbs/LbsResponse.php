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

class LbsResponse{
    var $statusCode;
    var $timeStamp;
    var $statusDetail;
    var $subscriberState;
    var $horizontalAccuracy;
    var $freshness;
    var $longitude;
    var $latitude;
    var $messageId;
    var $version;

    public function __construct($jsonString){
        $responseArray = json_decode($jsonString,true);
        $this->statusCode = $responseArray['statusCode'];
        $this->timeStamp = $responseArray['timeStamp'];
        $this->statusDetail = $responseArray['statusDetail'];
        $this->subscriberState = $responseArray['subscriberState'];
        $this->horizontalAccuracy = $responseArray['horizontalAccuracy'];
        $this->freshness = $responseArray['freshness'];
        $this->longitude = $responseArray['longitude'];
        $this->latitude = $responseArray['latitude'];
        $this->messageId =$responseArray['messageId'];
        $this->version =$responseArray['version'];
    }

    public function setFreshness($freshness){
        $this->freshness = $freshness;
    }

    public function getFreshness(){
        return $this->freshness;
    }

    public function setHorizontalAccuracy($horizontalAccuracy){
        $this->horizontalAccuracy = $horizontalAccuracy;
    }

    public function getHorizontalAccuracy(){
        return $this->horizontalAccuracy;
    }

    public function setLatitude($latitude){
        $this->latitude = $latitude;
    }

    public function getLatitude(){
        return $this->latitude;
    }

    public function setLongitude($longitude){
        $this->longitude = $longitude;
    }

    public function getLongitude(){
        return $this->longitude;
    }

    public function setMessageId($messageId){
        $this->messageId = $messageId;
    }

    public function getMessageId(){
        return $this->messageId;
    }

    public function setStatusCode($statusCode){
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(){
        return $this->statusCode;
    }

    public function setStatusDetail($statusDetail){
        $this->statusDetail = $statusDetail;
    }

    public function getStatusDetail(){
        return $this->statusDetail;
    }

    public function setSubscriberState($subscriberState){
        $this->subscriberState = $subscriberState;
    }

    public function getSubscriberState(){
        return $this->subscriberState;
    }

    public function setTimeStamp($timeStamp){
        $this->timeStamp = $timeStamp;
    }

    public function getTimeStamp(){
        return $this->timeStamp;
    }

    public function setVersion($version){
        $this->version = $version;
    }

    public function getVersion(){
        return $this->version;
    }

    public function toJson(){
        $arrayField = array("statusCode" =>$this->statusCode,
            "timeStamp" =>  $this->timeStamp,
            "statusDetail" => $this->statusDetail,
            "subscriberState" =>  $this->subscriberState,
            "horizontalAccuracy" => $this->horizontalAccuracy,
            "freshness" => $this->freshness,
            "longitude" => $this->longitude,
            "latitude" => $this->latitude,
            "messageId" => $this->messageId,
            "version" => $this->version);
        return json_encode($arrayField);
    }

}
