<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home Page</title>
        <link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../Css/style.css">
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    </head>

    <body>
        <nav>
            <div class="navToggle">
                <div class="icon"></div>
            </div>
            <ul>
                <li><a href="calendar.php">Calendar</a></li>
                <li><a href="noteinput.php">Note Pad</a></li>
                <li><a href="reminderinput.php">Reminder</a></li>
                <li><a href="general.php">General Facts</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>

        <script>
            $(".navToggle").click (function(){
                $(this).toggleClass("open");
                $("nav").toggleClass("open");
            });
        </script>

        <div style="width: 90%; float: right; margin-top: 50px;">
            <div style="width: 22.5%; float: left; background-color: red">
                <span style="color: white">Something</span>
            </div>

            <div style="width: 22.5%; float: left; background-color: black">
                <span style="color: white">Something</span>
            </div>

            <div style="width: 22.5%; float: left; background-color: red">
                <span style="color: white">Something</span>
            </div>

            <div style="width: 22.5%; float: left; background-color: black">
                <span style="color: white">Something</span>
            </div>
        </div>
    </body>
</html>