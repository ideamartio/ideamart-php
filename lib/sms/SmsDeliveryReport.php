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

class SmsDeliveryReport{
    private $destinationAddress;    //Define parameters for receive sms data
    private $timeStamp;
    private $requestId;
    private $deliverStatus;

    /*
        decode the json data an get them to an array
        Get data from Json objects
        check the validity of the response
    **/
    public function __construct(){
        $array = json_decode(file_get_contents('php://input'), true);
        $this->destinationAddress = $array['destinationAddress'];
        $this->timeStamp = $array['timeStamp'];
        $this->requestId = $array['requestId'];
        $this->deliverStatus = $array['deliverStatus'];


        if ($this->destinationAddress != null && $this->deliverStatus != null) {
            $deliveryRes = array("statusCode" => "S1000", "statusDetail" => "Success");
            header("Content-type: application/json");
            echo json_encode($deliveryRes);
        } else {
            throw new Exception("Some of the required parameters are not provided");
        }

    }

    /*
         Define getters to return receive data
    **/

    public function getDesAddress(){
        return $this->destinationAddress;
    }

    public function getTimeStamp(){
        return $this->timeStamp;
    }

    public function getRequestId(){
        return $this->destinationAddress;
    }

    public function getDeliveryStatus(){
        return $this->deliverStatus;
    }

}

?>