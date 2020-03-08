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
        <label for="email">Email:</label>
        <input type="text" id="email" name="email"><br><br>
        <label for="pemail">Parent Email:</label>
        <input type="text" id="pemail" name="pemail"><br><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone"><br><br>
        <label for="grade">Grade:</label>
        <input type="text" id="grade" name="grade"><br><br>
        <label for="password">Password:</label>
        <input type="text" id="password" name="password"><br><br>
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
            // validate grade level
            $grade = $_POST['grade'];
            if(($grade <= 0) || ($grade >= 50)){
                exit('Invalid Grade');
            }

            $mysqli = new mysqli('localhost', 'root', '', 'db2project');
            $query = "INSERT INTO users(email, password, name, phone) VALUES ('$email','$password','$name','$phone')";
            $mysqli->query($query);

            $query2 = "SELECT id FROM users WHERE email = '$email'";
            $result = $mysqli->query($query2);
            $studentID;
            while ($row = $result->fetch_assoc()) {
                $studentID = $row['id'];
            }

            $query3 = "SELECT id FROM users WHERE email = '$parentEmail'";
            $result3 = $mysqli->query($query3);
            $parentID;
            while ($row = $result3->fetch_assoc()) {
                $parentID = $row['id'];
            }

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

        }
    ?>
    </center>
</body>
</html>