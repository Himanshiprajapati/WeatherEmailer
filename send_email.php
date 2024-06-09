
<?php
include('smtp/PHPMailerAutoload.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['location']) && !empty($_POST['email'])) {
    $location = htmlspecialchars($_POST['location']);
    $recipientEmail = htmlspecialchars($_POST['email']);
    $apiKey = '19c8b6f3367943f2a9b161352242404';
    $apiUrl = "http://api.weatherapi.com/v1/current.json?key=$apiKey&q=$location&aqi=no";
    $response = file_get_contents($apiUrl);
    $weatherData = json_decode($response, true);

    if ($weatherData && isset($weatherData['current'])) {
        $summary = generateEmailContent($weatherData);
        sendEmail($summary, $recipientEmail);
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
        echo '<div class="container" role="alert">
                  A simple success alert—check it out!
              </div>';
    } else {
        echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
    }
    
    
    
    
}
?>
