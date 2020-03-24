<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<center>
<h1> <font face="Times New Roman" color="black" size="+10"><center>Material For Meeting:</center></font></h1>
<?php
    // get posted variables
    $mysqli = new mysqli('localhost', 'root', '', 'db2project');
    $email = $_POST['email'];
    $password = $_POST['password'];
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

    $numRows2 = 0;
    $getThisMaterialID = "SELECT * FROM assign WHERE meet_id = {$meetingInfoRow['meet_id']}";
    $materialRes = $mysqli->query($getThisMaterialID);
    $materialArr = mysqli_fetch_array($materialRes);
    $numRows=mysqli_num_rows($materialRes); 
    if($numRows > 0){
        $getThisMaterial = "SELECT * FROM material WHERE material_id = {$materialArr['material_id']}";
        $thisMaterialRes = $mysqli->query($getThisMaterial);
        $numRows2=mysqli_num_rows($thisMaterialRes); 
    }

    if($numRows2 > 0){
        echo "Material assigned this meeting:";

        echo "  
            <table>
                <tr>
                    <td>Subject:</td>
                    <td>" . $thisMaterialRes['meet_name'] . "</td>
                </tr>
                <tr>
                    <td>Date:</td>
                    <td>" . $thisMaterialRes['date'] . "</td>
                </tr>
                <tr>
                    <td>Start Time:</td>
                    <td>" . $thisMaterialRes['start_time'] . "</td>
                </tr>
                <tr>
                    <td>End Time:</td>
                    <td>" . $thisMaterialRes['end_time'] . "</td>
                </tr>
                <tr>
                    <td>Group:</td>
                    <td>" . $thisMaterialRes['group_id'] . "</td>
                </tr>
            </table>";

    } else echo "No material asigned to this meeting";
    
    echo "<br>";

    echo "Material Options";
?>
<!-- Return button -->
<form action="AdminViewMeeting.php" method="post"><br>
    <input type="hidden" id="email" name="email" value="<?php echo $email;?>" >
    <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $emailEDIT;?>" >
    <input type="hidden" id="password" name="password" value="<?php echo $password;?>" >
    <input type="hidden" id="user" name="user" value="<?php echo $user;?>" > 
    <input type="submit" class="button" name="returnButton" value="Return"/>
</form>
</center>
</body>
</html>