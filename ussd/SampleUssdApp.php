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

include_once '../../lib/ussd/MoUssdReceiver.php';
include_once '../../lib/ussd/MtUssdSender.php';
include_once '../log.php';
ini_set('error_log', 'ussd-app-error.log');

$receiver = new MoUssdReceiver(); // Create the Receiver object

$receiverSessionId = $receiver->getSessionId();
session_id($receiverSessionId); //Use received session id to create a unique session
session_start();

$content = $receiver->getMessage(); // get the message content
$address = $receiver->getAddress(); // get the sender's address
$requestId = $receiver->getRequestID(); // get the request ID
$applicationId = $receiver->getApplicationId(); // get application ID
$encoding = $receiver->getEncoding(); // get the encoding value
$version = $receiver->getVersion(); // get the version
$sessionId = $receiver->getSessionId(); // get the session ID;
$ussdOperation = $receiver->getUssdOperation(); // get the ussd operation

logFile("[ content=$content, address=$address, requestId=$requestId, applicationId=$applicationId, encoding=$encoding, version=$version, sessionId=$sessionId, ussdOperation=$ussdOperation ]");

//your logic goes here......
$responseMsg = array(
    "main" => "1.Company
                    2.Products
                    3.Careers
                    000.Exit",
    "company" => "Company Details
                    1.CEO
                    2.Location
                    3.Branches
                    4.Contact
                    999.Back",
    "products" => "Products
                    1.SDP
                    2.Soltura
                    999.Back",
    "careers" => "Careers
                    1.Software Engineer
                    2.Project Manager
                    999.Back",
    "ceo" => "Mr.Dinesh Saparamadu.
                    999.Back",
    "location" => "Nawam mawatha,Colombo, Srilanka.
                    999.Back",
    "branches" => "hSenid mobile
                    999.Back",
    "contact" => "info@hsenid.com
                    999.Back",
    "sdp" => "Career grade service delivery platform
                    999.Back",
    "soltura" => "Service Creation Environment
                    999.Back",
    "software-engineer" => "Java Software Engineer for mobile back end development ( email: careers@hsenidmobile.com )
                    999.Back",
    "project-manager" => "Experienced Project Manager ( email: careers@hsenidmobile.com )
                    999.Back"
);

logFile("Previous Menu is := " . $_SESSION['menu-Opt']); //Get previous menu number
if (($receiver->getUssdOperation()) == "mo-init") { //Send the main menu
    loadUssdSender($sessionId, $responseMsg["main"]);
    if (!(isset($_SESSION['menu-Opt']))) {
        $_SESSION['menu-Opt'] = "main"; //Initialize main menu
    }

}
if (($receiver->getUssdOperation()) == "mo-cont") {
    $menuName = null;

    switch ($_SESSION['menu-Opt']) {
        case "main":
            switch ($receiver->getMessage()) {
                case "1":
                    $menuName = "company";
                    break;
                case "2":
                    $menuName = "products";
                    break;
                case "3":
                    $menuName = "careers";
                    break;
                default:
                    $menuName = "main";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName; //Assign session menu name
            break;
        case "company":
            $_SESSION['menu-Opt'] = "company-hist"; //Set to company menu back
            switch ($receiver->getMessage()) {
                case "1":
                    $menuName = "ceo";
                    break;
                case "2":
                    $menuName = "location";
                    break;
                case "3":
                    $menuName = "branches";
                    break;
                case "4":
                    $menuName = "contact";
                    break;
                case "999":
                    $menuName = "main";
                    $_SESSION['menu-Opt'] = "main";
                    break;
                default:
                    $menuName = "main";
                    break;
            }
            break;
        case "products":
            $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            switch ($receiver->getMessage()) {
                case "1":
                    $menuName = "sdp";
                    break;
                case "2":
                    $menuName = "soltura";
                    break;
                case "999":
                    $menuName = "main";
                    $_SESSION['menu-Opt'] = "main";
                    break;
                default:
                    $menuName = "main";
                    break;
            }
            break;
        case "careers":
            $_SESSION['menu-Opt'] = "careers-hist"; //Set to career menu back
            switch ($receiver->getMessage()) {
                case "1":
                    $menuName = "software-engineer";
                    break;
                case "2":
                    $menuName = "project-manager";
                    break;
                case "999":
                    $menuName = "main";
                    $_SESSION['menu-Opt'] = "main";
                    break;
                default:
                    $menuName = "main";
                    break;
            }
            break;
        case "company-hist" || "products-hist" || "careers-hist":
            switch ($_SESSION['menu-Opt']) { //Execute menu back sessions
                case "company-hist":
                    $menuName = "company";
                    break;
                case "products-hist":
                    $menuName = "products";
                    break;
                case "careers-hist":
                    $menuName = "careers";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName; //Assign previous session menu name
            break;
    }

    if ($receiver->getMessage() == "000") {
        $responseExitMsg = "Exit Program!";
        $response = loadUssdSender($sessionId, $responseExitMsg);
        session_destroy();
    } else {
        logFile("Selected response message := " . $responseMsg[$menuName]);
        $response = loadUssdSender($sessionId, $responseMsg[$menuName]);
    }

}
/*
    Get the session id and Response message as parameter
    Create sender object and send ussd with appropriate parameters
**/

function loadUssdSender($sessionId, $responseMessage)
{
    $password = "password";
    $destinationAddress = "tel:94771122336";
    if ($responseMessage == "000") {
        $ussdOperation = "mt-fin";
    } else {
        $ussdOperation = "mt-cont";
    }
    $chargingAmount = "5";
    $applicationId = "APP_000001";
    $encoding = "440";
    $version = "1.0";

    try {
        // Create the sender object server url

//        $sender = new MtUssdSender("http://localhost:7000/ussd/send/");   // Application ussd-mt sending http url
        $sender = new MtUssdSender("https://localhost:7443/ussd/send/"); // Application ussd-mt sending https url
        $response = $sender->ussd($applicationId, $password, $version, $responseMessage,
            $sessionId, $ussdOperation, $destinationAddress, $encoding, $chargingAmount);
        return $response;
    } catch (UssdException $ex) {
        //throws when failed sending or receiving the ussd
        error_log("USSD ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
        return null;
    }
}

?>