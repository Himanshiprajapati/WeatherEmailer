<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">


    <title>Weather Data Emailer</title>
</head>
<body>
<div class="container">
    <h2 style="color:#8fe16b; text-align: center;">Weather Data Emailer</h2>
    <form action="" method="post" id="weatherForm">
        <div class="mb-3">
            <label for="location" style="font-weight: bold;">Enter Location:</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div id="buttonGroup">
            <button type="button" class="btn btn-primary" onclick="showEmailForm()" style="width: 100%; background-color: #4CAF50; color: white;">Via Email</button>
            <button type="button" class="btn btn-primary" onclick="showWhatsappForm()" style="width: 100%; background-color: #4CAF50; color: white;">Via WhatsApp</button>
        </div>
    </form>

    <div id="emailForm" style="display:none;">
        <form action="" method="post" id="emailWeatherForm">
            <div class="mb-3">
                <label for="email" style="font-weight: bold;">Your Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary" onclick="generateEmailContent()"style="width: 100%; background-color: #4CAF50; color: white;">Send Email</button>
        </form>
    </div>
    <div id="whatsappForm" style="display:none;">
        <form action="" method="post" id="whatsappWeatherForm">
            <div class="mb-3">
                <label for="whatsapp" style="font-weight: bold;">Your WhatsApp Number:</label>
                <input type="text" class="form-control" id="whatsapp" name="whatsapp" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; background-color: #4CAF50; color: white;">Send Message</button>
        </form>
    </div>
</div>

<script>
    function showEmailForm() {
        document.getElementById('emailForm').style.display = 'block';
        document.getElementById('whatsappForm').style.display = 'none';
        document.getElementById('buttonGroup').style.display = 'none';
    }

    function showWhatsappForm() {
        document.getElementById('whatsappForm').style.display = 'block';
        document.getElementById('emailForm').style.display = 'none';
        document.getElementById('buttonGroup').style.display = 'none';
    }
</script>

    
</body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['location'])) {
    $location = htmlspecialchars($_POST['location']);
    $apiKey = '19c8b6f3367943f2a9b161352242404';
    $apiUrl = "http://api.weatherapi.com/v1/current.json?key=$apiKey&q=$location&aqi=no";
    $response = file_get_contents($apiUrl);
    $weatherData = json_decode($response, true);

    if ($weatherData && isset($weatherData['current'])) {
        $summary = generateEmailContent($weatherData);
        if (!empty($_POST['email'])) {
            $recipientEmail = htmlspecialchars($_POST['email']);
            sendEmail($summary, $recipientEmail);
        } elseif (!empty($_POST['whatsapp'])) {
            $whatsappNumber = htmlspecialchars($_POST['whatsapp']);
            $message = $summary; 
            sendMessage($whatsappNumber, $message);
        }
    } else {
        echo "Error fetching weather data or invalid location provided.";
    }
}



function generateEmailContent($weatherData) {
    $temp = $weatherData['current']['temp_c'];
    $condition = $weatherData['current']['condition']['text'];

    $content = <<<HTML
    <html>
        <body>
            <div style="font-family: Arial, sans-serif; color: #333;">
                <h2 style="color: #0056b3;">Weather Report</h2>
                <p>Hello,</p>
                <p>Here is the current weather for your location:</p>
                <table>
                    <tr>
                        <td style="padding: 8px; color: #555;">Temperature:</td>
                        <td style="padding: 8px;"><strong>{$temp} °C</strong></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; color: #555;">Condition:</td>
                        <td style="padding: 8px;"><strong>{$condition}</strong></td>
                    </tr>
                </table>
                <p>Thank you.</p>
            </div>
        </body>
    </html>
HTML;
    return $content;
}

function sendEmail($content, $recipientEmail) {
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@mentorseries.in';
    $mail->Password = 'Him123@#$';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->isHTML(true);

    $mail->setFrom('support@mentorseries.in', 'Weather Report');
    $mail->addAddress($recipientEmail);
    $mail->Subject = 'Current Weather Update';
    $mail->Body = $content;

    if ($mail->send()) {
        echo '<div class="container">';
        echo '<div class="alert alert-success" role="alert">Email sent successfully — check it out!</div>';
        echo '</div>';
    } else {
        echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
    }
    
    }

    function sendMessage($whatsappNumber, $message) {
        $apiUrl = 'http://185.192.96.202/api.php?type=text-message&token=bd593ffd26faacfd9109&instance=P7qnInKJ0qsj&phone=' . $whatsappNumber . '&message=' . urlencode($message);
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    
    
    $whatsappNumber = "{WhatsApp Number}";
    $message = "Your message here.";
    
    $response = sendMessage($whatsappNumber, $message);
    echo $response;
    ?>