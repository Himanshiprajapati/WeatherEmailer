
# PHP Weather Messaging Project

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


