<?php
// Required if your environment does not handle autoloading
require 'vendor/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'ACa489124ef31c81e6735ee41c9982cab2';
$token = 'f9a1e03f92c955fc2280b2d07c9c0ac7';
$client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
$message = $client->messages->create(
    // the number you'd like to send the message to
    '+91'.$contact,
    // '+917715992305',
    [
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+19713283631',
        // the body of the text message you'd like to send
        'body' => 'Ratnagiri Police : Your OTP for Login is - ' . $otp.'',
    ]
);


