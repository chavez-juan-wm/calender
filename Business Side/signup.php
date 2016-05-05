<!DOCTYPE html>
<html lang="en">
<head>
    <title> Sign up </title>

    <link href="signup.css" rel="stylesheet" type="text/css">
    <script src="signup.js"></script>
    <link href="https://assets.onestore.ms/cdnfiles/onestorerolling-1601-22000/shell/v3/scss/shell.min.css"
          rel="stylesheet" type="text/css" media="screen"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=injection', 'root', 'root');

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
if(@$_POST['formSubmit'] == "Submit")
{
    $errorMessage = "";
    if(empty($_POST['firstName']))
    {
        $errorMessage = "<li>You forgot to enter your first name.</li>";
    }
    if(empty($_POST['lastName']))
    {
    $errorMessage = "<li>You forgot to enter your last name.</li>";
    }
    if(empty($_POST['username']))
    {
        $errorMessage = "<li>You forgot to enter your username.</li>";
    }
    if(empty($_POST['email']))
    {
        $errorMessage = "<li>You forgot to enter your email.</li>";
    }
    if(empty($_POST['password']))
    {
        $errorMessage = "<li>You forgot to enter your password.</li>";
    }
    if(empty($_POST['place']))
    {
        $errorMessage = "<li>You forgot to enter your work place.</li>";
    }
    if(empty($_POST['status']))
    {
        $errorMessage = "<li>You forgot to enter your medical status.</li>";
    }



    $stmt = $dbh->prepare("INSERT INTO users (firstName, lastName, username, email, password, place, status ) VALUES (?, ?, ?, ?, ?, ?, ?)");

    $result = $stmt->execute(array($_POST['firstName'], $_POST['lastName'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['place'], $_POST['status']));

    if(!$result){
        print_r($stmt->errorInfo());
    }
    else{
        $msg = 'Thank you for subscribing to Injection.';
        $from = 'admin@injection.com';
        mail($_POST['email'], 'Injection' , $msg, 'From:' . $from);
    }

    if(!empty($errorMessage))
    {
        echo("<p>There was an error with your form:</p>\n");
        echo("<ul>" . $errorMessage . "</ul>\n");
    }

}?>

<h1 style="text-align: center; color: #00b7bb; margin-top: 2%; font-size: 50px;">Sign Up</h1>
<div class="container" >

    <div class="card card-container" style="background-color: black">

        <img id="profile-img" class="profile-img-card" src="profile.png"/>

        <span style="color: orangered"></span>

        <form method = "post" class="form-signin" >

            <br>
            <input type="text" class="form-control, inputEmail" name="firstName" placeholder="First Name" required autofocus style="background-color: lightblue; color: white;">

            <input type="text" class="form-control, inputEmail" name="lastName" placeholder="Last Name" required autofocus style="background-color: lightblue; color: white;">

            <input type="text" class="form-control, inputEmail" name="username" placeholder="Username" required autofocus style="background-color: lightblue; color: white;">

            <input type="email" class="form-control, inputEmail" name="email" placeholder="Email" required autofocus style="background-color: lightblue; color: white;">

            <input type="password" class="form-control, inputPassword" name="password" placeholder="Password" required style="background-color: lightblue; color: white;">

            <input type="text" class="form-control, inputEmail" name="place" placeholder="Where Do You Work?" required autofocus style="background-color: lightblue; color: white;">

            <input type="text" class="form-control, inputEmail" name="status" placeholder="Status" required autofocus style="background-color: lightblue; color: white;">

            <input name="formSubmit" value="Submit" class="btn btn-lg btn-primary btn-block btn-signin" type="submit" onclick="newPage()">
        </form>
    </div>
</div>
</body>
</html>