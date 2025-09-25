<?php
require '../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    $mail = new PHPMailer(true);

    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host       = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['MAIL_USERNAME'];
        $mail->Password   = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
        $mail->Port       = $_ENV['MAIL_PORT'];

        // Email dari form
        $name    = $_POST['name'];
        $email   = $_POST['email'];
        $message = $_POST['message'];

        // Email pengirim dan penerima
        $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
        $mail->addAddress($_ENV['MAIL_TO']);

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = "Pesan dari $name";
        $mail->Body    = "Nama: $name<br>Email: $email<br>Pesan: <br>$message";

        $mail->send();
        header("Location: ../../index.php?page=contact&status=success");
        exit;
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        header("Location: ../../index.php?page=contact&status=error");
        exit;
    }
}
