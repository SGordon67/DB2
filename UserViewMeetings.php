<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<center>
<?php
    // get posted variables
    $user = $_POST['user'];
    $mysqli = new mysqli('localhost', 'root', '', 'db2project');
    $email = $_POST['email'];
    $emailEDIT = $_POST['emailEDIT'];
    $password = $_POST['password'];

    // get the id of the user
    $getuserid = "SELECT id, name FROM users WHERE email = '$emailEDIT'";
    $idResult = $mysqli->query($getuserid);
    $idArr = mysqli_fetch_array($idResult);

    // Now we have the information to display the header
?> 
<h1> <font face="Times New Roman" color="black" size="+10"><center><?php echo $idArr['name']."'s Meetings"; ?></center></font></h1>
<?php

    // get the mentee meetings associated with the users id
    $columns = 3;
    $temp = 0;
    echo "<table><tr><td>Meetings you are a mentee in:";
    echo "<table><tr><td><br>";
    $getMenteeMeetings = "SELECT meet_id FROM enroll WHERE mentee_id = {$idArr['id']}";
    $menteeMeetingsResult = $mysqli->query($getMenteeMeetings);
    while($menteeMeetingsArr = mysqli_fetch_array($menteeMeetingsResult)){

        //get the information about the meeting
        $getMeetingInfo = "SELECT * FROM meetings WHERE meet_id = {$menteeMeetingsArr['meet_id']}";
        $result = $mysqli->query($getMeetingInfo);
        while($row = mysqli_fetch_array($result)){
            // get the time information for meeting
            $getMeetingTime = "SELECT start_time, end_time FROM time_slot WHERE time_slot_id = {$row['time_slot_id']}";
            $timeResult = $mysqli->query($getMeetingTime);
            $timeArr = mysqli_fetch_array($timeResult);
            echo "  
                <table>
                <tr>
                    <td>Meeting ID:</td>
                    <td>" . $row['meet_id'] . "</td>
                </tr>
                <tr>
                    <td>Subject:</td>
                    <td>" . $row['meet_name'] . "</td>
                </tr>
                <tr>
                    <td>Date:</td>
                    <td>" . $row['date'] . "</td>
                </tr>
                <tr>
                    <td>Start Time:</td>
                    <td>" . $timeArr['start_time'] . "</td>
                </tr>
                <tr>
                    <td>End Time:</td>
                    <td>" . $timeArr['end_time'] . "</td>
                </tr>
                <tr>
                    <td>Group:</td>
                    <td>" . $row['group_id'] . "</td>
                </tr>
                <tr>
                    <td>"; ?>
                    <form action="" method="post">
                        <input type="hidden" id="email" name="email" value="<?php echo $email;?>" > 
                        <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $emailEDIT;?>" >
                        <input type="hidden" id="password" name="password" value="<?php echo $password;?>" >
                        <input type="hidden" id="user" name="user" value="<?php echo $user;?>" > 
                        <input type="hidden" name='id' value= <?php echo $idArr['id'] ?> >
                        <input type="hidden" name='meet_id' value= <?php echo $row['meet_id'] ?> >
                        <input type="hidden" name='ment' value='Mentee' >
                        <input type="submit" class="button" name="LeaveMeeting" value="Leave"/>
                    </form><?php echo "
                    </td>
                </tr>
                </table>";
                $temp+=1;
                // proper spacing for the table
                if(($temp % $columns) == 0){
                    echo "</tr><tr>";
                } else echo "</td><td></td><td></td><td></td><td>
                    </td><td></td><td></td><td></td><td>";
                echo "</td><td><br>";
        }
    }
    echo "</td</tr></table>"; 

    // Split the sections in two
    echo "</td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td>
    Meeting you are a mentor in:";

    $columns2 = 3;
    $temp2 = 0;
    // right side mentor join 
    echo "<table><tr><td><br>";
    $getMenteeMeetings2 = "SELECT meet_id FROM enroll2 WHERE mentor_id = {$idArr['id']}";
    $mentorMeetingsResult2 = $mysqli->query($getMenteeMeetings2);
    while($mentorMeetingsArr2 = mysqli_fetch_array($mentorMeetingsResult2)){

        //get the information about the meeting
        $getMeetingInfo2 = "SELECT * FROM meetings WHERE meet_id = {$mentorMeetingsArr2['meet_id']}";
        $result2 = $mysqli->query($getMeetingInfo2);
        while($row2 = mysqli_fetch_array($result2)){
            // get the time information for meeting
            $getMeetingTime2 = "SELECT start_time, end_time FROM time_slot WHERE time_slot_id = {$row2['time_slot_id']}";
            $timeResult2 = $mysqli->query($getMeetingTime2);
            $timeArr2 = mysqli_fetch_array($timeResult2);
            echo "  
                <table>
                <tr>
                    <td>Meeting ID:</td>
                    <td>" . $row2['meet_id'] . "</td>
                </tr>
                <tr>
                    <td>Subject:</td>
                    <td>" . $row2['meet_name'] . "</td>
                </tr>
                <tr>
                    <td>Date:</td>
                    <td>" . $row2['date'] . "</td>
                </tr>
                <tr>
                    <td>Start Time:</td>
                    <td>" . $timeArr2['start_time'] . "</td>
                </tr>
                <tr>
                    <td>End Time:</td>
                    <td>" . $timeArr2['end_time'] . "</td>
                </tr>
                <tr>
                    <td>Group:</td>
                    <td>" . $row2['group_id'] . "</td>
                </tr>
                <tr>
                    <td>"; ?>
                    <form action="" method="post">
                        <input type="hidden" id="email" name="email" value="<?php echo $email;?>" > 
                        <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $emailEDIT;?>" >
                        <input type="hidden" id="password" name="password" value="<?php echo $password;?>" >
                        <input type="hidden" id="user" name="user" value="<?php echo $user;?>" > 
                        <input type="hidden" name='id' value= <?php echo $idArr['id'] ?> >
                        <input type="hidden" name='meet_id' value= <?php echo $row2['meet_id'] ?> >
                        <input type="hidden" name='ment' value='Mentor' >
                        <input type="submit" class="button" name="LeaveMeeting" value="Leave"/>
                    </form><?php echo "
                    </td>
                    <td>"; ?>
                    <form action="MeetingInfo.php" method="post">
                        <input type="hidden" id="email" name="email" value="<?php echo $email;?>" > 
                        <input type="hidden" id="password" name="password" value="<?php echo $password;?>" >
                        <input type="hidden" id="user" name="user" value="<?php echo $user;?>" > 
                        <input type="hidden" name='meet_id' value= <?php echo $row2['meet_id'] ?> >
                        <input type="submit" class="button" name="LeaveMeeting" value="Info"/>
                    </form><?php echo "
                    </td>
                </tr>
                </table>";
                $temp2+=1;
                // proper spacing for the table
                if(($temp2 % $columns2) == 0){
                    echo "</tr><tr>";
                } else echo "</td><td></td><td></td><td></td><td>
                    </td><td></td><td></td><td></td><td>";
                echo "</td><td><br>";
        }
    }


    echo "</td</tr></table>";
    echo "</td></tr></table>";


// code for leaving a meeting
if (isset($_POST['LeaveMeeting']))
{
    $email = $_POST['email'];
    $emailEDIT = $_POST['emailEDIT'];
    $password = $_POST['password'];
    $user = $_POST['user'];
    $id = $_POST['id'];
    $meet_id = $_POST['meet_id'];
    $ment = $_POST['ment'];

    // if youre trying to leave a mentee meeting
    if($ment == "Mentee"){
        // if the user is not a mentee, no need to continue
        $isMentee = "SELECT * FROM enroll WHERE mentee_id = $id";
        $isMenteeRes = $mysqli->query($isMentee);
        $noRows = mysqli_num_rows($isMenteeRes);
        if($noRows == 0){
            echo "You are not a mentee for any meeting";
        }
        else{
            // If they are not a mentee of the desired meeting, stop
            $isInMeeting = "SELECT * FROM enroll WHERE mentee_id = $id AND meet_id = $meet_id";
            $isInMeetingRes = $mysqli->query($isInMeeting);
            $noRows2 = mysqli_num_rows($isInMeetingRes);
            if($noRows2 == 0){
                echo "You are not a mentee for this meeting";
            }
            else{
                $removeFromMeeting = "DELETE FROM enroll WHERE mentee_id = $id AND meet_id = $meet_id";
                $removeResult = $mysqli->query($removeFromMeeting);
                if(mysqli_affected_rows($mysqli) == 1){
                    echo "Successfully removed";
                }
                // if the user is not a mentee for any otherr meeting, remove them from mentee table
                $isMentee2 = "SELECT * FROM enroll WHERE mentee_id = $id";
                $isMenteeRes2 = $mysqli->query($isMentee2);
                $noRows3 = mysqli_num_rows($isMenteeRes2);
                if($noRows3 == 0){
                    $removeMentee = "DELETE FROM `mentees` WHERE mentee_id = $id";
                    $RemoveMenteeRes = $mysqli->query($removeMentee);
                }
            }
        }
    } else {
        // if youre trying to leave a mentor meeting
        // if the user is not a mentor, no need to continue
        $ismentor = "SELECT * FROM enroll2 WHERE mentor_id = $id";
        $ismentorRes = $mysqli->query($ismentor);
        if($ismentorRes){
            $noRows = mysqli_num_rows($ismentorRes);
            if($noRows == 0){
                echo "You are not a mentor for any meeting";
            }
            else{
                // If they are not a mentor of the desired meeting, stop
                $isInMeeting = "SELECT * FROM enroll2 WHERE mentor_id = $id AND meet_id = $meet_id";
                $isInMeetingRes = $mysqli->query($isInMeeting);
                $noRows2 = mysqli_num_rows($isInMeetingRes);
                if($noRows2 == 0){
                    echo "You are not a mentor for this meeting";
                }
                else{
                    $removeFromMeeting = "DELETE FROM enroll2 WHERE mentor_id = $id AND meet_id = $meet_id";
                    $removeResult = $mysqli->query($removeFromMeeting);
                    if(mysqli_affected_rows($mysqli) == 1){
                        echo "Successfully removed";
                    }
                    // if the user is not a mentor for any otherr meeting, remove them from mentor table
                    $ismentor2 = "SELECT * FROM enroll2 WHERE mentor_id = $id";
                    $ismentorRes2 = $mysqli->query($ismentor2);
                    $noRows3 = mysqli_num_rows($ismentorRes2);
                    if($noRows3 == 0){
                        $removementor = "DELETE FROM `mentors` WHERE mentor_id = $id";
                        $RemovementorRes = $mysqli->query($removementor);
                    }
                }
            }
        }
    }
}
?>
<!-- Return button -->
<?php if($user == "student") : ?>
    <form action="StudentPage.php" method="post"><br>
    <?php elseif($user == "parent") : ?>
    <form action="ParentPage.php" method="post"><br>
    <?php else : ?>
    <form action="AdminPage.php" method="post"><br>
    <?php endif; ?>
        <input type="hidden" id="email" name="email" value="<?php echo $email;?>" >
        <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $emailEDIT;?>" >
        <input type="hidden" id="password" name="password" value="<?php echo $password;?>" >
        <input type="hidden" id="user" name="user" value="<?php echo $user;?>" > 
        <input type="submit" class="button" name="returnButton" value="Return"/>
    </form>
</center>
</body>
</html>