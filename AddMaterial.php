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
    $mysqli = new mysqli('localhost', 'root', '', 'DB2');
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
        </table><br>";

    $numRows2 = 0;
    $getThisMaterialID = "SELECT * FROM assign WHERE meet_id = {$meetingInfoRow['meet_id']}";
    $materialRes = $mysqli->query($getThisMaterialID);
    $materialArr = mysqli_fetch_array($materialRes);
    $numRows=mysqli_num_rows($materialRes); 
    if($numRows > 0){
        $getThisMaterial = "SELECT * FROM material WHERE material_id = {$materialArr['material_id']}";
        $thisMaterialRes = $mysqli->query($getThisMaterial);
        $materialArr2 = mysqli_fetch_array($thisMaterialRes);
        $numRows2=mysqli_num_rows($thisMaterialRes); 
    }

    if($numRows2 > 0){
        echo "Material assigned this meeting:";
        echo "<br><br>";
        echo "
            <table>
                <tr>
                    <td>Material Subject:</td>
                    <td>" . $materialArr2['type'] . "</td>
                </tr>
                <tr>
                    <td>Material Title:</td>
                    <td>" . $materialArr2['title'] . "</td>
                </tr>
                <tr>
                    <td>Material URL:</td>
                    <td>" . $materialArr2['url'] . "</td>
                </tr>
                <tr>
                    <td>Material Assigned:</td>
                    <td>" . $materialArr2['assigned_date'] . "</td>
                </tr>
                <tr>
                    <td>Material Notes:</td>
                    <td>" . $materialArr2['notes'] . "</td>
                </tr>
                <tr>
                    <td>Edit:</td>
                    <td>"; ?>
                        <form action="" method="post">
                            <input type="hidden" id="email" name="email" value="<?php echo $email;?>" >
                            <input type="hidden" id="password" name="password" value="<?php echo $password;?>" >
                            <input type="hidden" id="meet_id" name="meet_id" value="<?php echo $meet_id;?>" >
                            <input type="hidden" id="material_id" name="material_id" value="<?php echo $materialArr2['material_id'];?>" >
                            <input type="submit" class="button" name="unassignButton" value="Unassign"/>
                        </form><?php echo "
                    </td>
                </tr>
            </table>";

    } else echo "No material asigned to this meeting";
    
    echo "<br><br>";

    echo "Material Options:";
    echo "<br><br>";
    $getMaterials = "SELECT * FROM material";
    $materialRes2 = $mysqli->query($getMaterials);
    while($materialArr2 = mysqli_fetch_array($materialRes2)){
        echo "
            <table>
                <tr>
                    <td>Material Subject:</td>
                    <td>" . $materialArr2['type'] . "</td>
                </tr>
                <tr>
                    <td>Material Title:</td>
                    <td>" . $materialArr2['title'] . "</td>
                </tr>
                <tr>
                    <td>Material URL:</td>
                    <td>" . $materialArr2['url'] . "</td>
                </tr>
                <tr>
                    <td>Material Assigned:</td>
                    <td>" . $materialArr2['assigned_date'] . "</td>
                </tr>
                <tr>
                    <td>Material Notes:</td>
                    <td>" . $materialArr2['notes'] . "</td>
                </tr>
                <tr>
                    <td>Edit:</td>
                    <td>"; ?>
                        <form action="" method="post">
                            <input type="hidden" id="email" name="email" value="<?php echo $email;?>" >
                            <input type="hidden" id="password" name="password" value="<?php echo $password;?>" >
                            <input type="hidden" id="meet_id" name="meet_id" value="<?php echo $meet_id;?>" >
                            <input type="hidden" id="material_id" name="material_id" value="<?php echo $materialArr2['material_id'];?>" >
                            <input type="submit" class="button" name="assignButton" value="Assign"/>
                        </form><?php echo "
                    </td>
                </tr>
            </table>";

    }

    if (isset($_POST['unassignButton']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $meet_id = $_POST['meet_id'];
        $material_id = $_POST['material_id'];

        $unassign = "DELETE FROM `assign` WHERE meet_id = '$meet_id' AND material_id = '$material_id'";
        $unRes = $mysqli->query($unassign);
        echo "Material has been unassigned to from this meeting";
    }

    if (isset($_POST['assignButton']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $meet_id = $_POST['meet_id'];
        $material_id = $_POST['material_id'];

        // see if there is already a material assigned
        $matAssigned = "SELECT * FROM assign WHERE meet_id = '$meet_id'";
        $assignedRes = $mysqli->query($matAssigned);
        $assignedArr = mysqli_fetch_array($assignedRes);
        $numAssignedRows=mysqli_num_rows($assignedRes); 
        if($numAssignedRows > 0){
            echo "Meeting already has an asssigned material";
        } else{
            //assign the material to the meeting
            $assignMaterial = "INSERT INTO `assign`(`meet_id`, `material_id`) VALUES ('$meet_id','$material_id')";
            $assignRes = $mysqli->query($assignMaterial);

        }
    }

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