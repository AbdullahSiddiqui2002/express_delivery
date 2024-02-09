<?php

require("../include/connection.php");


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendrecoverylink($parcel_id, $sender_name, $sender_email, $tracking_id, $parcel_status){
    
    if($parcel_status == 1){
        $parcel_status_type = "Item Accepted by Courier";
      }
      elseif($parcel_status == 2){
        $parcel_status_type = "Collected";
      }
      elseif($parcel_status == 3){
        $parcel_status_type = "Shipped";
      }
      elseif($parcel_status == 4){
        $parcel_status_type = "Delivered";
      }
      else{
        $parcel_status_type = "Unsuccessful Delivery Attempt";
      }


//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
                         //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'abdullah.siddiqui13122002@gmail.com';                     //SMTP username
    $mail->Password   = 'rkds zinb iyur ktbg';                               //SMTP password
    $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('abdullah.siddiqui13122002@gmail.com', 'Courier Management System');
    $mail->addAddress($sender_email, $sender_name);     //Add a recipient
    include("header.php");
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Courier Confirmation Email';
    $mail->Body    = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Courier Management System - Parcel Update</title>
    </head>
    <body style="font-family: "Arial", sans-serif; background-color: #f4f4f4; padding: 20px;">
    
        <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    
            <div style="background-color: #D54E16; color: #ffffff; text-align: center; padding: 20px;">
                <h2>Courier Management System</h2>
            </div>
    
            <div style="padding: 20px;">
                <h1>Hello '.$sender_name.'</h1>
    
                <p>Your courier status has been updated in our system. Here are the details:</p>

                <h2>Parcel Status: <span>'.$parcel_status_type.'</span></h2>
                <h3>Tracking ID: <span>'.$tracking_id.'</span></h3>
                <span>Donot share this tracking ID with unknown person.

                <br>
                <br>
                Thank you for using our Courier Management System.</span>
    
                <p>Best Regards,<br>
                Courier Management System Team</p>
            </div>
    
            <div style="background-color: #D54E16; color: #ffffff; text-align: center; padding: 10px;">
                &copy; 2024 Courier Management System
            </div>
    
        </div>
    
    </body>
    </html>
    ';

    $mail->send();
    echo '<script>
    $(document).ready(function () {
                    Swal.fire({
                        title: "Check your inbox. Courier Confirmation email sent to you!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = "parcel_list.php?status=All";
                    });
                  });
                  </script>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
session_start();
if(isset($_SESSION['email'])){
    
if($_GET['parcel_id']){

    $parcel_id = $_GET['parcel_id'];
    $sender_name = $_GET['sender_name'];
    $sender_email = $_GET['sender_email'];
    $tracking_id = $_GET['tracking_id'];
    $parcel_status = $_GET['parcel_status'];

    sendrecoverylink($parcel_id, $sender_name, $sender_email, $tracking_id, $parcel_status);
}


    
} else {
    header("location: login.php");
}


?>