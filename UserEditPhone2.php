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
        $emailEDIT = $_POST['emailEDIT'];
        $password = $_POST['password'];
        $user = $_POST['user'];

        // validate phone number
        $phoneIn = $_POST['phoneIn'];
        if(!preg_match('/^[0-9]{10}+$/', $phoneIn)) {
            $head = "Invalid Phone Number";
            $resPhone = False;
        } else{
            // query for updating the email based on input
            $updatePhone = "UPDATE users 
                            SET phone='$phoneIn' 
                            WHERE email = '$emailEDIT'";
            $resPhone = $mysqli->query($updatePhone);
            $head = "Success";
        }
    ?>
    <br>
    <label><font face="Times New Roman" color="black" size="+1"><?php echo $head;?></font></label>
    
    <?php if($user == "student") : ?>
    <form action="StudentPage.php" method="post"><br>
    <?php elseif($user == "parent") : ?>
    <form action="ParentPage.php" method="post"><br>
    <?php else : ?>
    <form action="AdminPage.php" method="post"><br>
    <?php endif; ?>
        <input type="hidden" name="email" value="<?php echo $email;?>" >
        <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $email;?>" >
        <input type="hidden" name="password" value="<?php echo $password;?>" >
        <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
        <input type="submit" class="button" name="returnButton" value="Return"/>
    </form>
    </center>
</body>
</html>