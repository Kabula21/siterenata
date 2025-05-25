<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$site_name = 'Empathy HTML5 Template';
$sender_domain = 'server@your-domain.com';
$to = 'kabulahomestudio@gmail.com';

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$subject = trim($_POST['subject']);
$message = trim($_POST['message']);

$error = false;
if ($name === "") { $error = true; }
if ($email === "") { $error = true; }
if ($subject === "") { $error = true; }
if ($message === "") { $error = true; }

if (isset($_POST['url']) && $_POST['url'] == '') {
    if ($error == false) {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'seu-email@gmail.com'; // Seu e-mail do Gmail
            $mail->Password = 'sua-senha-do-gmail'; // Sua senha de app
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Sender and recipient
            $mail->setFrom('seu-email@gmail.com', $site_name);
            $mail->addAddress($to);

            // Content
            $mail->isHTML(false);
            $mail->Subject = $subject;
            $mail->Body    = "Name: $name \n\nEmail: $email \n\nMessage: $message";

            // Send email
            if ($mail->send()) {
                echo 'success';  // Mensagem de sucesso
            } else {
                echo 'unsuccess';  // Mensagem de falha
            }
        } catch (Exception $e) {
            echo 'error';  // Se ocorrer um erro
        }
    } else {
        echo 'error';  // Se algum campo estiver vazio
    }
} else {
    echo 'success';  // Bot detectado, sucesso sem enviar
}
?>
