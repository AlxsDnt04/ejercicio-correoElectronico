<!DOCTYPE HTML>
<html>

<head>
	<title>Enviar un correo electrónico</title>
	<!-- Custom Theme files -->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Custom Theme files -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			font-family: 'Roboto Condensed', Arial, sans-serif;
			background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
			min-height: 100vh;
			margin: 0;
			padding: 0;
		}
		h1 {
			text-align: center;
			margin-top: 40px;
			font-weight: 700;
			color: #333;
			letter-spacing: 2px;
		}
		.contact {
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 80vh;
		}
		.contact-main {
			background: #fff;
			padding: 2.5rem 2rem 1.5rem 2rem;
			border-radius: 18px;
			box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
			width: 100%;
			max-width: 430px;
		}
		.contact-main h3 {
			margin-top: 1.2rem;
			margin-bottom: 0.5rem;
			font-weight: 600;
			color: #4a4a4a;
		}
		.contact-main input[type="email"],
		.contact-main input[type="text"],
		.contact-main textarea {
			width: 100%;
			padding: 0.75rem 1rem;
			margin-bottom: 1rem;
			border: 1px solid #e0e0e0;
			border-radius: 8px;
			background: #f8f9fa;
			font-size: 1rem;
			transition: border-color 0.2s;
		}
		.contact-main input[type="email"]:focus,
		.contact-main input[type="text"]:focus,
		.contact-main textarea:focus {
			border-color: #74ebd5;
			outline: none;
			background: #fff;
		}
		.contact-enviar input[type="submit"] {
			width: 100%;
			padding: 0.75rem;
			background: linear-gradient(90deg, #74ebd5 0%, #ACB6E5 100%);
			border: none;
			border-radius: 8px;
			color: #fff;
			font-size: 1.1rem;
			font-weight: 700;
			letter-spacing: 1px;
			cursor: pointer;
			transition: background 0.2s, box-shadow 0.2s;
			box-shadow: 0 2px 8px rgba(116, 235, 213, 0.15);
		}
		.contact-enviar input[type="submit"]:hover {
			background: linear-gradient(90deg, #ACB6E5 0%, #74ebd5 100%);
			box-shadow: 0 4px 16px rgba(116, 235, 213, 0.25);
		}
		@media (max-width: 600px) {
			.contact-main {
				padding: 1.5rem 0.5rem;
				max-width: 98vw;
			}
		}
	</style>
	<!--Google Fonts-->
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
</head>

<body>
	<!--coact start here-->
	<h1>Formulario de contacto</h1>
	<div class="contact">
		<div class="contact-main">
			<form method="post">
				<h3>Tu correo electrónico</h3>
				<input type="email" placeholder="tu@email.com" class="hola" name="customer_email" required />

				<h3>Tu nombre</h3>
				<input type="text" placeholder="Tu nombre" class="hola" name="customer_name" required />
				<h3>Asunto</h3>
				<input type="text" placeholder="Asunto" class="hola" name="subject" required />
				<h3>Mensaje</h3>
				<textarea name="message" placeholder="Cuerpo del mensaje..." required /></textarea>
				<?php
				if (isset($_POST['send'])) {
					include("sendemail.php"); //Mando a llamar la funcion que se encarga de enviar el correo electronico

					/*Configuracion de variables para enviar el correo*/
					$mail_username = "stalin.carrion@istvidanueva.edu.ec"; //Correo electronico saliente ejemplo: tucorreo@gmail.com
					$mail_userpassword = "Sc1728516657"; //Tu contraseña de gmail
					$mail_addAddress = "info@obedalvarado.pw"; //correo electronico que recibira el mensaje
					$template = "email_template.html"; //Ruta de la plantilla HTML para enviar nuestro mensaje

					/*Inicio captura de datos enviados por $_POST para enviar el correo */
					$mail_setFromEmail = $_POST['customer_email'];
					$mail_setFromName = $_POST['customer_name'];
					$txt_message = $_POST['message'];
					$mail_subject = $_POST['subject'];

					sendemail($mail_username, $mail_userpassword, $mail_setFromEmail, $mail_setFromName, $mail_addAddress, $txt_message, $mail_subject, $template); //Enviar el mensaje
				}
				?>
		</div>
		<div class="enviar">
			<div class="contact-check">

			</div>
			<div class="contact-enviar">
				<input type="submit" value="Enviar mensaje" name="send">
			</div>
			<div class="clear"> </div>
			</form>
		</div>
	</div>
</body>

</html>