============= Sample CASS Application==================

In this example shows that how to send a sample debit request, sample query balance request from UI and get response data.

# Direct-Debit Sample Application

## UI creation
- Create a html page with two text boxes and submit button.
- To handle the styles use boostrap css, custom.css

## Php handler
- Create php file to handle the post request.
- Include cass libraries from lib/cass to php file.
- Get the json data and assign them to parameters.
- Get appropriate data from configuration file and assign them to parameters.
- Create Sender object using,
    $sender = new DirectDebitSender($SEVER_URL_DIRECT_DEBIT_SENDER);
### Note: for http, $SEVER_URL_DIRECT_DEBIT_SENDER = http://127.0.0.1:7000/caas/direct/debit
          for https, $SEVER_URL_DIRECT_DEBIT_SENDER = https://127.0.0.1:7443/caas/direct/debit
- Send the cass request using corresponding parameters.
- Get the json response data and write them to html file using php syntax.

---------- Build the Project ------------
- Copy the whole project to apache server
- Give the all grant permissions to the project ( Use chmod -R 777 web-sever-path/htdocs/project-name)
- Start the web server

---------- Test sample application ---------

- Start the mChoice simulator
- Assign value for 'Balance For Requests' and click 'Set Balance'
- Submit the msisdn and amount from ui.
- Check ' Request receive from Application ' box for successfully sent the message
- Check ' Response sent to Application ' box for successfully change the balance


# Query Balance Sample Application

## UI creation
- Create a html page with one text box and submit button.
- To handle the styles use boostrap css, custom.css

## Php handler
- Create php file to handle the post request.
- Include cass libraries from lib/cass to php file.
- Get the json data and assign them to parameters.
- Get appropriate data from configuration file and assign them to parameters.
- Create Sender object using,
    $sender = new QueryBalanceSender($SEVER_URL_QUERY_BALANCE_SENDER);
### Note: for http, $SEVER_URL_QUERY_BALANCE_SENDER = http://localhost:7000/caas/balance/query
          for https, $SEVER_URL_QUERY_BALANCE_SENDER = https://localhost:7443/caas/balance/query
          (apache should have configure for https )
- Send the query balance request using corresponding parameters.
- Get the json response data and write them to html file using php syntax.

### Note : Build and Test the Query Balance Sample Application is same as in Direct-Debit Sample Application.
