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
    <form action="" method="post">
    </form>
    <?php
        if (isset($_POST['signUpButton']))
        {
            $mysqli = new mysqli('localhost', 'root', '', 'db2project'); //The Blank string is the password
            $email = $_POST['email'];
            $password = $_POST['password'];

            // get the target ID entered
            $qGetId = "SELECT id FROM users WHERE email = '$email'";
            $id = $mysqli->query($qGetId);
            $targetID = mysqli_fetch_array($id);

            // get an array of all student ID's
            $qstudentIDs = "SELECT student_id from students";
            $pids = $mysqli->query($qstudentIDs);
            $studentIDs = mysqli_fetch_array($pids);

            // check if target ID is in array of student ID's
            if (!in_array($targetID[0], $studentIDs)){
                exit('Invalid Student Email');
            }

            $qGetInfo = "SELECT * FROM users WHERE email = '$email'";
            $result = $mysqli->query($qGetInfo);
            $result2 = $mysqli->query($qGetInfo);

            $testrow = mysqli_fetch_array($result);
            if($password != $testrow['password']){
                echo "Incorrect Password";
            }else{
                echo "<table>"; // start a tag in the HTML
                while($row = mysqli_fetch_array($result2)){   //Creates a loop to loop through results
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
            $mysqli->close();
        }
    ?>

<form action="StudentEditInfo.php" method="post"><br>
        <input type="submit" class="button" name="EditButton" value="Edit Information"/>
    </form>
    <form action="StudentSignIn.php" method="post"><br>
        <input type="submit" class="button" name="returnButton" value="Return"/>
    </form>
    </center>
</body>
</html>