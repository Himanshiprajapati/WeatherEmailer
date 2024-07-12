<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather Data Emailer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #6495ED, #FFFFFF);
            animation: background-animation 30s infinite;
            overflow-x: hidden;
        }

        @keyframes background-animation {
            0% {
                background-position: 0% 0%;
            }
            100% {
                background-position: 0% 100%;
            }
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 20px;
            margin-top: 50px;
            width: 600px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: float-in 1s ease-out;
        }

        @keyframes float-in {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            color: #8fe16b;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        #buttonGroup button {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #4CAF50;
            color: white;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        /* Moving shapes */
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: move-shapes 20s linear infinite;
        }

        @keyframes move-shapes {
            0% {
                transform: translateY(0) translateX(0);
            }
            100% {
                transform: translateY(-2000px) translateX(2000px);
            }
        }

        .shape-1 {
            width: 100px;
            height: 100px;
            top: 100%;
            left: 10%;
            animation-duration: 25s;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            top: 100%;
            left: 30%;
            animation-duration: 20s;
        }

        .shape-3 {
            width: 120px;
            height: 120px;
            top: 100%;
            left: 50%;
            animation-duration: 30s;
        }

        /* Cloud shapes */
        .cloud {
            position: absolute;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
            animation: move-clouds 60s linear infinite;
        }

        @keyframes move-clouds {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100vw);
            }
        }

        .cloud-1 {
            width: 200px;
            height: 80px;
            top: 20%;
            left: 100%;
            animation-duration: 60s;
        }

        .cloud-2 {
            width: 250px;
            height: 100px;
            top: 40%;
            left: 100%;
            animation-duration: 70s;
        }

        .cloud-3 {
            width: 150px;
            height: 60px;
            top: 60%;
            left: 100%;
            animation-duration: 50s;
        }

        /* Wind flows */
        .wind {
            position: absolute;
            width: 2px;
            height: 100px;
            background: linear-gradient(to top, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
            animation: move-wind 10s linear infinite;
        }

        @keyframes move-wind {
            0% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(-100vh);
            }
        }

        .wind-1 {
            left: 20%;
            animation-duration: 10s;
        }

        .wind-2 {
            left: 40%;
            animation-duration: 12s;
        }

        .wind-3 {
            left: 60%;
            animation-duration: 8s;
        }
    </style>
</head>
<body>
<div class="shape shape-1"></div>
<div class="shape shape-2"></div>
<div class="shape shape-3"></div>
<div class="cloud cloud-1"></div>
<div class="cloud cloud-2"></div>
<div class="cloud cloud-3"></div>
<div class="wind wind-1"></div>
<div class="wind wind-2"></div>
<div class="wind wind-3"></div>
<div class="container">
    <h2>Weather Data Emailer</h2>
    <form id="weatherForm">
        <div class="mb-3">
            <label for="location" style="font-weight: bold;">Enter Location:</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div id="buttonGroup">
            <button type="button" class="btn btn-primary" onclick="showEmailForm()" style="width: 100%;">Via Email</button>
            <button type="button" class="btn btn-primary" onclick="showWhatsappForm()" style="width: 100%;">Via WhatsApp</button>
        </div>
    </form>

    <div id="emailForm" style="display:none;">
        <form id="emailWeatherForm">
            <div class="mb-3">
                <label for="email" style="font-weight: bold;">Your Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="button" class="btn btn-primary" id="sendEmailBtn" style="width: 100%;">Send Email</button>
        </form>
        <button type="button" class="btn btn-secondary" onclick="resetForm()" style="width: 100%; margin-top: 15px;">Change Method</button>
    </div>
    <div id="whatsappForm" style="display:none;">
        <form id="whatsappWeatherForm">
            <div class="mb-3">
                <label for="whatsapp" style="font-weight: bold;">Your WhatsApp Number:</label>
                <input type="text" class="form-control" id="whatsapp" name="whatsapp" required>
            </div>
            <button type="button" class="btn btn-primary" id="sendMessageBtn" style="width: 100%;">Send Message</button>
        </form>
        <button type="button" class="btn btn-secondary" onclick="resetForm()" style="width: 100%; margin-top: 15px;">Change Method</button>
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

    function resetForm() {
        document.getElementById('emailForm').style.display = 'none';
        document.getElementById('whatsappForm').style.display = 'none';
        document.getElementById('buttonGroup').style.display = 'block';
        document.getElementById('weatherForm').reset();
    }

    function sendEmail() {
        var location = document.getElementById('location').value;
        var email = document.getElementById('email').value;
        if (!validateEmail(email)) {
            alert('Please enter a valid email address.');
            return;
        }
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);
            }
        };
        xhr.open('POST', 'api/send_message.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('location=' + location + '&email=' + email);
    }

    function sendMessage() {
        var location = document.getElementById('location').value;
        var phone = document.getElementById('whatsapp').value;
        if (!validatePhone(phone)) {
            alert('Please enter a valid WhatsApp number.');
            return;
        }
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);
                console.log(xhr.responseText);
            }
        };
        xhr.open('POST', 'api/send_message.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('location=' + location + '&whatsappNumber=' + phone);
    }

    function validateEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function validatePhone(phone) {
        var re = /^[0-9]{10,15}$/;
        return re.test(phone);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
