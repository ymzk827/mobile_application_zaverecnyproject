<?php
namespace data;

class mailSender{

    //script ktory posela jednoduchu spravu s overovacim kodom na email použivatelia pri prihlasení  

    public function sendMail($to, $username, $regcode){
        $subject = "Register confirmation";
        
        $message = "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        <p>Hello ".$username.",</p>
        <h1>Thank you for registering with us!</h1>
        <h3>To complete your registration, please confirm your email address by entering this code on the confirmation page:</h3>
        <h1>".$regcode."</h1>
        <a href='http://127.0.0.1/edsa-project/confirmation.php'>Confirm here</a>
        </body>
        </html>
        ";
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        $headers .= 'From: <uxoswebapp@mail.com>' . "\r\n";
        $headers .= 'Cc: myboss@example.com' . "\r\n";
        
        mail($to,$subject,$message,$headers);
    }

    //posela konečny mail po overovaní učtu
    public function sendMailConfirmed($to){
        $subject = "Your account sucessfully created";
        
        $message = "
        <html>
        <head>
        </head>
        <body>
        <h1>Thank you for confirmation!</h1>
        <h3>You can freely use our service. Sign up on our login page</h3>
        <a href='http://127.0.0.1/edsa-project/loginpage.php'>Confirm here</a>
        </body>
        </html>
        ";
        
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        $headers .= 'From: <uxoswebapp@mail.com>' . "\r\n";
        
        mail($to,$subject,$message,$headers);
    }
}


?>