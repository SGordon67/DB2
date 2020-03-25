<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1> <font face="Times New Roman" color="black" size="+10"><center>Create Study Material</center></font></h1>
    <center>
    <?php
        $user = "admin";
        $bool = false;
        $mysqli = new mysqli('localhost', 'root', '', 'DB2');
        $email = $_POST['email'];
        $password = $_POST['password'];
    ?>
    <?php echo "<table><tr>"; ?>
    <form action="" method="post">
        <?php 
        echo "<table><tr><td>Title:</td><td>"; ?>
        <input type="text" id="title" name="title">
        <?php echo "</td></tr><tr><td>Author:<td>"; ?>
        <input type="text" id="author" name="author">
        <?php echo "</td></tr><tr><td>URL:<td>"; ?>
        <input type="text" id="URL" name="URL">
        <?php echo "</td></tr><tr><td>Notes:<td>"; ?>
        <input type="text" id="notes" name="notes">
        <?php echo "</td></tr><tr><td>Subject:</td><td>"; ?>
        <select id="subject" name="subject">
            <option value="Math">Math</option>
            <option value="English">English</option>
        </select>
        <?php echo "</td></tr></table>"; ?>
        <br>
        <input type="hidden" name='email' value= <?php echo $email ?> >
        <input type="hidden" name="password" value= <?php echo $password ?> >
        <input type="submit" class="button" name="createMaterialButton" value="Create Material"/>
        <br>
    </form>
<?php
    //code for inserting into the meetings table
    if (isset($_POST['createMaterialButton']))
    {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $URL = $_POST['URL'];
        $notes = $_POST['notes'];
        $subject = $_POST['subject'];

        $date = date("Y-m-d");

        $insertMaterial = "INSERT INTO `material`(`title`, `author`, `type`, `url`, `assigned_date`, `notes`) 
                                VALUES ('$title','$author','$subject','$URL','$date','$notes')";
        $materialRes = $mysqli->query($insertMaterial);

        echo "Study material created";
    }
?>

<form action="AdminPage.php" method="post"><br>
        <input type="hidden" name='email' value= <?php echo $email ?> >
        <input type="hidden" name="password" value= <?php echo $password ?> >
        <input type="submit" class="button" name="returnButton" value="Return to Admin Information"/>
</form>
</center>
</body>
</html>