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
    // get posted variables
    $user = $_POST['user'];
    $mysqli = new mysqli('localhost', 'root', '', 'db2project');
    $email = $_POST['email'];
    $emailEDIT = $_POST['emailEDIT'];
    $password = $_POST['password'];
    //$id = $_POST['id'];

    // get the id of the user
    $getuserid = "SELECT id, name FROM users WHERE email = '$emailEDIT'";
    $idResult = $mysqli->query($getuserid);
    $idArr = mysqli_fetch_array($idResult);
    $id = $idArr['id'];
    
    // Now we have the information to display the header
?> 
<h1> <font face="Times New Roman" color="black" size="+10"><center><?php echo $idArr['name']."'s Study Materials"; ?></center></font></h1>
<?php
    // get all the meeting ID's from enroll table and enroll2 table
    $getMeetings = "SELECT meet_id FROM enroll WHERE mentee_id = '$id' UNION SELECT meet_id FROM enroll2 WHERE mentor_id = '$id'";
    $meetingsRes = $mysqli->query($getMeetings);
    echo "<table>";
    while($meetingArr = mysqli_fetch_array($meetingsRes)){
        $getMaterialID = "SELECT * FROM assign WHERE meet_id = {$meetingArr['meet_id']}";
        $materialRes = $mysqli->query($getMaterialID);
        while($materialIDArr = mysqli_fetch_array($materialRes)){
            $getMaterialInfo = "SELECT * FROM material WHERE material_id = {$materialIDArr['material_id']}";
            $materialRes2 = $mysqli->query($getMaterialInfo);
            while($materialInfoArr = mysqli_fetch_array($materialRes2)){
                echo "
                    <tr>
                        <td>Meeting ID:</td>
                        <td>".$meetingArr['meet_id']."</td>
                    </tr>
                    <tr>
                        <td>URL:</td>
                        <td>".$materialInfoArr['url']."</td>
                    </tr>
                    <tr></tr><tr></tr><tr></tr>
                    <tr></tr><tr></tr><tr></tr>
                    <tr></tr><tr></tr><tr></tr>
                    <tr></tr><tr></tr><tr></tr>";
                    // spacing between rows of the table
            }
        }
    }
    echo "</table>";



?>
<!-- Return button -->
<?php if($user == "student") : ?>
    <form action="StudentPage.php" method="post"><br>
    <?php elseif($user == "parent") : ?>
    <form action="ParentPage.php" method="post"><br>
    <?php else : ?>
    <form action="AdminPage.php" method="post"><br>
    <?php endif; ?>
        <input type="hidden" id="email" name="email" value="<?php echo $email;?>" >
        <input type="hidden" id="emailEDIT" name="emailEDIT" value="<?php echo $emailEDIT;?>" >
        <input type="hidden" id="password" name="password" value="<?php echo $password;?>" >
        <input type="hidden" id="user" name="user" value="<?php echo $user;?>" > 
        <input type="submit" class="button" name="returnButton" value="Return"/>
    </form>
</center>
</body>
</html>