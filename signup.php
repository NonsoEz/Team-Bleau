<?php

include 'conn.php';

if(isset($_POST['signupBtn'])){
	$username = trim($_POST['username']);
	$email = trim($_POST['email']);
	$passwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$passwd1 = trim($_POST['password']);
	$repeatPass = trim($_POST['confirm_password']);

	if ($passwd1 == $repeatPass) {#Checks if password matches with confirm_password

		$sql_query = "SELECT * FROM user WHERE email = '".$email."'";
		$retrieve_user_data = mysqli_query($conn, $sql_query);

		if(mysqli_num_rows($retrieve_user_data) == 0){

			$userRow = mysqli_fetch_array($retrieve_user_data);

			if(!$userRow['email']){
				#insert into the table user
				$sql = "INSERT INTO user (username, email, user_password_hash) VALUES ('".$username."', '".$email."', '".$passwd."')";

				if ($user = mysqli_query($conn, $sql)) {
					
					$sql_query1 = "SELECT * FROM user WHERE email = '".$email."'";
					$user_data = mysqli_query($conn, $sql_query1);

					if(mysqli_num_rows($user_data) > 0){
						$row = mysqli_fetch_array($user_data);
					$user_id = $userRow['id'];	
						#Insert into user_profile table
					$user_profile = "INSERT INTO user_profile (user_id, full_name) VALUES ('".$user_id."', '".$username."')";
					mysqli_query($conn, $user_profile);
					header('Location: welcome.php?name='.$username);
					}
				}
			}else{
				echo "<script>
				alert('Please the email already exist. Change your email to complete your registration');
				window.location.href='index.html';</script>";
			}
		}
	}else {
		echo "<script>
			alert('Password does mot match');
			window.location.href='index.html';</script>";
	}
}
?>