<?php
    require_once("connect.php");
    if(@$_POST['addMedicine'])
    {
        $query = "INSERT INTO calendar (medicine_name, date, medicine_time) VALUES (:name, :date, :time)";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array('name'=>$_POST['medicine'], 'date'=>date('Y/m/d'), 'time'=>$_POST['time']));
    }

    if(@$_POST['addActivity'])
    {
        $query = "INSERT INTO calendar (activity_name, date) VALUES (:name, :date)";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array('name'=>$_POST['activity'], 'date'=>date('Y/m/d')));
    }

    if(@$_POST['remove'])
    {
        $query = "DELETE FROM calendar WHERE calendar_id = :id";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array('id'=>$_POST['remove']));
    }

    /* draws a calendar */
    function draw_calendar($month,$year, $dbh)
    {
        require_once("connect.php");
        /* draw table */
        $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

        /* table headings */
        $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
        $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

        /* days and weeks vars now ... */
        $running_day = date('w',mktime(0,0,0,$month,1,$year));
        $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
        $days_in_this_week = 1;
        $day_counter = 0;

        /* row for week one */
        $calendar.= '<tr class="calendar-row">';

        /* print "blank" days until the first of the current week */
        for($x = 0; $x < $running_day; $x++)
        {
            $calendar .= '<td class="calendar-day-np"> </td>';
            $days_in_this_week++;
        }

        /* keep going with days.... */
        for($list_day = 1; $list_day <= $days_in_month; $list_day++)
        {
            $calendar .= '<td class="calendar-day" id=" ' . $list_day . '">';
            /* add in the day number */
            $calendar .= '<div class="day-number">' . $list_day . '</div>';

            /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
            $query = "SELECT medicine_name FROM calendar WHERE date = :date AND medicine_name != '' ORDER BY medicine_time";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array('date'=> $year . '-' . $month . '-' . $list_day));
            $count = $stmt->rowCount();

            if($count > 0)
            {
                $results = $stmt->fetchAll();
                foreach($results as $result)
                {
                    $response = $result['medicine_name'];
                    $calendar .= str_repeat('<span style="margin-top: 0">' . $response . '</span> <br>', 1);
                }
                $date = $year . '-' . $month . '-' . $list_day;
            }

            $calendar .= '</td>';

            if ($running_day == 6)
            {
                $calendar .= '</tr>';
                if (($day_counter + 1) != $days_in_month) {
                    $calendar .= '<tr class="calendar-row">';
                }

                $running_day = -1;
                $days_in_this_week = 0;
            }

            $days_in_this_week++;
            $running_day++;
            $day_counter++;
        }

        /* finish the rest of the days in the week */
        if($days_in_this_week < 8) {
            for ($x = 1; $x <= (8 - $days_in_this_week); $x++) {
                $calendar .= '<td class="calendar-day-np"> </td>';
            }
        }

        /* final row */
        $calendar.= '</tr>';

        /* end the table */
        $calendar.= '</table>';

        /* all done, return result */
        return array($calendar, @$date);
    }

    $month = date('m', strtotime('0 month'));
    $year = date('Y');
    $monthName = date('F', mktime(0, 0, 0, $month, 10));
    echo '<h2 style="text-align: center">' . $monthName . ' ' . $year . '</h2>';
    $results = draw_calendar($month,$year, $dbh);
    echo $results[0];
?>

<html lang="en" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calendar</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link href="../Css/calendar.css" rel="stylesheet">

        <style>
            #medicine, #activity
            {
                width: 5%;
                float: left;
            }
            .delete
            {
                padding-left: 8px;
                padding-right: 8px;
            }
        </style>
    </head>

    <body>
        <form method="post">
            <table class="table" id="medicine" align="center" style="margin-top: 10px; margin-left: 15px">
                <tr>
                    <th>Medication Name</th>
                    <th>Time Taken</th>
                </tr>
                    <?php
                        $query = "SELECT * FROM calendar WHERE date = :date AND medicine_name != '' ORDER BY medicine_time";
                        $stmt = $dbh->prepare($query);
                        $stmt->execute(array('date'=>$results[1]));
                        $info = $stmt->fetchAll();

                        foreach($info as $result)
                        {
                            $time = new DateTime($result['medicine_time']);
                            echo '<tr>';
                            echo '<td>' . $result['medicine_name'] . '</td>';
                            echo '<td>' . $time->format('h:i a') . '</td>';
                            echo '<td> <button class="delete" type="submit" name="remove" value="'. $result['calendar_id'] .'">-</button></td>';
                            echo '<tr>';
                        }
                    ?>
                <tr>
                    <td><input type="text" name="medicine"></td>
                    <td><input type="time" name="time"></td>
                    <td><input type="submit" name="addMedicine" value="+"></td>
                </tr>
            </table>
        </form>
        <form method="post">
            <table class="table" id="activity" align="center" style="margin-left: 15px">
                <tr>
                    <th>Activity Name</th>
                </tr>
                <?php
                $query = "SELECT * FROM calendar WHERE date = :date AND activity_name != ''";
                $stmt = $dbh->prepare($query);
                $stmt->execute(array('date'=>$results[1]));
                $info = $stmt->fetchAll();

                foreach($info as $result)
                {
                    echo '<tr>';
                    echo '<td>' . $result['activity_name'] . '</td>';
                    echo '<td> <button class="delete" type="submit" name="remove" value="'. $result['calendar_id'] .'">-</button></td>';
                    echo '<tr>';
                }
                ?>
                <tr>
                    <td>
                        <input list="activities" name="activity">

                        <datalist id="activities">
                            <option value="Running">
                            <option value="Swimming">
                            <option value="Hiking">
                            <option value="Jogging">
                            <option value="Biking">
                        </datalist>
                    </td>

                    <td><input type="submit" name="addActivity" value="+"></td>
                </tr>
            </table>
        </form>
    </body>
</html>