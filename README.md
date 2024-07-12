
# Weather Data Emailer And Messaging Web Application


## Introduction
The Weather Data Emailer is a web application designed to retrieve current weather conditions for a specified location using the Weather.com API, enhance the description using the OpenAI API, and send a detailed, human-readable weather report via email. This document outlines the steps required to set up and run the application on a local environment using XAMPP for PHP execution and SMTP for email functionality.
## Prerequisites 
Before you can run the application, make sure you have the following:

**XAMPP**: Install XAMPP to create a local server environment. Download from here.

**Weather.com API Key**: Sign up at WeatherAPI.com and obtain your API key.

**OpenAI API Key**: Obtain an API key from OpenAI for accessing their language models.

**SMTP Server Details**: If using Gmail, configure your Gmail account to allow access through less secure apps or set up an App Password if 2-factor authentication is enabled.
## Installation

Install my-project with 

**1. XAMPP Setup**
Install XAMPP from the link provided in the prerequisites.
Start the Apache and MySQL modules from the XAMPP control panel.

**2. Application Setup**

Clone/Download the Project

Download the zip file of the project or clone the repository using Git.

Extract or place the project directory in C:\xampp\htdocs.
Configuration

Open the project directory.

Copy the .env.example file to a new file named .env.

Edit the .env file to include your Weather.com and OpenAI API keys.
Configure your SMTP settings in the .env for email functionality.

**3. Dependencies**

Navigate to your project directory in the command prompt or terminal.

Run composer install to install required PHP packages (if the project uses Composer).
    



This project demonstrates how to fetch weather information based on location and send messages via email and WhatsApp using PHP.

## Folder Structure

```
.
├── index.php
├── functions.php
└── api
    └── send_message.php
```

- `index.php`: Contains HTML code and AJAX requests to send location and phone/email to `api/send_message.php`.
- `functions.php`: Includes functions related to fetching weather, formatting messages, and sending messages.
- `api/send_message.php`: Handles the API requests, includes `functions.php`, fetches weather, formats messages, and sends messages.

## How It Works

### Flow Diagram

```
               +-----------+                 +-------------------+
         |           |     HTTP POST    |                   |
         |  index    +---------------->+  send_message.php +-
         |  (HTML)   |  location,      |                   |    
         |           |  contact method |                   |           
         +-----+-----+                 +--------+----------+               
               |                               |                              
               |                               |                              
               |                               |                              
               |                               |                              
               |                               v                              
               |                            include                           
               |                         functions.php                        
               |                               |                              
               |                               v                              
               |                           fetchWeather                        
               |                               |                              
               |                               v                              
               |                        formatWeatherMessage                   
               |                               |                              
               |                               v                              
               |                           sendMessage                         
               |                               |                              
               |                               v                              
            User Input                          (Email/WhatsApp)                      
                                                                |

            

```

### Flow Description

1. **User Interaction**:
   - The user interacts with the `index.php` page, entering a location and selecting a contact method (phone or email) to receive weather updates.
   - The form data is sent via an HTTP POST request to `api/send_message.php`.

2. **API Endpoint Processing**:
   - The `api/send_message.php` script receives the POST request, including the location and contact method data.
   - It includes the `functions.php` file, which contains functions for fetching weather, formatting messages, and sending messages.

3. **Weather Fetching**:
   - The `fetchWeather` function retrieves weather data for the specified location from an external API (not shown in the diagram).
   - The weather data is returned as a JSON object.

4. **Message Formatting**:
   - The `formatWeatherMessage` function formats the weather data into a suitable message format, including temperature, condition, and emojis.

5. **Message Sending**:
   - The `sendMessage` function sends the formatted message to the user's selected contact method (email or WhatsApp).
   - If email, the message is sent using the PHPMailer library.
   - If WhatsApp, the message is sent using a third-party API (not shown in the diagram).

## Dependencies

- This project relies on Composer for managing dependencies.
- The PHPMailer library is used for sending emails. Make sure to install it using Composer before running the project.




## Functionalities 


**Weather Data Retrieval:** 
Fetches temperature, humidity, precipitation, and general conditions from Weather.com.

**Weather Description Enhancement:** 
Utilizes the OpenAI API to generate readable and engaging weather descriptions.

**Email Composition:**
Formats the weather data and description into a professional email with greetings and closing statements.

**Email Sending:** 
Sends the composed email through the configured SMTP server.
## Conclusion
This README provides all necessary steps to set up, run, and modify the Weather Data Emailer web application. This project not only offers practical experience with API integration and email handling in PHP but also serves as a useful application for daily use or educational purposes. Enjoy crafting your personalized weather notifications!





