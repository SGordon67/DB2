<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1> <font face="Times New Roman" color="black" size="+10"><center>Create a Meeting</center></font></h1>
    <center>
    <?php
        $user = "admin";
        $bool = false;
        $mysqli = new mysqli('localhost', 'root', '', 'db2project');
        $email = $_POST['email'];
        $password = $_POST['password'];
    ?>
    <?php echo "<table><tr>"; ?>
    <form action="" method="post">
        <?php 
        echo "<table><tr><td>Meeting Type:</td><td>"; ?>
        <select id="subject" name="subject">
            <option value="Math">Math</option>
            <option value="English">English</option>
        </select>
        <?php echo "</td></tr><tr><td>Date:</t><td>"; ?>
        <input type="text" id="date" name="date">
        <?php echo "</td></tr><tr><td>Announcement:</td><td>"; ?>
        <input type="text" id="announce" name="announce">
        <?php echo "</td></tr><tr><td>Capacity:</td><td>"; ?>
        <select id="capacity" name="capacity">
            <option value="9">9</option>
            <option value="8">8</option>
            <option value="7">7</option>
            <option value="6">6</option>
            <option value="5">5</option>
        </select>
        <?php echo "</td></tr><tr><td>Time Slot ID:</td><td>"; ?>
        <select id="TSid" name="TSid">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
        </select>
        <?php echo "</td></tr><tr><td>Group:</td><td>"; ?>
        <select id="group" name="group">
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
        </select>
        <?php echo "</td></tr></table>"; ?>
        <br>
        <input type="hidden" name='email' value= <?php echo $email ?> >
        <input type="hidden" name="password" value= <?php echo $password ?> >
        <input type="submit" class="button" name="createMeetingButton" value="Create Meeting"/>
    </form>

    <form action="AdminPage.php" method="post"><br>
        <input type="hidden" name='email' value= <?php echo $email ?> >
        <input type="hidden" name="password" value= <?php echo $password ?> >
        <input type="submit" class="button" name="returnButton" value="Return to Admin Information"/>
    </form>

    <?php echo "<br><br>Time Slot Information:<br></tr></table><br>";
    $getTSinfo = "SELECT * FROM time_slot";
    $result = $mysqli->query($getTSinfo);
    echo "<table><tr><td>";
    $temp = 0;
    while($row = mysqli_fetch_array($result)){ // loop through result
        echo "  <table><tr>
                    <td>ID:</td>
                    <td>" . $row['time_slot_id'] . "</td>
                </tr>
                <tr>
                    <td>Day of the week:</td>
                    <td>" . $row['day_of_the_week'] . "</td>
                </tr>
                <tr>
                    <td>Start Time:</td>
                    <td>" . $row['start_time'] . "</td>
                </tr>
                <tr>
                    <td>End Time:</td>
                    <td>" . $row['end_time'] . "</td>
                </tr></table>";
                $temp+=1;
        if(($temp % 4) == 0){
            echo "</tr><tr>";
        } else echo "</td><td></td><td></td><td></td><td>
                    </td><td></td><td></td><td></td><td>";
        echo "</td><td>";
    }
    echo "</td</tr></table>"; ?>

<?php
    //code for inserting into the meetings table
    if (isset($_POST['createMeetingButton']))
    {
        $subject = $_POST['subject'];
        $date = $_POST['date'];
        $announce = $_POST['announce'];
        $capacity= $_POST['capacity'];
        $TSid= $_POST['TSid'];
        $group = $_POST['group'];

        // validate the given date 
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
            $insertMeeting =    "INSERT INTO `meetings`(`meet_name`, `date`, `time_slot_id`, `capacity`, `announcement`, `group_id`) 
                                VALUES ('$subject','$date','$TSid','$capacity','$announce','$group') ";
            $result2 = $mysqli->query($insertMeeting);
            if($result2){
                echo "Meeting Scheduled";
            } else echo "Error";
        } else {
            echo "invalid date entered";
        }
    }
?>
    </center>
</body>
</html>