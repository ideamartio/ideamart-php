==================== USSD Sample Application =========================

In this example shows that how to receive ussd data from sdp and send a sample ussd with simple hSenid mobile details.

- Create a php application.
- Import API files from lib/ussd (MtUssdSender.php, MoUssdReceiver.php) and log.php.

# Received ussd mo data
- Create a receiver object to receive ussd request data.
    $receiver=new MoUssdReceiver();
- Start a new session using received ussd session id
- In this sample write all the receive data to log.txt file.

#Send ussd mt data
- Add the corresponding ussd messages to an array.
- Define newly required parameters ($password, $destinationAddress, $ussdOperation, $chargingAmount ) to send ussd
- Use same received data as other required parameters ($applicationId, $destinationAddresses, $encoding, $version, $sessionId)
- Create new sender object,
    $sender = new MtUssdSender("http://localhost:7000/ussd/send/");

### Note: If application ussd-mt sending https url, use the url as below. (apache should have configure for https )
    $sender = new MtUssdSender("https://localhost:7443/ussd/send/");

- First check the mo-init operation and send the main ussd menu ( 1.Company 2.Products 3.Careers 000.Exit)
- Then change the session as main menu
- Send the first ussd with corresponding parameters.

### Note : After main other all response are mo-cont operations

- According to selected values from simulator, change the menu number and assign corresponding parameter value
- Send the next mt message with corresponding data
- When response ussd with 000, change operation type as mt-fin and send ussd message with 'Exit'
- For go back function ( if response message 999 ), assign new session names according to the menu number
- According to the other responses, change the session value and send the ussd with corresponding parameters


### Note : Use ussd development api document for more details


---------- Build the Project ------------

- Copy the whole project to  web folder in apache server
- Give the all grant permissions to the project ( Use chmod -R 777 web-sever-path/htdocs/project-name)
- Start the web server

---------- Test sample application ---------

- Start the mChoice simulator
- Send first ussd
    - Give the sample project file as url (eg:- http://localhost:8080/php/samples/ussd/SampleUssdApp.php)
    - Give your app ID and password
    - Give a unique Session ID
    - Ussd Operation type should select 'mo-init'
    - Give the Customer Number
    - Send.
- After get the main menu, change only below properties
    - Select 'mo-cont' as operation type
    - Add proper number to service code (1,2,3,999)
    - Send
- Check ' Messages sent to Application ' box for successfully sent the message
- Check ' Messages sent to Customer ' box for successfully get the response

