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
class QueryBalanceSender{
    var $server;

    public function __construct($server){
        $this->server = $server; // Assign server url
        $this->logger = new KLogger ( "cass_debug.log" , KLogger::DEBUG );
    }

    /*
        Get parameters form the application
        check one or more addresses
        Send them to queryBalanceMany
    **/

    public function queryBalance($applicationId, $password, $subscriberId, $paymentInstrumentName, $accountId, $currency){
        if (is_array($subscriberId)) {
            return $this->queryBalanceMany($applicationId, $password, $subscriberId, $paymentInstrumentName, $accountId, $currency);
        } else if (is_string($subscriberId) && trim($subscriberId) != "") {
            return $this->queryBalanceMany($applicationId, $password, $subscriberId, $paymentInstrumentName, $accountId, $currency);
        } else {
            throw new Exception("address should a string or a array of strings");
        }
    }

    /*
        Get parameters form the queryBalance
        Assign them to an array according to json format
        encode that array to json format
        Send json to sendRequest
    **/

    private function queryBalanceMany($applicationId, $password, $subscriberId, $paymentInstrumentName, $accountId, $currency){

        $arrayField = array("applicationId" => $applicationId, // set the fields as array with parameter fields
            "password" => $password,
            "subscriberId" => $subscriberId,
            "paymentInstrumentName" => $paymentInstrumentName,
            "accountId" => $accountId,
            "currency" => $currency);

        $jsonObjectFields = json_encode($arrayField); // encode the fields to json
        return $this->sendRequest($jsonObjectFields);
    }

    /*
        Get the json request from queryBalanceMany
        use curl methods to send queryBalance
        Send the response to handleResponse
    **/

    private function sendRequest($jsonObjectFields){ //Use curl commands for send json request
        $this->logger->LogDebug("QueryBalanceSender sendRequest() : Request=".$jsonObjectFields);
        $ch = curl_init($this->server);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonObjectFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch); // Send the json request
        curl_close($ch);

        $this->logger->LogDebug("DirectDebitSender sendRequest() : Response=".$res);
        if ($res == "") { // Check get the response successfully
            throw new CassException
            ("Server URL is invalid", '500');
        } else {
            return $res; //Return Success response
        }
    }
}

class CassException extends Exception{ //Cass Exception Handler

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