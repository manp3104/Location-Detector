<?php
	
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {

		if(empty($_POST['contact'])) {
			$error = "Input your contact number.";
			echo $error;
		}
		else if(empty($_POST['password'])) {
			$error = "Input your password.";
			echo $error;
		}
		else {
			$contact = $_POST['contact'];
			$password = $_POST['password'];

			$dbc = mysqli_connect("localhost", "root", "");

			if(!$dbc) {
				die("Server connection failed: ".mysqli_error($dbc));
				exit();
			}

			$dbs = mysqli_select_db($dbc, "Locator");

			if(!$dbs) {
				die("Database connection failed: ".mysqli_error($dbs));
				exit();
			}

			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			$usernaame = test_input($contact);
			$password = test_input($password);
			$password = md5($password.'9876543210');

			$query = "SELECT * FROM SignedUp WHERE contact='$usernaame'";

			$raw_results = mysqli_query($dbc, $query) or trigger_error("Query MySQL Error: ".mysqli_error($raw_results));

			$rows = mysqli_num_rows($raw_results);

			if($rows == 1) {
				$_SESSION["username"] = $username;
				header("location: profile.php");
			}
			else {
				header("Location: index.php?invalid_input=1");
			}
		}
		mysqli_close($dbc);	
	}

?>