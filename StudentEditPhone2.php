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


        // validate phone number
        $phoneIn = $_POST['phoneIn'];
        if(!preg_match('/^[0-9]{10}+$/', $phoneIn)) {
            $head = "Invalid Phone Number";
            $resPhone = False;
        } else{
            // query for updating the email based on input
            $updatePhone = "UPDATE users 
                            SET phone='$phoneIn' 
                            WHERE email = '$email'
                            AND password = '$password'";
            $resPhone = $mysqli->query($updatePhone);
            $head = "Success";
        }
    ?>
    <br>
    <label><font face="Times New Roman" color="black" size="+1"><?php echo $head;?></font></label>
    <form action="StudentPage.php" method="post"><br>
        <input type="hidden" name="email" value="<?php echo $email;?>" > 
        <input type="hidden" name="password" value="<?php echo $password;?>" >
        <input type="submit" class="button" name="returnButton" value="Return"/>
    </form>
    </center>
</body>
</html>