<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1> <font face="Times New Roman" color="black" size="+10"><center>Parent Sign Up</center></font></h1>
    <center>
    <form action="" method="post">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email"><br><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
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
            // validate phone number
            $phone = $_POST['phone'];
            if(!preg_match('/^[0-9]{10}+$/', $phone)) {
                exit('Invalid Phone Number');
            }
                
            $mysqli = new mysqli('localhost', 'root', '', 'DB2');
            $query = "INSERT INTO users(email, password, name, phone) VALUES ('$email','$password','$name','$phone')";
            $mysqli->query($query);

            $query2 = "SELECT id FROM users WHERE email = '$email'";
            $result = $mysqli->query($query2);
            $parentID;
            while ($row = $result->fetch_assoc()) {
                $parentID = $row['id'];
            }

            $query3 = "INSERT INTO parents(parent_id) VALUES ($parentID)";
            $mysqli->query($query3);
            echo "Sign up complete";
        }
    ?>
    </center>
</body>
</html>