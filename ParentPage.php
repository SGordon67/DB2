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
    $user = "parent";
    $bool = false;
    $mysqli = new mysqli('localhost', 'root', '', 'db2project');
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // get the target ID entered
    $qGetId = "SELECT id FROM users WHERE email = '$email'";
    $id = $mysqli->query($qGetId);
    $targetID = mysqli_fetch_array($id);

    // get an array of all parent ID's
    $pids = [];
    $qparentIDs = "SELECT parent_id from parents";
    $res = $mysqli->query($qparentIDs);
    while($row = mysqli_fetch_assoc($res)){
        foreach($row as $cname => $cvalue){
            array_push($pids,$cvalue);
        }
    }

    // check if target ID is in array of parent ID's
    if(empty($targetID)){
        echo 'Invalid Parent Email';
    } else{
        if (!in_array($targetID[0], $pids)){
            echo 'Invalid Parent Email';
        }
        else{
            // get all of the information from database starting with data in the users table
            // then accessing parent email using parent id

            // first grab info from user table 
            $bool = true;
            $qGetInfo = "SELECT * FROM users WHERE email = '$email'";
            $result = $mysqli->query($qGetInfo);
            $result2 = $mysqli->query($qGetInfo);

            // get the id's of the children of current parent 
            $sids = [];
            $getSIDs = "SELECT student_id FROM students WHERE parent_id = {$targetID['id']}";
            $sidsRes = $mysqli->query($getSIDs);
            while($sidRow = mysqli_fetch_array($sidsRes)) {
                array_push($sids, $sidRow['student_id']);
            }

            // get the emails that correspond to the student id's
            $sEmails = [];
            $getSEmails = "SELECT email FROM users WHERE id IN 
                            (SELECT student_id AS id FROM students WHERE parent_id = {$targetID['id']})";
            $sEmailRes = $mysqli->query($getSEmails);
            while($SERow = mysqli_fetch_array($sEmailRes)) {
                array_push($sEmails, $SERow['email']);
            }

            $testrow = mysqli_fetch_array($result);
            ?><!-- Displaying the header with the users name -->
            <h1><font face="Times New Roman" color="black" size="+10"><center><?php echo $testrow['name']?>'s Info</center></font></h1>
            <?php
            if($password != $testrow['password']){
                $bool = false;
                echo "Incorrect Password";
            }else{
                $bool = true;
                echo "<table>"; // start a tag in the HTML
                while($row = mysqli_fetch_array($result2)){   //Creates a loop to loop through results
                    // get the grade for the student first
                    echo "  
                    <tr>
                        <td>Name:</td>
                        <td>" . $row['name'] . "</td>
                    </tr>
                    <tr>  
                        <td>Email:</td>
                        <td>" . $row['email'] . "</td>
                        <td>";?>
                        <form action="UserEditEmail.php" method="post">
                                <input type="hidden" name="email" value="<?php echo $email;?>" > 
                                <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $email;?>" >
                                <input type="hidden" name="password" value="<?php echo $password;?>" >
                                <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
                                <input type="submit" class="button" name="returnButton" value="Edit Email"/>
                        </form><?php echo "
                        </td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td>" . $row['phone'] . "</td>
                        <td>";?>
                        <form action="UserEditPhone.php" method="post">
                                <input type="hidden" name="email" value="<?php echo $email;?>" >
                                <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $email;?>" >
                                <input type="hidden" name="password" value="<?php echo $password;?>" >
                                <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
                                <input type="submit" class="button" name="returnButton" value="Edit Phone"/>
                        </form><?php echo "
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>";/* . $row['password'] . */ echo "</td>
                        <td>";?>
                        <form action="UserEditPassword.php" method="post">
                                <input type="hidden" name="email" value="<?php echo $email;?>" >
                                <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $email;?>" >
                                <input type="hidden" name="password" value="<?php echo $password;?>" >
                                <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
                                <input type="submit" class="button" name="returnButton" value="Edit Password"/>
                        </form><?php echo "
                        </td>
                    </tr><tr><td></td><td><br><br>Student Information:</td></tr><tr>";
                    // This section is for each of the children of the parent
                    echo "<table><tr><td>";
                    foreach ($sEmails as &$value) {
                        $qstudInfo = "SELECT * FROM users WHERE email = '$value'";
                        $resQ = $mysqli->query($qstudInfo);
                        echo "<table>";
                        while($resQrow = mysqli_fetch_array($resQ)){ // loop through result
                            $getChildGrade = "SELECT grade FROM students WHERE student_id = {$resQrow['id']}";
                            $gradeResult = $mysqli->query($getChildGrade);
                            $gradeArr = mysqli_fetch_array($gradeResult);

                            echo "
                                <tr>
                                    <td>Name:</td>
                                    <td>" . $resQrow['name'] . "</td>
                                </tr>
                                <tr>
                                    <td>Grade:</td>
                                    <td>" . $gradeArr['grade'] . "</td>
                                </tr>
                                <tr>  
                                    <td>Email:</td>
                                    <td>" . $resQrow['email'] . "</td>
                                    <td>";?>
                                    <form action="UserEditEmail.php" method="post">
                                            <input type="hidden" name="email" value="<?php echo $email;?>" > 
                                            <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $value;?>" >
                                            <input type="hidden" name="password" value="<?php echo $password;?>" >
                                            <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
                                            <input type="submit" class="button" name="returnButton" value="Edit Email"/>
                                    </form><?php echo "
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td>" . $resQrow['phone'] . "</td>
                                    <td>";?>
                                    <form action="UserEditPhone.php" method="post">
                                            <input type="hidden" name='email' value= <?php echo $email ?> >
                                            <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $value;?>" >
                                            <input type="hidden" name="password" value= <?php echo $password ?> >
                                            <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
                                            <input type="submit" class="button" name="returnButton" value="Edit Phone"/>
                                    </form><?php echo "
                                    </td>
                                </tr>
                                <tr>
                                    <td>Password:</td>
                                    <td>"; /*. $resQrow['password'] .*/ echo "</td>
                                    <td>";?>
                                    <form action="UserEditPassword.php" method="post">
                                            <input type="hidden" name='email' value= <?php echo $email ?> >
                                            <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $value;?>" >
                                            <input type="hidden" name="password" value= <?php echo $password ?> >
                                            <input type="hidden" id="user" name="user" value="<?php echo $user;?>" > 
                                            <input type="submit" class="button" name="returnButton" value="Edit Password"/>
                                    </form><?php echo "
                                    </td>
                                </tr>";
                        }
                        // dispaly the buttons for viewing and editing meetings
                        echo " <tr><td><br>Meetings:</td><td>"; ?><br>
                        <form action="JoinLeaveMeeting.php" method="post">
                            <input type="hidden" name="email" value= <?php echo $email ?> >
                            <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $value;?>" > 
                            <input type="hidden" name="password" value= <?php echo $password ?> >
                            <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
                            <input type="submit" class="button" name="meetingButton" value="Join/Leave Meeting"/>
                        </form><?php echo "</td><td>"; ?><br>
                        <form action="UserViewMeetings.php" method="post">
                            <input type="hidden" name='email' value= <?php echo $email ?> >
                            <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $value;?>" > 
                            <input type="hidden" name="password" value= <?php echo $password ?> >
                            <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
                            <input type="submit" class="button" name="meetingButton" value="View Meetings"/>
                        </form><?php echo "</td></tr>
                        <tr>
                            <td></td>
                            <td>";?>
                                <form action="UserStudyMaterials.php" method="post">
                                    <input type="hidden" name='email' value= <?php echo $email ?> >
                                    <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $value;?>" > 
                                    <input type="hidden" name="password" value= <?php echo $password ?> >
                                    <input type="hidden" name='id' value= <?php echo $targetID['id'] ?> >
                                    <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
                                    <input type="submit" class="button" name="meetingButton" value="View Study Materials"/>
                                </form><?php echo "</td></tr>
                            </td>
                        </tr>";
                        echo "</table></td><td></td><td></td><td>
                        </td><td></td><td></td><td></td><td>";
                    }
                }
                echo "</tr></table>";
            }
        }
    }
    $mysqli->close();
?>

<form action="ParentSignIn.php" method="post"><br>
    <input type="submit" class="button" name="returnButton" value="Return"/>
</form>
</center>
</body>
</html>