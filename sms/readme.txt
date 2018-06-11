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