<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1> <font face="Times New Roman" color="black" size="+10"><center>Create a Meeting</center></font></h1>
    <center>
    <?php
        $user = "admin";
        $bool = false;
        $mysqli = new mysqli('localhost', 'root', '', 'db2project');
        $email = $_POST['email'];
        $password = $_POST['password'];
    ?>
    <form action="" method="post">
        <?php echo "<table><tr><td>Meeting Name:</td><th>"; ?>
        <input type="text" id="MName" name="MName">
        <?php echo "</th></tr><tr><td>Date:</td><td>"; ?>
        <input type="text" id="date" name="date">
        <?php echo "</td></tr><tr><td>Day of the Week:</td><td>"; ?>
        <input type="text" id="DOW" name="DOW">
        <?php echo "</td></tr><tr><td>Start Time:</td><td>"; ?>
        <input type="text" id="ST" name="ST">
        <?php echo "</td></tr><tr><td>End Time:</td><td>"; ?>
        <input type="text" id="ET" name="ET">
        <?php echo "</td></tr><tr><td>Capacity:</td><td>"; ?>
        <input type="text" id="capacity" name="capacity">
        <?php echo "</td></tr><tr><td>Announcement:</td><td>"; ?>
        <input type="text" id="announce" name="announce">
        <?php echo "</td></tr><tr><td>Group:</td><td>"; ?>
        <input type="text" id="group" name="group">
        <?php echo "</td></tr></table>"; ?>
    </form>
    <form action="AdminPage.php" method="post"><br>
        <input type="hidden" name='email' value= <?php echo $email ?> >
        <input type="hidden" name="password" value= <?php echo $password ?> >
        <input type="submit" class="button" name="returnButton" value="Return"/>
    </form>
    </center>
</body>
</html>