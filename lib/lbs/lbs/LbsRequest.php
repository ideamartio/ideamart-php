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
class LbsRequest{
    var $server;
    var $appId;
    var $appPassword;
    var $subscriberId;
    var $serviceType;
    var $responseTime;
    var $freshness;
    var $horizontalAccuracy;

    public function __construct($server){
        $this->server = $server;
    }

    public function getAppId(){
        return $this->appId;
    }

    public function setAppId($appId){
        $this->appId = $appId;
    }

    public function getAppPassword(){
        return $this->appPassword;
    }

    public function setAppPassword($appPassword){
        $this->appPassword= $appPassword;
    }

    public function getSubscriberId(){
        return $this->subscriberId;
    }

    public function setSubscriberId($subscriberId){
        $this->subscriberId=$subscriberId;
    }

    public function setFreshness($freshness)    {
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

    public function setResponseTime($responseTime){
        $this->responseTime = $responseTime;
    }

    public function getResponseTime(){
        return $this->responseTime;
    }

    public function setServer($server){
        $this->server = $server;
    }

    public function getServer(){
        return $this->server;
    }

    public function setServiceType($serviceType){
        $this->serviceType = $serviceType;
    }

    public function getServiceType(){
        return $this->serviceType;
    }

    public function toJson(){
        $arrayField = array("applicationId" =>$this->appId,
            "password" => $this->appPassword,
            "subscriberId" => $this->subscriberId,
            "serviceType" => $this->serviceType,
            "responseTime" => $this->responseTime,
            "freshness" => $this->freshness,
            "horizontalAccuracy" => $this->horizontalAccuracy);
        return json_encode($arrayField);
    }

}
