<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f5f5;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-top: 50px;
            animation: slideIn 1s ease-out;
        }
        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
    <title>Weather Data Emailer</title>
</head>
<body>
<div class="container">
    <h2 style="color: #007bff; text-align: center;">Weather Data Emailer</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="location" style="font-weight: bold;">Enter Location:</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="mb-3">
            <label for="email" style="font-weight: bold;">Your Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%;">Get Weather</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
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
        echo '<div class="alert alert-success" role="alert">Email sent successfully — check it out!</div>';
    } else {
        echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
    }
}
?>
