<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1> <font face="Times New Roman" color="black" size="+10"><center>Student Sign Up</center></font></h1>
    <center>
    <form action="" method="post">
        <?php echo "<table><tr><td>Email:</td><th>"; ?>
        <input type="text" id="email" name="email">
        <?php echo "</th></tr><tr><td>Password:</td><td>"; ?>
        <input type="password" id="password" name="password">
        <?php echo "</td></tr><tr><td>Parent Email:</td><td>"; ?>
        <input type="text" id="pemail" name="pemail">
        <?php echo "</td></tr><tr><td>Name:</td><td>"; ?>
        <input type="text" id="name" name="name">
        <?php echo "</td></tr><tr><td>Phone:</td><td>"; ?>
        <input type="text" id="phone" name="phone">
        <?php echo "</td></tr><tr><td>Grade:</td><td>"; ?>
        <select id="grade" name="grade">
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>
        <?php echo "</td></tr></table>"; ?><br><br>
        <input type="submit" class="button" name="signUpButton" value="Sign Up"/>
    </form>
    <form action="SignIn.php" method="post"><br>
        <input type="submit" class="button" name="returnButton" value="Return to sign in"/>
    </form>
    <?php
        if (isset($_POST['signUpButton']))
        {
            $password = $_POST['password'];
            $name = $_POST['name'];
            // validate email
            $email = trim(htmlspecialchars($_POST['email']));
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if ($email === false) {
                exit('Invalid Email');
            }
            // validate parent email
            $parentEmail = trim(htmlspecialchars($_POST['pemail']));
            $parentEmail = filter_var($parentEmail, FILTER_VALIDATE_EMAIL);
            if ($email === false) {
                exit('Invalid Parent Email');
            }
            // validate phone number
            $phone = $_POST['phone'];
            if(!preg_match('/^[0-9]{10}+$/', $phone)) {
                exit('Invalid Phone Number');
            }
            // no validation needed, changed to drop down menu
            $grade = $_POST['grade'];

            // insert into users table
            $mysqli = new mysqli('localhost', 'root', '', 'db2project');
            $query = "INSERT INTO users(email, password, name, phone) VALUES ('$email','$password','$name','$phone')";
            $mysqli->query($query);
            
            // get the id that was created for this user
            $query2 = "SELECT id FROM users WHERE email = '$email'";
            $result = $mysqli->query($query2);
            $studentID;
            while ($row = $result->fetch_assoc()) {
                $studentID = $row['id'];
            }

            // get the parents id
            $query3 = "SELECT id FROM users WHERE email = '$parentEmail'";
            $result3 = $mysqli->query($query3);
            $parentID;
            while ($row = $result3->fetch_assoc()) {
                $parentID = $row['id'];
            }

            // insert into students table
            $query4 = "INSERT INTO students(student_id, grade, parent_id) VALUES ($studentID, '$grade', $parentID)";
            $result4 = $mysqli->query($query4);
            if($result4){
                echo "Sign up complete";
            } else {
                echo "Inconsistency, sign up incomplete";
                $query5 = "DELETE FROM users WHERE id = $studentID";
                $result5 = $mysqli->query($query5);
                if($result5){
                    echo " ";
                }
            }

            // insert into the proper group
            //$query5 = "";
            //$result5 = $mysqli->query($query5);

        }
    ?>
    </center>
</body>
</html>