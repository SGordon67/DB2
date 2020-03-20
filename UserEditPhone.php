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
        $mysqli = new mysqli('localhost', 'root', '', 'db2project');
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $_POST['user'];

    ?>

    <label><font face="Times New Roman" color="black" size="+1">Edit Phone</font></label>
    <form action="UserEditPhone2.php" method="post"><br>
        <br><label for="email">Enter a new phone number:</label>
        <input type="input" id="phoneIn" name="phoneIn"><br><br>

        <input type="hidden" id="email" name="email" value="<?php echo $email;?>" > 
        <input type="hidden" id="password" name="password" value="<?php echo $password;?>" >
        <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
        <input type="submit" name="ChPhone" class="button" value="Change Phone" />
    </form>

    <?php if($user == "student") : ?>
    <form action="StudentPage.php" method="post"><br>
    <?php elseif($user == "parent") : ?>
    <form action="ParentPage.php" method="post"><br>
    <?php else : ?>
    <form action="AdminPage.php" method="post"><br>
    <?php endif; ?>
        <input type="hidden" name="email" value="<?php echo $email;?>" > 
        <input type="hidden" name="password" value="<?php echo $password;?>" >
        <input type="hidden" id="user" name="user" value="<?php echo $user;?>" >
        <input type="submit" class="button" name="returnButton" value="Return"/>
    </form>
    </center>
</body>
</html>