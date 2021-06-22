<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.0 403 Forbidden', true, 403);
    die('Forbidden');
}
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

require './config.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {

    $inputs = $_POST;

    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = MAIL_HOST;                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = MAIL_USER;                     // SMTP username
    $mail->Password   = MAIL_PASS;                               // SMTP password
    $mail->SMTPSecure = MAIL_SECURE;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = MAIL_PORT;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($inputs['email'], $inputs['name']);
    $mail->addAddress('kaliesha.pickering@gmail.com', 'Quantum Luxury');     // Add a recipient
    $mail->addReplyTo('info@carrental.com', 'Car Rental');

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Booking Inquiry Form';

    $message = '<html><body>';
    $message .= '<table rules="all" border="1" style="border-color: #e5e5e5;" cellpadding="10">';
    $message .= "<tr style='background: #eeeeee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
    $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
    $message .= "<tr><td><strong>Phone Number:</strong> </td><td>" . strip_tags($_POST['phone']) . "</td></tr>";
    $message .= "<tr><td><strong>Car Type:</strong> </td><td>" . strip_tags($_POST['car-type']) . "</td></tr>";
    $message .= "<tr><td><strong>Pickup:</strong> </td><td>" . strip_tags($_POST['pickup']) . "</td></tr>";
    $message .= "<tr><td><strong>Pickup Date:</strong> </td><td>" . strip_tags($_POST['pickup-date']) . "</td></tr>";
    $message .= "<tr><td><strong>Drop Off:</strong> </td><td>" . strip_tags($_POST['drop-off']) . "</td></tr>";
    $message .= "<tr><td><strong>Drop Off Date:</strong> </td><td>" . strip_tags($_POST['drop-date']) . "</td></tr>";
    $message .= "<tr><td><strong>Age:</strong> </td><td>" . strip_tags($_POST['age']) . "</td></tr>";
    $message .= "<tr><td><strong>Drivers Licence:</strong> </td><td>" . htmlentities($_POST['licence']) . "</td></tr>";
    $message .= "<tr><td><strong>Notes:</strong> </td><td>" . htmlentities($_POST['note']) . "</td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";


    $mail->Body    = $message;

    $mail->send();
    echo 'Message has been sent.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
