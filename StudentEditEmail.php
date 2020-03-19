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

    <label><font face="Times New Roman" color="black" size="+1">Edit Email</font></label>
    <form action="StudentEditEmail2.php" method="post"><br>
        <br><label for="email">Enter a new email address:</label>
        <input type="input" id="emailIn" name="emailIn"><br><br>

        <input type="hidden" id="email" name="email" value="<?php echo $email;?>" > 
        <input type="hidden" id="password" name="password" value="<?php echo $password;?>" >
        <input type="submit" name="ChEmail" class="button" value="Change Email" />
    </form>
    <form action="StudentPage.php" method="post"><br>
        <input type="hidden" name="email" value="<?php echo $email;?>" > 
        <input type="hidden" name="password" value="<?php echo $password;?>" >
        <input type="submit" class="button" name="returnButton" value="Return"/>
    </form>
    </center>
</body>
</html>