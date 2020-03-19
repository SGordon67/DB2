<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1> <font face="Times New Roman" color="black" size="+10"><center>Student Info</center></font></h1>
    <center>
    <?php
        $bool = false;
        $mysqli = new mysqli('localhost', 'root', '', 'db2project');
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // get the target ID entered
        $qGetId = "SELECT id FROM users WHERE email = '$email'";
        $id = $mysqli->query($qGetId);
        $targetID = mysqli_fetch_array($id);

        // get an array of all student ID's
        $sids = [];
        $qstudentIDs = "SELECT student_id from students";
        $res = $mysqli->query($qstudentIDs);
        while($row = mysqli_fetch_assoc($res)){
            foreach($row as $cname => $cvalue){
                array_push($sids,$cvalue);
            }
        }

        // check if target ID is in array of student ID's
        if (!in_array($targetID[0], $sids)){
            $bool = false;
            echo 'Invalid Student Email';
        }
        else{
            $bool = true;
            $qGetInfo = "SELECT * FROM users WHERE email = '$email'";
            $result = $mysqli->query($qGetInfo);
            $result2 = $mysqli->query($qGetInfo);

            $testrow = mysqli_fetch_array($result);
            if($password != $testrow['password']){
                $bool = false;
                echo "Incorrect Password";
            }else{
                $bool = true;
                echo "<table>"; // start a tag in the HTML
                while($row = mysqli_fetch_array($result2)){ // loop through result
                echo "  <tr>
                            <td>ID:</td>
                            <td>" . $row['id'] . "</td>
                        </tr>
                        <tr>  
                            <td>Email:</td>
                            <td>" . $row['email'] . "</td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td>" . $row['password'] . "</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td>" . $row['name'] . "</td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                            <td>" . $row['phone'] . "</td>
                        </tr>";
                }
                echo "</table>"; //Close the table in HTML
            }
        }
        $mysqli->close();
    ?>


<?php if($bool) : ?>

<div>
    <!-- send info to next page -->
    <div style="display:inline-block;">
    <form action="StudentEditEmail.php" method="post"><br>
            <input type="hidden" name="email" value="<?php echo $email;?>" > 
            <input type="hidden" name="password" value="<?php echo $password;?>" >
            <input type="submit" class="button" name="returnButton" value="Edit Email"/>
    </form>

    </div>
    <div style="display:inline-block;">
    <form action="StudentEditPassword.php" method="post"><br>
            <input type="hidden" name='email' value= <?php echo $email ?> >
            <input type="hidden" name="password" value= <?php echo $password ?> > 
            <input type="submit" class="button" name="returnButton" value="Edit Password"/>
    </form>
    </div>
    <div style="display:inline-block;">
    <form action="StudentEditPhone.php" method="post"><br>
            <input type="hidden" name='email' value= <?php echo $email ?> >
            <input type="hidden" name="password" value= <?php echo $password ?> > 
            <input type="submit" class="button" name="returnButton" value="Edit Phone"/>
    </form>
    </div>
</div>

<?php endif; ?>

<form action="StudentSignIn.php" method="post"><br>
    <input type="submit" class="button" name="returnButton" value="Return"/>
</form>
</center>
</body>
</html>