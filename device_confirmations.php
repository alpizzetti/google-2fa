 <?php
	include('config.php');

	if (empty($_SESSION['uid'])) {
		header("Location: index.php");
	}

	include('class/userClass.php');
	$userClass = new userClass();
	$userDetails = $userClass->userDetails($_SESSION['uid']);
	$secret = $userDetails->google_auth_code;
	$email = $userDetails->email;
	require_once 'googleLib/GoogleAuthenticator.php';
	$ga = new GoogleAuthenticator();
	$qrCodeUrl = $ga->getQRCodeGoogleUrl($email, $secret, 'Nome do APP');
	?>

 <!DOCTYPE html>
 <html>

 <head>
 	<title>Sistema de Login com 2FA / Google</title>
 	<link rel="stylesheet" type="text/css" href="style.css" charset="utf-8" />
 </head>

 <body>
 	<div id="container">
 		<h1>Sistema de Login com 2FA / Google</h1>
 		<div id='device'>

 			<p>Insira o código de verificação gerado no aplicativo Google Authenticator do seu telefone.</p>
 			<div id="img">
 				<img src='<?php echo $qrCodeUrl; ?>' />
 			</div>

 			<form method="post" action="home.php">
 				<label>Insira o código do Google Authenticator</label>
 				<input type="text" name="code" />
 				<input type="submit" class="button" />
 			</form>
 		</div>
 		<div style="text-align:center">
 			<h3>Baixe o Google Authenticator para o seu telefone</h3>
 			<a href="https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8" target="_blank"><img class='app' src="images/iphone.png" /></a>
 			<a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank"><img class="app" src="images/android.png" /></a>
 		</div>
 	</div>
 </body>

 </html>