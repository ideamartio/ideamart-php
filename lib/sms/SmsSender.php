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

class SmsSender{
    var $server;

    public function __construct($server){
        $this->server = $server; // Assign server url
    }

    /*
        Get parameters form the application
        check one or more addresses
        Send them to smsMany
    **/

    public function sms($message, $addresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header){
        if (is_array($addresses)) {
            return $this->smsMany($message, $addresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header);
        } else if (is_string($addresses) && trim($addresses) != "") {
            return $this->smsMany($message, array($addresses), $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header);
        } else {
            throw new Exception("address should a string or a array of strings");
        }
    }

    /*
        Get parameters form the sms
        Assign them to an array according to json format
        encode that array to json format
        Send json to sendRequest
    **/

    private function smsMany($message, $addresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header){

        $arrayField = array("applicationId" => $applicationId,
            "password" => $password,
            "message" => $message,
            "deliveryStatusRequest" => $deliveryStatusRequest,
            "destinationAddresses" => $addresses,
            "sourceAddress" => $sourceAddress,
            "chargingAmount" => $charging_amount,
            "encoding" => $encoding,
            "version" => $version,
            "binaryHeader" => $binary_header);

        $jsonObjectFields = json_encode($arrayField);
        return $this->sendRequest($jsonObjectFields);
    }

    /*
        Get the json request from smsMany
        use curl methods to send sms
        Send the response to handleResponse
    **/

    private function sendRequest($jsonObjectFields){
        $ch = curl_init($this->server);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonObjectFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        return $this->handleResponse($res);
    }

    /*
        Get the response from sendRequest
        check response is empty
        return response
    **/

    private function handleResponse($resp){
        if ($resp == "") {
            throw new SmsException
            ("Server URL is invalid", '500');
        } else {
            echo $resp;
        }
    }

}

class SmsException extends Exception{ // Sms Exception Handler

    var $code;
    var $response;
    var $statusMessage;

    public function __construct($message, $code, $response = null){
        parent::__construct($message);
        $this->statusMessage = $message;
        $this->code = $code;
        $this->response = $response;
    }

    public function getStatusCode(){
        return $this->code;
    }

    public function getStatusMessage(){
        return $this->statusMessage;
    }

    public function getRawResponse(){
        return $this->response;
    }

}

?>
