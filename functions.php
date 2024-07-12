<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function fetchWeather($location) {
    $location = htmlspecialchars($location);
    $apiKey = '19c8b6f3367943f2a9b161352242404';
    $apiUrl = "http://api.weatherapi.com/v1/current.json?key=$apiKey&q=$location&aqi=no";
    
    $response = file_get_contents($apiUrl);
    $weatherData = json_decode($response, true);
    
    if ($weatherData && isset($weatherData['current'])) {
        $temp = $weatherData['current']['temp_c'];
        $condition = $weatherData['current']['condition']['text'];
        
        return [
            'temperature' => $temp,
            'condition' => $condition
        ];
    } else {
        return [
            'error' => "Error fetching weather data or invalid location provided."
        ];
    }
}

function formatWeatherMessage($temperature, $condition , $location) {
    $emojis = [
        'Sunny' => '☀️', 'Clear' => '🌟', 'Partly cloudy' => '⛅', 'Cloudy' => '☁️', 'Overcast' => '☁️',
        'Mist' => '🌫️', 'Patchy rain possible' => '🌦️', 'Patchy snow possible' => '🌨️', 'Thundery outbreaks possible' => '⛈️',
        'Blizzard' => '🌨️', 'Fog' => '🌫️', 'Light rain' => '🌧️', 'Moderate rain' => '🌧️', 'Heavy rain' => '🌧️',
        'Light snow' => '🌨️', 'Moderate snow' => '🌨️', 'Heavy snow' => '🌨️'
    ];
    
    $emoji = $emojis[$condition] ?? '🌡️';
    
    $whatsappMessage = "*Current weather update:* \n\nLocation: {$location}\n\nTemperature: {$temperature}°C {$emoji}\nCondition: {$condition} {$emoji}\nHave a great day! 🌈";
    $emailMessage = <<<HTML
    <div style="font-family: Arial, sans-serif; background: linear-gradient(to right, #6dd5fa, #2980b9); color: white; padding: 20px; border-radius: 10px;">
        <h2 style="text-align: center; animation: fadeIn 2s;">Current weather update for {$location}</h2>
        <p style="font-size: 16px; animation: fadeIn 2s;">
            <strong>Temperature:</strong> {$temperature}°C {$emoji}
        </p>
        <p style="font-size: 16px; animation: fadeIn 2s;">
            <strong>Condition:</strong> {$condition} {$emoji}
        </p>
        <p style="font-size: 16px; animation: fadeIn 2s; text-align: center;">
            Have a great day! 🌈
        </p>
    </div>
    <style>
        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }
    </style>
HTML;
    
    return [
        'whatsapp' => $whatsappMessage,
        'email' => $emailMessage
    ];
}

function sendMessage($whatsappNumber, $message) {
    $apiUrl = 'http://185.192.96.202/api.php?type=text-message&token=bd593ffd26faacfd9109&instance=UZeJjpRcOXzn&phone=' . $whatsappNumber . '&message=' . urlencode($message);
   // $apiUrl;
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function sendEmail($recipientEmail, $content) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';  // for gmail smtp.gmail.com
        $mail->SMTPAuth = true;
        $mail->Username = 'support@mentorseries.in'; // For Your Gmail address
        $mail->Password = 'Him123@#$'; // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('support@mentorseries.in', 'Weather Report');
        $mail->addAddress($recipientEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Current Weather Update';
        $mail->Body = $content;

        $mail->send();
        return 'Email sent successfully.';
    } catch (Exception $e) {
        return 'Email could not be sent. Error: ' . $mail->ErrorInfo;
    }
}


?> 
