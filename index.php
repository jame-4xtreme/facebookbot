<?php

$access_token = 'EAADj4kk3X5ABAAl9rLrX7lBO0fjBfLrOIOqhFwHcYzAfbZBvWw40l6ja88PHpPhZAcrs6rZC2RusZBDL8CCVWlZCW0xloIiy4xBuZBpZBgtkKZBI7d3bCClgZC5Vp18qsxEJywK8gPN9klMuV0eh152GlzuNmf50b8AAC8M18yQtw1xVxBZC2CJ2klQNDykARnMxWZCN6czU98YdQZDZD';

/* validate verify token needed for setting up web hook */ 
echo 'Facebook bot 0910 ****************************************************************************';


/* validate verify token needed for setting up web hook */ 

if (isset($_GET['hub_verify_token'])) { 
    if ($_GET['hub_verify_token'] === $access_token) {
        echo $_GET['hub_challenge'];
        return;
    } else {
        echo 'Invalid Verify Token';
        return;
    }
}


/* Debug data */
$file = fopen("logs.txt","w"); 
fwrite($file, file_get_contents('php://input')); 
fclose($file); 


/* receive and send messages */
$input = json_decode(file_get_contents('php://input'), true);
if (isset($input['entry'][0]['messaging'][0]['sender']['id'])) {

    $sender = $input['entry'][0]['messaging'][0]['sender']['id']; //sender facebook id
    $message = $input['entry'][0]['messaging'][0]['message']['text']; //text that user sent

    $url = 'https://graph.facebook.com/v12.0/me/messages?access_token='. $access_token;

    /*initialize curl*/
    $ch = curl_init($url);

    /*prepare response*/
    $jsonData = '{
    "recipient":{
        "id":"' . $sender . '"
        },
        "message":{
            "text": "OK"
        }
    }';

    /* curl setting to send a json post data */
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    if (!empty($message)) {
        $result = curl_exec($ch); // user will get the message
    }
}

