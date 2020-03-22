<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1> <font face="Times New Roman" color="black" size="+10"><center>Admin Info</center></font></h1>
    <center>
    <?php
        $user = "admin";
        $mysqli = new mysqli('localhost', 'root', '', 'db2project');
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // get the target ID entered
        $qGetId = "SELECT id FROM users WHERE email = '$email'";
        $id = $mysqli->query($qGetId);
        $targetID = mysqli_fetch_array($id);

        // get an array of all admin ID's
        $aIDs = [];
        $qadminIDs = "SELECT admin_id from admins";
        $res = $mysqli->query($qadminIDs);
        while($row = mysqli_fetch_assoc($res)){
            foreach($row as $cname => $cvalue){
                array_push($aIDs,$cvalue);
            }
        }

        // check if target ID is in array of admin ID's
        if(empty($targetID)){
            echo 'Invalid Admin Email';
        } else{
            if (!in_array($targetID[0], $aIDs)){
                echo 'Invalid Admin Email';
            }
            else{
                // get the information based on the email given
                $qGetInfo = "SELECT * FROM users WHERE email = '$email'";
                $result = $mysqli->query($qGetInfo);
                $testrow = mysqli_fetch_array($result);

                if($password != $testrow['password']){
                    echo "Incorrect Password";
                }else{
                    $result2 = $mysqli->query($qGetInfo); // need second instance of variable to work with
                    echo "<table>"; // table for showing the admin information
                    while($row = mysqli_fetch_array($result2)){ // loop through result
                    echo "  <tr>
                                <td>ID:</td>
                                <td>" . $row['id'] . "</td>
                            </tr>
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
                                        <input type="submit" class="button" name="editEmail" value="Edit Email"/>
                                </form><?php echo "
                                </td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td>" . $row['password'] . "</td>
                                <td>";?>
                                <form action="UserEditPassword.php" method="post">
                                        <input type="hidden" name='email' value= <?php echo $email ?> >
                                        <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $email;?>" >
                                        <input type="hidden" name="password" value= <?php echo $password ?> >
                                        <input type="hidden" id="user" name="user" value="<?php echo $user;?>" > 
                                        <input type="submit" class="button" name="editPassword" value="Edit Password"/>
                                </form><?php echo "
                                </td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td>" . $row['phone'] . "</td>
                                <td>";?>
                                <form action="UserEditPhone.php" method="post">
                                        <input type="hidden" name='email' value= <?php echo $email ?> >
                                        <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $email;?>" >
                                        <input type="hidden" name="password" value= <?php echo $password ?> >
                                        <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
                                        <input type="submit" class="button" name="editPhone" value="Edit Phone"/>
                                </form><?php echo "
                                </td>
                            </tr>";
                    }
                    // dispaly the buttons for viewing and editing eetings
                    echo " <tr><td><br>Meetings:</td><td>"; ?><br>
                    <form action="ViewvMeeting.php" method="post">
                        <input type="hidden" name="email" value= <?php echo $email ?> >
                        <input type="hidden" name="password" value= <?php echo $password ?> >
                        <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
                        <input type="submit" class="button" name="meetingButton" value="View Meetings"/>
                    </form><?php echo "</td><td>"; ?><br>
                    <form action="AdminCreateMeeting.php" method="post">
                        <input type="hidden" name='email' value= <?php echo $email ?> >
                        <input type="hidden" name="password" value= <?php echo $password ?> >
                        <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
                        <input type="submit" class="button" name="meetingButton" value="Create Meeting"/>
                    </form><?php
                    echo "</td></tr></table>";
                }
            }
        }
        $mysqli->close();
    ?>
<form action="AdminSignIn.php" method="post"><br>
    <input type="submit" class="button" name="returnButton" value="Return"/>
</form>
</center>
</body>
</html>