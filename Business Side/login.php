<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Login </title>
    <link href="https://assets.onestore.ms/cdnfiles/onestorerolling-1601-22000/shell/v3/scss/shell.min.css"
          rel="stylesheet" type="text/css" media="screen"/>
    <link href="login.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="login.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
    require_once("../Client Side/connect.php");

    if(@$_POST['formSubmit'] == "Submit")
    {
        $errorMessage = "";

        if(empty($_POST['username']))
        {
            $errorMessage = "<li>You forgot to enter your username.</li>";
        }
        if(empty($_POST['password']))
        {
            $errorMessage = "<li>You forgot to enter your last password.</li>";
        }

        $stmt = $dbh->prepare("SELECT * FROM users WHERE username = :username AND password = :password");

        $result = $stmt->execute(
            array(
                'username' =>$_POST['username'],
                'password' =>$_POST['password']
            )
        );
        $userinfo = $stmt->fetch();

        if($userinfo){
            print_r($stmt->errorInfo());
            $_SESSION['user_id'] = $userinfo['id'];

            header("Location: home.php");
        }

        if(!empty($errorMessage))
        {
            echo("<p>There was an error with your form:</p>\n");
            echo("<ul>" . $errorMessage . "</ul>\n");
        }
    }
?>

<h1 style="text-align: center; color: #00b7bb; margin-top: 4%">Login</h1>
<div class="container">

    <div class="card card-container">

        <img id="profile-img" class="profile-img-card" src="profile.png"/>

        <span style="color: orangered"></span>

        <form method = "post" class="form-signin">

            <br>

            <input type="text" class="form-control, inputEmail" name="username" placeholder="Username" required autofocus>

            <input type="password" class="form-control, inputPassword" name="password" placeholder="Password" required>

            <input name="formSubmit" value="Submit" class="btn btn-lg btn-primary btn-block btn-signin" type="submit" >
        </form>
    </div>
</div>


</body>
</html>