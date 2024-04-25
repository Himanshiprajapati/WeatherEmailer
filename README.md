
# Weather Data Emailer Web Application


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
    
## Running the application

**Start XAMPP**

Ensure that the Apache server is running.

Access the Project

Open a web browser and navigate to http://localhost/WeatherEmailer/

Using the Application on the web interface, input the location for which you want the weather data.

Enter the email address where you want to send the email.

Submit the form to see the weather data displayed on the webpage.

Use the "Send Email" button to send the weather report to a specified email address.


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





