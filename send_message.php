<?php
$whatsappNumber = "{WhatsApp Number}"; // Replace with your WhatsApp number

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['location'])) {
    $location = htmlspecialchars($_POST['location']);
    $message = "Your message here.";
    sendMessage($whatsappNumber, $message);
}

function sendMessage($whatsappNumber, $message) {
    $apiUrl = 'http://185.192.96.202/api.php?type=text-message&token=bd593ffd26faacfd9109&instance=P7qnInKJ0qsj&phone=' . $whatsappNumber . '&message=' . urlencode($message);
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;
}


?>
