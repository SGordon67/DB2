<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<center>
<h1> <font face="Times New Roman" color="black" size="+10"><center>Meeting Information:</center></font></h1>
<?php
    // get posted variables
    $mysqli = new mysqli('localhost', 'root', '', 'DB2');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = $_POST['user'];
    $meet_id = $_POST['meet_id'];

    // get the meeting information
    $getMeetingInfo = "SELECT * FROM meetings WHERE meet_id = '$meet_id'";
    $meetingInfoRes = $mysqli->query($getMeetingInfo);
    $meetingInfoRow = mysqli_fetch_array($meetingInfoRes);

    // get the end/start time for the meeting
    $getMeetingTime = "SELECT * FROM time_slot WHERE time_slot_id = {$meetingInfoRow['time_slot_id']}";
    $meetingTimeRes = $mysqli->query($getMeetingTime);
    $meetingTimeRow = mysqli_fetch_array($meetingTimeRes);

    // display the general meeting information
    echo "  
        <table>
            <tr>
                <td>Subject:</td>
                <td>" . $meetingInfoRow['meet_name'] . "</td>
            </tr>
            <tr>
                <td>Date:</td>
                <td>" . $meetingInfoRow['date'] . "</td>
            </tr>
            <tr>
                <td>Start Time:</td>
                <td>" . $meetingTimeRow['start_time'] . "</td>
            </tr>
            <tr>
                <td>End Time:</td>
                <td>" . $meetingTimeRow['end_time'] . "</td>
            </tr>
            <tr>
                <td>Group:</td>
                <td>" . $meetingInfoRow['group_id'] . "</td>
            </tr>
        </table>";
    
    // Get the mentee student ID's involved in the meeting
    $GetStudentIDs = "SELECT * FROM enroll WHERE meet_id = '$meet_id'";
    $studentIDsRes = $mysqli->query($GetStudentIDs);
    echo "<table><tr><td>";
    echo "<table><tr><td>Mentees in the meeting:</td></tr><tr><td>";

    while($studentIDsRow = mysqli_fetch_array($studentIDsRes)){
        $getStudentInfo = "SELECT * FROM users WHERE id = {$studentIDsRow['mentee_id']}";
        $studentInfoRes = $mysqli->query($getStudentInfo);
        $studentInfoArr = mysqli_fetch_array($studentInfoRes);
        // display the student information
        echo "
            <table><tr><td>
                <tr>
                    <td>Name:</td>
                    <td>
                        " . $studentInfoArr['name'] . "
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        " . $studentInfoArr['email'] . "
                    </td>
                </tr>
            </td></tr></table>";
    }
    echo "</td></tr></table>";

    // separate the mentee and mentor sides of the table
    echo "</td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td>";
    
    // Get the mentee student ID's involved in the meeting
    $GetStudentIDs2 = "SELECT * FROM enroll2 WHERE meet_id = '$meet_id'";
    $studentIDsRes2 = $mysqli->query($GetStudentIDs2);
    echo "<table><tr><td>Mentors in the meeting:</td></tr><tr><td>";
    //$studentIDsRow = mysqli_fetch_array($studentIDsRes);
    while($studentIDsRow2 = mysqli_fetch_array($studentIDsRes2)){
        $getStudentInfo2 = "SELECT * FROM users WHERE id = {$studentIDsRow2['mentor_id']}";
        $studentInfoRes2 = $mysqli->query($getStudentInfo2);
        $studentInfoArr2 = mysqli_fetch_array($studentInfoRes2);
        // display the student information
        echo "
            <table><tr><td>
                <tr>
                    <td>Name:</td>
                    <td>
                        " . $studentInfoArr2['name'] . "
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        " . $studentInfoArr2['email'] . "
                    </td>
                </tr>
            </td></tr></table>";
    }
    echo "</td></tr></table>";
    echo "</td></tr></table>";
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