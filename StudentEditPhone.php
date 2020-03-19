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
    ?>

    <label><font face="Times New Roman" color="black" size="+1">Edit Phone</font></label>
    <form action="StudentEditPhone2.php" method="post"><br>
        <br><label for="email">Enter a new phone number:</label>
        <input type="input" id="phoneIn" name="phoneIn"><br><br>

        <input type="hidden" id="email" name="email" value="<?php echo $email;?>" > 
        <input type="hidden" id="password" name="password" value="<?php echo $password;?>" >
        <input type="submit" name="ChPhone" class="button" value="Change Phone" />
    </form>
    <form action="StudentPage.php" method="post"><br>
        <input type="hidden" name="email" value="<?php echo $email;?>" > 
        <input type="hidden" name="password" value="<?php echo $password;?>" >
        <input type="submit" class="button" name="returnButton" value="Return"/>
    </form>
    </center>
</body>
</html>