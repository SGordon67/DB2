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
        // setup the database for query, grab variables from post
        $head = "Error";
        $mysqli = new mysqli('localhost', 'root', '', 'db2project');
        $email = $_POST['email'];
        $password = $_POST['password'];

        // validate new email
        $emailIn = trim(htmlspecialchars($_POST['emailIn']));
        $emailIn = filter_var($emailIn, FILTER_VALIDATE_EMAIL);
        if ($emailIn === false) {
            $head = "Invalid Email";
            $resEmail = False;
        } else{
            // query for updating the email based on input
            $updateEmail = "UPDATE users 
                            SET email='$emailIn' 
                            WHERE email = '$email'
                            AND password = '$password'";
            $resEmail = $mysqli->query($updateEmail);
            $head = "Success";
        }
    ?>
    <br>
    <label><font face="Times New Roman" color="black" size="+1"><?php echo $head;?></font></label>
    <form action="StudentPage.php" method="post"><br>
        <?php if($resEmail) : ?>
            <input type="hidden" name="email" value="<?php echo $emailIn;?>" > 
        <?php else : ?>
            <input type="hidden" name="email" value="<?php echo $email;?>" > 
        <?php endif; ?>
        <input type="hidden" name="password" value="<?php echo $password;?>" >
        <input type="submit" class="button" name="returnButton" value="Return"/>
    </form>
    </center>
</body>
</html>