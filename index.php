<?php

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
