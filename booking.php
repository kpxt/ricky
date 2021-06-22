<?php
    $to = 'kaliesha.pickering@gmail.com';
    $name = $_POST["name"];
    $email= $_POST["email"];
    $phone= $_POST["phone"];
    $text= $_POST["message"];
    $age= $_POST["age"];
    $licence= $_POST["licence"];
    $car= $_POST["car"];
    $pickup= $_POST["pickup"];
    $pickupdate= $_POST["pickupdate"];
    $dropoff= $_POST["dropoff"];
    $dropoffdate= $_POST["dropoffdate"];


    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: " . $email . "\r\n"; // Sender's E-mail
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $message ='<table style="width:100%">
        <tr>
            <td>'.$name.'</td>
        </tr>
        <tr><td>Email: '.$email.'</td></tr>
        <tr><td>phone: '.$phone.'</td></tr>
        <tr><td>Age: '.$age.'</td></tr>
        <tr><td>Drivers Licence: '.$licence.'</td></tr>
        <tr><td>Vehicle Requested: '.$car.'</td></tr>
        <tr><td>Pick-up Details: '.$pickup.'</td></tr>
        <tr><td>Pick-up Date: '.$pickupdate.'</td></tr>
        <tr><td>Drop-off Details: '.$dropoff.'</td></tr>
        <tr><td>Drop-off Date: '.$dropoffdate.'</td></tr>
       
        
    </table>';

    if (@mail($to, $email, $message, $headers))
    {
        echo 'The message has been sent.';
    }else{
        echo 'failed';
    }

?>