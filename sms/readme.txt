# AvengersInfinityWar-SMS-PHP
## Sample app created with dialog ideamart SMS PHP API's  and Avengers theme
Find out which Avenger Character are you in Avengers Infinity War , type `mesg` `marvel` `your name` and send to 77177 from your Dialog , Hutch number  for  Airtel numbers type `msg` `marvel` `your name` and send to 77177



# Getting Started
These instructions will get you a copy of the project up and running on your local machine or live server for development and testing purposes.

## Prerequisites
you will need to know the process of creating a connect account , Ideamart account and requesting for a hosting space
Check @shafrazrahim [tutorial](https://youtu.be/4JLFjWp6mEw)

## Installing

you can use git clone method or direct download method to download the code
```sh
	$ git clone https://github.com/djsharox/AvengersInfinityWar-SMS-PHP.git
```
### Send your first SMS

Error log and sms libraries are initiated in the begenning 

```sh
	$serverurl= "https://api.dialog.lk/sms/send";
	$applicationId = "APP_XXXXXX";
	$password= "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
```

- **Server URL** :- Send service supports only POST HTTP requests. An application wishing to initiate an MT (Mobile Terminated – Delivery of messages from an Ideamart application to a mobile subscriber’s handset) SMS message should use this.
- **Application Id** :- The developer will recieve application ID in provisioning
- **Password** :- The developer will recieve password in provisioning

Try catch method is used to capture data , **SMSReceiver** initialize the received message to a **$receiver** 
```sh
	$receiver = new SMSReceiver(file_get_contents('php://input'));
```
Then **$receiver** calls **getMessage()** , **getAddress()** and **getRequested()** to capture data.

```sh
	$content = $receiver->getMessage();
	$address = $receiver->getAddress();
	$requestId = $receiver->getRequestID();
	$applicationId = $receiver->getApplicationId();
```

 **$sender** allocate the broadcasting message to **sendMessage()** 

```sh
	$sender->sendMessage($third.",your hidden marvel character is ".$mycharacter,$address);
```

## Deployment
- Uploading the built Php script to hosting space

Watch Part 3 of the tutorial https://youtu.be/_6NrBCjie6o

- Provisioning (registering) your application, obtaining the app id and the password and checking in limited production

Watch Part 4 of the tutorial https://youtu.be/KhMovZXvNZQ

## License
This project is licensed under the MIT License - see the LICENSE.md file for details


============= Sample SMS Application==================

In this example shows that how to receive sms data from sdp and send a sample message with adding your Logic.

- Import API files from lib/sms( SmsReceiver.php, SmsSender.php) and log.php
- Create Receiver object to receive data that your application was sent and log them.
    $receiver=new SmsReceiver();
- That log data in log.txt file in your project.

- Create a response message with adding a logic (Here used that BMI calculation example)
    - Here take the message content and split the spaces.
    - Get the size of that characters
    - Get wight and height
    - get pow value of height by two and divide weight
    - Check the result and assign Underweight, Normal Weight, Overweight according to the limitations.

- Create Sender object with
:   http://localhost:7000/sms/send

### Note: If application sms-mt sending https url, use the url as below. (apache should have configure for https )
:   https://localhost:7443/sms/send

- Define sender parameters and Send sms. ( Use API documentation for define parameters)

---------Build the Project ----------
- Copy the whole project to apache server
- Give the all grant permissions to the project ( Use chmod -R 777 web-sever-path/htdocs/project-name)
- Start the web server

-------- Test sample application --------

- Start the mChoice simulator.
- Give the sample php file as url
        eg: http://localhost:8080/php/samples/sms/SampleSmsApp.php
- Give a message with weight (Kg) and height (cm)
        eg: 80 160
- Check ' Messages sent to Application ' box for successfully sent the message.
- Check ' Messages sent to Customer ' box for successfully get the response.

-------- Get delivery report with sms sample application ----------

- Create a sample delivery report application.
- Import SmsDeliveryReport.php library file.
- Create a Receive object to get delivery request data.
    $receiver=new SmsDeliveryReport();
- You have to set the deliveryStatus parameter as "1" when you are send a message initially.
    - Select the "delivery report required" in simulator.
    - Give the delivery report sample url to given text box.
    - Send the message.
- Check whether your log.txt file to verify your success.
