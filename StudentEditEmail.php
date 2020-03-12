<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <center>
    <label><font face="Times New Roman" color="black" size="+1">Edit Email</font></label>
    <form action="StudentPage.php" method="post">
        <label for="email">Enter a new email address:</label>
        <input type="input" id="email" name="email"><br><br>
    </form>
    <form action="StudentSignIn.php" method="post"><br>
        <input type="submit" class="button" name="returnButton" value="Return"/>
    </form>
    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'db2project'); //The Blank string is the password
        if (isset($_POST['signUpButton']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
        }
        echo $email
    ?>
    </center>
</body>
</html>