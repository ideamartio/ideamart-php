============= Sample LBS Application==================

In this example shows that how to send an lbs request and receive location data from sdp.

- Import API files from lib/lbs(LbsClient.php, LbsRequest.php, LbsResponse.php, KLogger.php)

- Create LbsRequest object by providing the SDP lbs listener URL.
  ex: $request = new LbsRequest("http://127.0.0.1:7000/lbs/locate");
### Note: if you use https url, use the url as given below. (apache should have configure for https )
    https://127.0.0.1:7443/lbs/locate

- Use LbsRequest object's setter methods to add the other required parameters.
  ex: $request->setAppId($APP_ID);

  Required parameters and their setter methods are as bellow.
    Application ID      : $request->setAppId($APP_ID);
    Application password: $request->setAppPassword($PASSWORD);
    Subscriber Id       : $request->setSubscriberId($subscriberId);
    Service type        : $request->setServiceType($SERVICE_TYPE);
    Freshness           : $request->setFreshness($FRESHNESS);
    Horizontal accuracy : $request->setHorizontalAccuracy($HORIZONTAL_ACCURACY);
    Response time       : $request->setResponseTime($RESPONSE_TIME);

-Create a LbsClient object to send the LbsRequest and get a response from the SDP.
    ex: $lbsClient = new LbsClient();

-To send the request and get the response use the LbsClient object's getResponse method.
    ex: $lbsResponseString = $lbsClient->getResponse($request)

-To make the lbs response more manageable create a LbsResponse object with the lbsReponseString you received from lbsClient's getReponse method.
    ex: $lbsResponse = new LbsResponse($lbsResponseString);

-Use response object's getter methods to get locations and other response parameters.
    ex: $lbsResponse->getLongitude() to get the Longitude.

    Getter methods lbsResponse object are as follows.
    Time stamp          : $lbsResponse->getTimeStamp()
    Status details      : $lbsResponse->getStatusDetail();
    Subscriber state    : $lbsResponse->getSubscriberState();
    Horizontal accuracy : $lbsResponse->getHorizontalAccuracy();
    Freshness           : $lbsResponse->getFreshness();
    Longitude           : $lbsResponse->getLongitude();
    Latitude            : $lbsResponse->getLatitude();
    Message ID          : $lbsResponse->getMessageId();
    Version             : $lbsResponse->getVersion();

-If want to send the lbs response to web page which uses javascript process the lbs response (as shown in the example), you can send it as json object.
 Use lbsResponse object's toJson() method for that.

    ex: echo $lbsResponse->toJson();


---------Build the Project ----------
- Copy the whole project to apache server
- Give the all grant permissions to the project ( Use chmod -R 777 web-sever-path/htdocs/project-name)
- Start the web server

-------- Test sample application --------

- Start the mChoice simulator.
- Click on the LBS tab.
- Send lbs request to the mChoice simulator.
- Check 'Request receive from Application' box and 'Response sent to Application' box.
- Check response you received (by checking your UI or logs.)
