<?php
print "Loading variables from 'config.ini' file\n";
$ini_array = parse_ini_file("config.ini");

$clientID = $ini_array['CLIENT_ID'];
$clientSecret = $ini_array['CLIENT_SECRET'];

if ($clientID == '' || $clientSecret == '') {
  exit("CLIENT_ID or CLIENT_SECRET missing\n");
}

echo "Retrieving IAM access token for client ID $clientID".PHP_EOL;

$postData = array(
    'client_id' => $clientID,
    'client_secret' => $clientSecret,
    'audience' => 'https://api.cimpress.io/',
    'grant_type' => 'client_credentials'
);

$ch = curl_init('https://cimpress.auth0.com/oauth/token');
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

// Send the request
$response = curl_exec($ch);

// Check for errors
if($response === FALSE){
    die(curl_error($ch));
}

// Decode the response
$responseData = json_decode($response, TRUE);
$authToken = $responseData['access_token'];

echo  "Token: $authToken\n\n";

$sub = 'adfs|cbaldauf@cimpress.com';
$resourceType = 'merchants';
$resourceIdentifier = 'vistaprint';

echo "Retrieving IAM permissions for $sub on $resourceType $resourceIdentifier".PHP_EOL;

$ch = curl_init('https://api.cimpress.io/auth/iam/v0/user-permissions/'.$sub.'/'.$resourceType.'/'.$resourceIdentifier);
curl_setopt_array($ch, array(
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$authToken,
        'Content-Type: application/json'
    )
));

// Send the request
$response = curl_exec($ch);

// Check for errors
if($response === FALSE){
    die(curl_error($ch));
}

echo "===== RESPONSE =====".PHP_EOL;
print($response);
?>
