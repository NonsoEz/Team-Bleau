<?php

include('db_connect.php');

session_start();

$signup_error='';
if (isset($_POST['signupBtn'])) {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if (empty($password) || ($password != $confirm_password)) {
        $signup_error = 'please make sure your passwords match';
    }else{
        $password_hash = md5($password);

    
        $user_check = "SELECT * from users where email = '$email' and `password` = '$password_hash'";
        $result = mysqli_query($conn, $user_check);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if ($user['email'] === $email) {
                $signup_error = "email already exists";
            }
        }else{
            $query = "INSERT into users (`username`, `email`, `password`) VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                header('location: login.php');
            }
        
        }
    }
    $_SESSION['username'] = $username;
}

$login_error = '';
if (isset($_POST['loginBtn'])) {
    
    $email = $_POST['loginemail'];
    $password = $_POST['loginpassword'];
    $password = md5($password);

    $user_check = "SELECT * from users where email = '$email' and `password` = '$password'";
    $result = mysqli_query($conn, $user_check);
    $rows = mysqli_num_rows($result);
    if ($rows ==1) {
        $_SESSION['email'] = $email;
        header('location: index.php');
    }else{
		$login_error = "Invalid email or password";
    
	}
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">

    <!--stylesheets-->
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!--adding tab icon image-->
    <link rel="icon" type="image/png" href="images/Image_from_iOS-removebg-preview.png">
    <!-- Animation-->
    <link rel="stylesheet" type="text/css" href="css/animate.css">

    <title>Team Bleau | Log In</title>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-md">
        <a style="color: white" class="navbar-brand" href="index.html"><img
                src="images/Image_from_iOS-removebg-preview.png" alt="" title="Team-Bleau logo" width="100px"
                height="100px"></a>
        <p class="h3 mb-3 font-weight-normal" style="color: white;"> Team-Bleau</p>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
        </div>
    </nav>

    <!--Login-->
    <div class="animated flipInX">
        <div id="logreg-forms">
            <form class="form-signin" method="post" action="forms.php">
                <h1 class="h3 mb-3 font-weight-normal" style="text-align: center; color: white;"> Sign in</h1>

                    <p class="error_message"><?php echo "$login_error" ?></p> <!-- put this back inside the p tag -->
            <!--  -->

                <!--<div class="social-login">
                    <button id="my-signin2" class="btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign in with Google+</span> </button>
                </div>
                <p class="form-p" style="text-align:center"> OR </p>-->
                <div class="input-group">
                    <input type="email" id="inputEmail" name="loginemail" class="form-control"
                        placeholder="Email address" required="" autofocus="">
                </div>
                <br>
                <div class="input-group">
                    <input type="password" id="inputPassword" name="loginpassword" class="form-control"
                        placeholder="password" required="">
                </div>
                <br>
                <div class="input-group">
                    <input class="btn btn-md btn-rounded btn-block form-control submit" type="submit" name="loginBtn"
                        value="Sign In"><i class="fas fa-sign-in-alt"></i>
                </div>

                <a href="#" id="forgot_pswd">Forgot password?</a>
                <hr>
                <!-- Don't have an account! -->
                <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i>
                    Sign up New Account</button>
            </form>

            <!--Reset Password-->
            <form action="#" class="form-reset">
                <input type="email" id="resetEmail" class="form-control" placeholder="Email address" required=""
                    autofocus="">
                <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
                <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
            </form>

            <!--Signup-->

            <form action="forms.php" method="post" class="form-signup">
                <!-- <div class="social-login">
                    <button id="my-signin2" class="btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i></span>
                        <div style="height:50px;width:240px;" class="abcRioButton abcRioButtonBlue"><div class="abcRioButtonContentWrapper"><div class="abcRioButtonIcon" style="padding:15px"><div style="width:18px;height:18px;" class="abcRioButtonSvgImageWithFallback abcRioButtonIconImage abcRioButtonIconImage18"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 48 48" class="abcRioButtonSvg"><g><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path><path fill="none" d="M0 0h48v48H0z"></path></g></svg></div></div><span style="font-size:16px;line-height:48px;" class="abcRioButtonContents"><span id="not_signed_intfnv8cnnmk2">Sign in with Google</span><span id="connectedtfnv8cnnmk2" style="display:none">Signed in with Google</span></span></div></div>
                    </button>
                </div>
                <div class="social-login">
                    <button id="my-signin2" class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign up with Google+</span> </button>
                </div>
                <p class="form-p" style="text-align:center">OR</p>-->
                <p class="error_message"><?php echo "$signup_error" ?></p>

                <input type="text" id="user-name" class="form-control" name="username" placeholder="Full name"
                    required="" autofocus=""><br>
                <input type="email" id="user-email" class="form-control" name="email" placeholder="Email address"
                    required autofocus=""><br>
                <input type="password" id="user-pass" class="form-control" name="password" placeholder="Password"
                    required autofocus=""><br>
                <input type="password" id="user-repeatpass" name="confirm_password" class="form-control"
                    placeholder="Confirm Password" required autofocus=""><br>
                <div class="input-group">
                    <input class="btn btn-md btn-block submit" type="submit" name="signupBtn" value="Sign Up"><i
                        class="fas fa-user-plus"></i>
                </div>
                <a href="#" id="cancel_signup"><i class="fa fa-angle-left"></i>Back</a>
            </form>
            <br>
        </div>
    </div>

    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
    <script src="js/script.js"></script>
</body>

</html>