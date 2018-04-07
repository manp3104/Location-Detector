<?php

	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

	$dbc = mysqli_connect("localhost", "root", "");

	if(!$dbc) {
		die("Server connection failed: " .mysqli_error($dbc));
		exit();
	}

	$dbs = mysqli_select_db($dbc, "Locator");

	if(!$dbs) {
		die("Database connection failed: " .mysqli_error($dbs));
		exit();
	}

	if(isset($_POST['email'])) {
		$email = $_POST['email'];
		$email = filter_var($email);
		if(!$email) {
			echo "Invalid email address.";
		}
	}

	if($_GET["userid"]) {
		$contact = $_GET["userid"];
	}

	$det_qry = "SELECT * FROM SignedUp WHERE contact='$contact'";

	$user_det = mysqli_query($dbc, $det_qry) or trigger_error("Query MySQL Error: " .mysqli_error($dbc));

	$name = $user_det['name'];

	$query = "INSERT INTO contacts (contact, email) VALUES ('$contact', '$email')";

	$result = mysqli_query($dbc, $query) or trigger_error("Query MySQL Error: " .mysqli_error($dbc));

	if($result) {

		require 'PHPMailer_mod/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3  		// Enable verbose debug output

		$mail->isSMTP();	// Not necessary
		// Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';	// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;		// Enable SMTP authentication
		$mail->Username = 'locator@gmail.com';		// SMTP Username
		$mail->Password = '123456789';		// SMTP Password
		$mail->SMTPSecure = 'tls';		// Enable TLS encryption, 'ssl' also accepted
		$mail->Port = 587; 		// 586 is used if some problem occurs; 476 port for ssl.
					// TCP port to connect to
		$mail->setFrom('locator@gmail.com', 'Locator');
		$mail->addAddress($email, 'client'); 	// Add a recipient
		$mail->addAddress($email); 		// Name is optional
		$mail->addReplyTo('locator@gmail.com', 'Locator'); 
		//$mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');
		// $mail->addAttachment('/var/tmp/file.tar.gz');
		// Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');		// Optional name
		$mail->isHTML(true);		// Set email format to HTML

		$mail->Subject = 'Added to emergency contact';

		$mail->Body = '<!DOCTYPE html>
		<html>
		<head>
			<title>Email Confirmation</title>
			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

			<!-- jQuery library -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			  
			<!-- Latest compiled JavaScript -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<style type="text/css">

			</style>
		</head>
		<body>
			<div class="container">
				<div id="main-content">
					<div id="text-block">
						<br><br>
						<p>Hello,</p>
						<br>
						<p>Your emai-id has been added by '.$name.' as one of the emergency contacts where in case of any mishappenings, you will get location information about '.$name.'.</p>
						<br>
						<p>If you do not want this, you can unsubscribe your mail from getting any furthur emails from us.</p>
						<br><br><br>
						<p>Regards</p>
						<p>Team Locator</p>
					</div>
					<footer class="text-center">
						<p>Click here to unsubscribe.</p>
					</footer>
				</div>
			</div>
		</body>
		</html>';

		$mail->AltBody = 'Email Approval Data';

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: '.$mail->ErrorInfo;
		}
		else {
			header('Location: index.php')
		}

	}
	mysqli_close($dbc);

?>