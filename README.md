# ideamart-php

## Sample app created with dialog ideamart SMS PHP API's  and Avengers theme

A Sample application built using ideamart SMS PHP API, using the classes here you can recieve messages, send messages to a address, list of addressses or a broadcast message and log using the log class.

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
