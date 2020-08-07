<?php
require __DIR__ . '/vendor/autoload.php';

if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Drive API PHP Quickstart');
    $client->setScopes(Google_Service_Drive::DRIVE_FILE);
    $client->setAuthConfig(__DIR__ . '/client_secret.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = __DIR__ . '/token_id.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Drive($client);

// ngày hiện tại
$daynow = date('Y-m-d');
$folder_id = '1Tzl_Fvt08Pp09gNPqyxw9x0MWHBD6TT-';

// upload file database lên gg drive
$fileMetadata = new Google_Service_Drive_DriveFile(array('name' => 'wp5-db-' . $daynow . '.sql', 'parents' => array($folder_id)));
$content = file_get_contents(__DIR__ . '/backup/' . $daynow . '/wp5-db-' . $daynow . '.sql');
$file = $service->files->create($fileMetadata, array('data' => $content, 'mimeType' => 'application/zip', 'uploadType' => 'multipart'));
// upload file source code lên gg drive
$fileMetadata = new Google_Service_Drive_DriveFile(array('name' => 'wp5-code-' . $daynow . '.zip', 'parents' => array($folder_id)));
$content = file_get_contents(__DIR__ . '/backup/' . $daynow . '/wp5-code-' . $daynow . '.zip');
$file = $service->files->create($fileMetadata, array('data' => $content, 'mimeType' => 'application/zip', 'uploadType' => 'multipart'));

// kết thúc script
die("Done. \n");