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
        $passwordIn = $_POST['passwordIn'];
        $user = $_POST['user'];
    
        // get the ID of the email entered
        $qGetId = "SELECT id FROM users WHERE email = '$email'";
        $id = $mysqli->query($qGetId);
        $targetID = mysqli_fetch_array($id);

        // query for updating the password based on input
        $updatePass = " UPDATE users 
                        SET password ='$passwordIn' 
                        WHERE email = '$email' 
                        AND password = '$password'";
        $resPass = $mysqli->query($updatePass);
        if($resPass){
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
        <?php if($resPass) : ?>
            <input type="hidden" name="password" value="<?php echo $passwordIn;?>" > 
        <?php else : ?>
            <input type="hidden" name="password" value="<?php echo $password;?>" > 
        <?php endif; ?>
        <input type="hidden" name="email" value="<?php echo $email;?>" >
        <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
        <input type="submit" class="button" name="returnButton" value="Return"/>
    </form>
    </center>
</body>
</html>