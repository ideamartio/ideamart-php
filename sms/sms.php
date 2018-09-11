<?php

/*
PHP Quickstart guide - Ideamart Developer Bundle
*/

/*** specify your error log ****/
ini_set('error_log', 'sms-app-error.log');

/*** specify your sms libraries here ****/
include_once '../lib/sms/SmsReceiver.php';
include_once '../lib/sms/SmsSender.php';

/*** specify your current timezone here ****/
date_default_timezone_set("Asia/Colombo");

/*** To be filled ****/
$serverurl= "https://api.dialog.lk/sms/send";

//application id which you will receive in provisioning
$applicationId = "APP_xxxxxx";

//application password which you will receive in provisioning
$password= "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

try{
	/*************************************************************/
  //creating a receiver and intializing it with your incoming data
	$receiver = new SMSReceiver(file_get_contents('php://input'));
  //Get the message to the app
	$content =$receiver->getMessage();
  //Filter the unkonwn characters in the MO message
	$content=preg_replace('/\s{2,}/',' ', $content);
  //Get the phone number from which the message was sent
	$address = $receiver->getAddress();
	$requestId = $receiver->getRequestID();
  //Get the applicationId
	$applicationId = $receiver->getApplicationId();
	/*************************************************************/

	$sender = new SMSSender($serverurl, $applicationId, $password);

	list($key, $second) = explode(" ",$content);

	 // if ($second=="go") {
		  if ($second=="go") {

		//Send a Broadcasting Message to all the subscribed users

	    $boradmsg = substr($content,7);
	    error_log("Broadcast Message ".$content);
		  // $response=$sender->broadcastMessage("test");
      $sender->sendMessage("This is a broadcast message to all the subscribers of the application".$second,$address);

	   }else{

		//Replying to an individual Message

	    error_log("Message received ".$content);
	    $sender->sendMessage("This message is sent to one user ".$second,$address);

             }

//Exeptions can be handled here
	}catch(SMSServiceException $e){

	     	error_log("Passed Exception ".$e);


	}

?>
