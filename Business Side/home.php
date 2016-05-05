<?php
 //Start the session
require_once('startsession.php');

// Insert the page header
$page_title = 'Home page';

if (!isset($_SESSION['user_id'])) {
  echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
  exit();
}

$dbh = new PDO('mysql:host=127.0.0.1;dbname=injection', 'root', 'root');


// Grab the profile data from the database
if (!isset($_GET['user_id'])) {
  $query = "SELECT firstName, lastName FROM users WHERE id = '" . $_SESSION['user_id'] . "'";
}
else {
  $query = "SELECT firstName, lastName FROM users WHERE id = '" . $_GET['user_id'] . "'";
}
$stmt = $dbh->prepare($query);
$stmt->execute();

$count =$stmt->rowCount();
//?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="style.css">
  </head>

  <body>

  <nav>
    <div class="navToggle">
      <div class="icon"></div>
    </div>
    <ul>
      <li><a href="patientList.php">Patient List</a></li>
      <li><a href="noteinput.php">Note Pad</a></li>
      <li><a href="reminderinput.php">Reminder</a></li>
      <li><a href="general.php">General Facts</a></li>
      <li><a href="logout.php">Log Out</a></li>
   </ul>
  </nav>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="index.js"></script>

  <div id="test" style="width: 1000px; height: 100px;margin-left: 13%; margin-top: 10px; ">
    <p style="font-size: 60px; margin-top: 20px">DR.</p>
    <?php
    if ($count == 1) {

      // The user row was found so display the user data
      $row = $stmt->fetch();
      echo '<p style="font-size: 70px; margin-left: 120px; margin-top: -77px;">' . $row['firstName'] .' '. $row['lastName'] . '</p>';
    }
    ?>
  </div>
  <div style="background-color: lightblue; height: 20px; width: 1400px;"></div>
  <div style=" width: 100%; height: 600px;">

    <div style="height: 100%;  width: 350px;">

      <h1 style="text-align: center;">Prediabetes</h1>

      <h2 style="text-decoration: underline; margin-top: 35px; padding-left: 20px;">Medicine:</h2>
        <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 20px"> Acarbose (Precose) </h3>
        <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Metformin (Glucophage)</h3>
        <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Glucomannan</h3>


      <h2 style="text-decoration: underline; margin-top: 50px; padding-left: 20px;">Life Style:</h2>
        <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 20px"> Physical Activity</h3>
        <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Low carbohydrate diet</h3>
        <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Low Fat diet</h3>

      <h2 style="text-decoration: underline; margin-top: 50px; padding-left: 20px;">Other:</h2>
        <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 20px"> Weight Loss (Lower BMI)</h3>
        <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Healthy Diet</h3>

    </div>

    <div style="height: 100%; width: 350px; background-color: black; margin-left: 350px; margin-top: -600px; color: white;">
      <h1 style="text-align: center; padding-left: 20px; ">Gestational</h1>

      <h2 style="text-decoration: underline; margin-top: 35px; padding-left: 20px;">Medicine:</h2>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 20px"> Insulin by injection </h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Insulin lispro by injection (Humalog)</h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Metformin (Glucophage)</h3>


      <h2 style="text-decoration: underline; margin-top: 50px; padding-left: 20px;">Life Style:</h2>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 20px"> Physical exercise </h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Healthy diet</h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Diabetic diet</h3>

      <h2 style="text-decoration: underline; margin-top: 50px; padding-left: 20px;padding-left: 20px;">Other:</h2>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 20px"> Weight Loss (Lower BMI)</h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Smoking cessation</h3>
    </div>

    <div style="height: 100%;  width: 350px; margin-left: 700px; margin-top: -600px; ">
      <h1 style="text-align: center;padding-left: 20px; ">Type 1</h1>

      <h2 style="text-decoration: underline; margin-top: 35px; padding-left: 20px;">Medicine:</h2>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 20px"> Insulin detemir (Levemir)</h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Insulin glulisine (Apidra)</h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Insulin lispro (Humalog)</h3>


      <h2 style="text-decoration: underline; margin-top: 50px; padding-left: 20px;">Life Style:</h2>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 20px"> Physical exercise</h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Diabetic diet</h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Healthy diet</h3>

      <h2 style="text-decoration: underline; margin-top: 50px; padding-left: 20px;">Other:</h2>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 20px"> Carbohydrate counting</h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Nutrition counseling</h3>
    </div>

    <div style=" height: 100%; width: 350px; background-color: black; margin-left: 1050px;margin-top: -600px; color: white; ">
      <h1 style="text-align: center; padding-left: 20px; ">Type 2</h1>

      <h2 style="text-decoration: underline; margin-top: 35px; padding-left: 20px;">Medicine:</h2>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 20px"> Sitagliptin (Januvia)</h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Glimepiride (Amaryl)</h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Acarbose (Precose)</h3>


      <h2 style="text-decoration: underline; margin-top: 50px; padding-left: 20px;">Life Style:</h2>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 20px"> Smoking cessation</h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Dietary fiber</h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Physical exercise</h3>

      <h2 style="text-decoration: underline; margin-top: 50px; padding-left: 20px;">Other:</h2>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 20px"> Nutrition counseling</h3>
      <h3 style="margin-left: 20px; padding-left: 20px; margin-top: 10px"> Injectable suspension </h3>
    </div>


  </div>
  
  </body>
</html>
