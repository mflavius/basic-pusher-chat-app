<?php
/**
 * Created by PhpStorm.
 * User: mckenzie.flavius
 * Date: 28/11/2016
 * Time: 12:00
 */

require('lib/Pusher.php');

// Change the following with your app details:
// Create your own pusher account @ www.pusher.com
$app_id = '158615'; // App ID
$app_key = '66449b40c8c74892bdf0'; // App Key
$app_secret = '07036bc50e720e7dabfd'; // App Secret
$pusher = new Pusher($app_key, $app_secret, $app_id);

// Check the receive message
if(isset($_POST['message']) && !empty($_POST['message'])) {
    $data['message'] = $_POST['message'];

    // Return the received message
    if($pusher->trigger('test_channel', 'my_event', $data)) {
        echo 'success';
    } else {
        echo 'error';
    }
}

