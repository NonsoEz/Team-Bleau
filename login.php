<?php
include 'conn.php';
if(isset($_POST['loginBtn'])){

	#Retrieves user inputs from the form
	$email = $_POST['loginemail'];
	$password = $_POST['loginpassword'];

	$sql = "SELECT * FROM user WHERE email = '".$email."'";

	$retrieve_user_data = mysqli_query($conn, $sql);

		if(mysqli_num_rows($retrieve_user_data) > 0){

			while($userRow = mysqli_fetch_array($retrieve_user_data)){

				

					$retrieved_user_email = $userRow['email']; //get the email of the user
					if(password_verify($password, $userRow['user_password_hash']) AND $email === $retrieved_user_email) 
					{
				    	header('Location: welcome.php?name='.$userRow['username']);
					}else{
						echo "<script>
							alert('Wrong Password');
							window.location.href='index.html';</script>";	
					}
				}
			}else{
				echo "<script>
						alert('Your account does not exist with us, Please Sign up.');
					window.location.href='index.html';</script>";
			}
}
?>