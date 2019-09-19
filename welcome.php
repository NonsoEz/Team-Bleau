<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="google-signin-client_id" content="239253036268-k3agtq0cjdc07qoosc0ism55q41kmbkb.apps.googleusercontent.com">

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

    <title>Team Bleau | Dashboard</title>
</head>

<body>
    <nav class="navbar navbar-expand-md">
        <a style="color: white" class="navbar-brand" href="index.html"><img src="images/Image_from_iOS-removebg-preview.png" alt="" title="Team-Bleau logo" width="100px" height="100px"></a>
        <p class="h3 mb-3 font-weight-normal" style="color: white;"> Team-Bleau</p>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
        </div>
    </nav>

    <div class="container">
        <h1 style="color: white; text-align: center">WELCOME,
            <p style="color:black;"><?php 
                $name = $_GET['name'];
                echo $name;
             ?></p>
        </h1>
    </div>
</body>

<html>