<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1> <font face="Times New Roman" color="black" size="+10"><center>Student Sign In</center></font></h1>
    <center>
    <form action="StudentPage.php" method="post">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email"><br><br>
        <label for="password">Password:</label>
        <input type="text" id="password" name="password"><br><br>
        <input type="submit" class="button" name="signUpButton" value="Sign In"/>
    </form>
    <form action="SignIn.php" method="post"><br>
        <input type="submit" class="button" name="returnButton" value="Return"/>
    </form>
    <?php
        if (isset($_POST['signUpButton']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
        }
    ?>
    </center>
</body>
</html>