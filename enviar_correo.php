<?php
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Validar reCAPTCHA
$recaptchaSecret = '6LfVgWQrAAAAALE9DZ6ECWg0eBnwrHLNhW_b_5_3'; // Reemplaza por tu clave secreta de reCAPTCHA
$recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
$recaptcha = file_get_contents(
    "https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse"
);
$recaptcha = json_decode($recaptcha);

if (!$recaptcha->success) {
    header('Location: index.html?msg=Captcha%20inv%C3%A1lido&ok=0');
    exit;
}

// Validar datos
$nombre = trim($_POST['nombre'] ?? '');
$email = trim($_POST['email'] ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

if (!$nombre || !$email || !$mensaje || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.html?msg=Datos%20inv%C3%A1lidos&ok=0');
    exit;
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tu_correo@gmail.com';
    $mail->Password   = 'tu_contraseña_o_app_password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('tu_correo@gmail.com', 'Formulario Web');
    $mail->addAddress('destinatario@ejemplo.com', 'Destinatario');
    $mail->Subject = 'Nuevo mensaje de ' . $nombre;
    $mail->Body    = "Nombre: $nombre\nCorreo: $email\nMensaje:\n$mensaje";

    // Adjuntar archivo si existe
    if (!empty($_FILES['adjunto']['tmp_name'])) {
        $mail->addAttachment($_FILES['adjunto']['tmp_name'], $_FILES['adjunto']['name']);
    }

    $mail->send();
    header('Location: index.html?msg=Correo%20enviado%20correctamente&ok=1');
    exit;
} catch (Exception $e) {
    header('Location: index.html?msg=Error%20al%20enviar%20el%20correo&ok=0');
    exit;
}