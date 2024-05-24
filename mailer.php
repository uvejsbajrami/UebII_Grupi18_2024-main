<?php
// send email
include('error_handler.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $to = "uvejslol0@gmail.com"; //gmaili juaj 
    $from = "uvejslol0@gmail.com"; //gmaili juaj 
    $password = "gtue tmom puwu nybc"; //gjenerimi i App Password qe ta jep mundsin google tek:gmail settings>security>App Password
    $mail = new PHPMailer(true);

    try {
        //konfigurimet e dergimit te emailit ne gmail 
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        
        $mail->setFrom($from, 'Emri Juaj');
        $mail->addAddress($to);

        
        $mail->isHTML(true);
        $mail->Subject = "Mesazh nga $name: $subject";
        $mail->Body = "Emri: $name<br>Email: $email<br>Telefon: $phone<br>Mesazhi:<br>$message";
        $data = "Emri: $name\nEmail: $email\nTelefon: $phone\n\nMesazhi:\n$message -- \n\n";
        $mail->AltBody = "Emri: $name\nEmail: $email\nTelefon: $phone\n\nMesazhi:\n$message";

        $mail->send();
       try {
        $file = fopen('contacts.txt', 'a');
        if (!$file) {
            throw new Exception("Nuk mund të hapet skedari për shkrim.");
        }

        if (fwrite($file, $data) === false) {
            throw new Exception("Shkrimi në skedar dështoi.");
        }

        fclose($file);
        echo "Të dhënat e kontaktit janë ruajtur me sukses.";
    } catch (Exception $e) {
        error_handler($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine(), []);
    }

        echo 'Email-i u dërgua me sukses.';
        header('location: index.php');
    } catch (Exception $e) {
        echo "Email-i nuk u dërgua. Gabimi: {$mail->ErrorInfo}";
    }
}
?>
