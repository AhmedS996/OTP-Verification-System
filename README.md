# OTP Verification System

This is a simple OTP (Without passowrd) verification system built using PHP and MySQL. The system allows users to sign up with their email address and receive an OTP code via email, which they can then use to verify their account.

## Features

- User sign up with email address
- OTP code generation and email sending using PHPMailer library
- OTP verification and account activation
- User login and logout
- Simple dashboard with user information

## Requirements

- PHP 5.6 or higher
- MySQL 5.6 or higher
- PHPMailer library (included in the project)

## Installation

1. Clone the project repository to your local machine:

```
   git clone https://github.com/AhmedS996/OTP-Verification-System.git
```

2. Create a new MySQL database and import the `otp.sql` file from the project's `database` folder.

3. Update the database connection settings in the `Connection.php` file:

   ````php
   $conn = mysqli_connect('localhost', 'root', '', 'otp');
   ```

4. Update the email settings in the `send_otp.php` file:

   ````php
   $mail->Host = 'smtp.gmail.com'; // SMTP server
   $mail->Username = 'your-email@gmail.com'; // SMTP username
   $mail->Password = 'your-email-password'; // SMTP password
   $mail->setFrom('your-email@gmail.com'); // Sender email address
   ```

5. Start a PHP server on your local machine:

   ````
   php -S localhost:8000
   ```

6. Open a web browser and navigate to `http://localhost:8000/` to start using the OTP verification system.

## Usage

1. Sign up with your email address.

2. Check your email inbox for the OTP code.

3. Enter the OTP code on the verification page and click "Verify".

4. If the OTP code is correct, your account will be activated and you will be redirected to the dashboard page.

5. Login to your account using your email address.

6. View your account information on the dashboard page.

## Credits

This OTP verification system was built by AhmedS996 using PHP and MySQL. The PHPMailer library was used for sending OTP codes via email.

## License

This project is licensed under the MIT License. Feel free to use and modify this project for your own purposes.
