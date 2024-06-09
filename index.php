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
            <button type="button" class="btn btn-primary" id="sendEmailBtn" style="width: 100%; background-color: #4CAF50; color: white;"> SendEmail</button>
        </form>
    </div>
    <div id="whatsappForm" style="display:none;">
        <form action="" method="post" id="whatsappWeatherForm">
            <div class="mb-3">
                <label for="whatsapp" style="font-weight: bold;">Your WhatsApp Number:</label>
                <input type="text" class="form-control" id="whatsapp" name="whatsapp" required>
            </div>
            <button type="button" class="btn btn-primary" id="sendMessageBtn" style="width: 100%; background-color: #4CAF50; color: white;"> SendMessage</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('sendEmailBtn').addEventListener('click', function() {
            sendEmail();
        });

        document.getElementById('sendMessageBtn').addEventListener('click', function() {
            sendMessage();
        });

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
    function sendEmail() {
            var location = document.getElementById('location').value;
            var email = document.getElementById('email').value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                }
            };
            xhr.open('POST', 'send_email.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('location=' + location + '&email=' + email);
        }

        function sendMessage() {
            var location = document.getElementById('location').value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                }
            };
            xhr.open('POST', 'send_message.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('location=' + location);
        }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

    
