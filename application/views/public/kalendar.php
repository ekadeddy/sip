<?php
//if (php_sapi_name() != 'cli') {
//    throw new Exception('This application must be run on the command line.');
//}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    
//    $client = new Google_Client();
//$client->setAuthConfig('token.json');
//$client->setAccessType("online");        // offline access
//$client->setIncludeGrantedScopes(true);   // incremental auth
//$client->addScope(Google_Service_Calendar::CALENDAR_READONLY);

 $client_id = '415092827838-9m2n6nanires512uhi6nhocmm9ghs364.apps.googleusercontent.com'; 
 $client_secret = '2pD0xYln5BdWd_84xWevmSLY';
 $redirect_uri = '<YOUR_REDIRECT_URI>';
 
 $client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("https://www.googleapis.com/auth/urlshortener");

//$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
//    $client = new Google_Client();
//    $client->setApplicationName('Google Calendar API PHP Quickstart');
//    $client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
//    $client->setAuthConfig('credentials.json');
//    $client->setAccessType('offline');
//     $a = '{"web":{"client_id":"228351206509-qqdgvpfnm9hgo27q85ovpc6atr0459oi.apps.googleusercontent.com","project_id":"circular-truth-209609","auth_uri":"https://accounts.google.com/o/oauth2/auth","token_uri":"https://www.googleapis.com/oauth2/v3/token","auth_provider_x509_cert_url":"https://www.googleapis.com/oauth2/v1/certs","client_secret":"FC-gv6rqbWM0_BWfauVOcjXS","javascript_origins":["http://sip.pcr.local:8080"]}}' ;
//    // Load previously authorized credentials from a file.
//    $credentialsPath = 'token.json';
//    if (file_exists($credentialsPath)) {
//        //$accessToken = json_decode($a);
//        $json_data = file_get_contents('test.txt');
//        //print($json_data);
//        //$accessToken = json_decode($json_data, true);
//        
//        $string = '{"first_name": "Anup", "last_name": "Shakya"}';
////$accessToken = json_decode($a,true);
//
//// Result: stdClass Object ( [first_name] => Anup: [last_name] => Shakya  )
////print_r($result);
//
//// Prints "Anup"
////print $result->first_name;
//
//// Prints "Shakya"
/////print $result->last_name;
//        $accessToken = json_decode(file_get_contents($credentialsPath), true);
//    } else {
//        // Request authorization from the user.
//        $authUrl = $client->createAuthUrl();
//        printf("Open the following link in your browser:\n%s\n", $authUrl);
//        print 'Enter verification code: ';
//        $authCode = trim(fgets(STDIN));
//
//        // Exchange authorization code for an access token.
//        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
//        
//        // Check to see if there was an error.
//        if (array_key_exists('error', $accessToken)) {
//            throw new Exception(join(', ', $accessToken));
//        }
//
//        // Store the credentials to disk.
//        if (!file_exists(dirname($credentialsPath))) {
//            mkdir(dirname($credentialsPath), 0700, true);
//        }
//        file_put_contents($credentialsPath, json_encode($accessToken));
//        printf("Credentials saved to %s\n", $credentialsPath);
//    }
//    //$accessToken = file_get_contents($credentialsPath);
//    //print_r($accessToken); exit;
//    $client->setAccessToken($accessToken);
//
//    // Refresh the token if it's expired.
//    if ($client->isAccessTokenExpired()) {
//        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
//        file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
//    }
//    return $client;
}


// Get the API client and construct the service object.
///$client = getClient();
$service = new Google_Service_Urlshortener($client);
//$service = new Google_Service_Calendar($client);

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}
// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$optParams = array(
  'maxResults' => 10,
  'orderBy' => 'startTime',
  'singleEvents' => true,
  'timeMin' => date('c'),
);
$results = $service->events->listEvents($calendarId, $optParams);
$events = $results->getItems();

if (empty($events)) {
    print "No upcoming events found.\n";
} else {
    print "Upcoming events:\n";
    foreach ($events as $event) {
        $start = $event->start->dateTime;
        if (empty($start)) {
            $start = $event->start->date;
        }
        printf("%s (%s)\n", $event->getSummary(), $start);
    }
}