<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1> <font face="Times New Roman" color="black" size="+10"><center>Meeting Info</center></font></h1>
    <center>
    <?php
        $user = "admin";
        $mysqli = new mysqli('localhost', 'root', '', 'db2project');
        $email = $_POST['email'];
        $password = $_POST['password'];

        $getMeetingInfo = "SELECT * FROM meetings";
        $result = $mysqli->query($getMeetingInfo);
        echo "<table><tr><td>";
    $temp = 0;
    echo "<br>";
    while($row = mysqli_fetch_array($result)){ // loop through result
        echo "  <table><tr>
                    <td>ID:</td>
                    <td>" . $row['meet_id'] . "</td>
                </tr>
                <tr>
                    <td>Subject:</td>
                    <td>" . $row['meet_name'] . "</td>
                </tr>
                <tr>
                    <td>Date:</td>
                    <td>" . $row['date'] . "</td>
                </tr>
                <tr>
                    <td>Group:</td>
                    <td>" . $row['group_id'] . "</td>
                </tr>
                <tr>
                    <td>Delete Meeting:</td>
                    <td>";?>
                    <form action="" method="post">
                        <input type="hidden" name='email' value= <?php echo $email ?> >
                        <input type="hidden" name="password" value= <?php echo $password ?> >
                        <input type="hidden" name="meet_id" value= <?php echo $row['meet_id'] ?> >
                        <input type="submit" class="button" name="deleteButton" value="Delete"/>
                    </form><?php echo "
                    </td>
                </tr></table>";
                $temp+=1;
        if(($temp % 5) == 0){
            echo "</tr><tr>";
        } else echo "</td><td></td><td></td><td></td><td>
                    </td><td></td><td></td><td></td><td>";
        echo "</td><td>";
        echo "<br>";
    }
    echo "</td</tr></table>"; ?>
<form action="AdminPage.php" method="post"><br>
    <input type="hidden" name='email' value= <?php echo $email ?> >
    <input type="hidden" name="password" value= <?php echo $password ?> >
    <input type="submit" class="button" name="returnButton" value="Return"/>
</form>
<?php
//code for inserting into the meetings table
if (isset($_POST['deleteButton']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $meet_id = $_POST['meet_id'];
    
    $deleteMeeting = "DELETE FROM `meetings` WHERE meet_id = '$meet_id'";
    $result2 = $mysqli->query($deleteMeeting);
    if($result2){
        echo "successfully deleted";
    } else echo "Error in deleting";
}
?>
</center>
</body>
</html>