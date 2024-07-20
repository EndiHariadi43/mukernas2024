<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Mail {
    public static function sendVerificationEmail($toEmail, $token) {
        $mail = new PHPMailer(true);
        
        try {
            //Server seting
            $mail->isSMTP();
            $mail->Host       = 'smtp.hostinger.com'; // host SMTP Anda
            $mail->SMTPAuth   = true;
            $mail->Username   = 'support@fk-pkpps.ponpes.id'; // email SMTP Anda
            $mail->Password   = 'Adisap35@'; // assword SMTP Anda
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 465;
            $mail->setFrom('no-reply@fk-pkpps.ponpes.id', 'FK-PKPPS');
            $mail->addAddress($toEmail);
            $mail->isHTML(true);
            $mail->Subject = 'Verifikasi Akun Anda';
            $mail->Body    = 'Klik <a href="https://rakernas.org/verify.php?token=' . $token . '">di sini</a> untuk memverifikasi akun Anda.';
            
            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log('Mail error: ' . $mail->ErrorInfo);
            return false;
        }
    }
}
?>
