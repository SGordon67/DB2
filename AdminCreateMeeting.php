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
    <?php echo "<table><tr>"; ?>
    <form action="" method="post">
        <?php echo "<table><tr><td>Meeting Name:</td><th>"; ?>
        <input type="text" id="MName" name="MName">
        <?php echo "</th></tr><tr><td>Date:</td><td>"; ?>
        <input type="text" id="date" name="date">
        <?php echo "</td></tr><tr><td>Time Slot ID:</td><td>"; ?>
        <input type="text" id="TSI" name="TSI">
        <?php echo "</td></tr><tr><td>Capacity:</td><td>"; ?>
        <input type="text" id="capacity" name="capacity">
        <?php echo "</td></tr><tr><td>Announcement:</td><td>"; ?>
        <input type="text" id="announce" name="announce">
        <?php echo "</td></tr><tr><td>Group:</td><td>"; ?>
        <input type="text" id="group" name="group">
        <?php echo "</td></tr></table>"; ?>
    </form>
    <?php echo "</tr></table><br>";

    $getTSinfo = "SELECT * FROM time_slot";
    $result = $mysqli->query($getTSinfo);
    echo "<table><tr><td>";
    $temp = 0;
    while($row = mysqli_fetch_array($result)){ // loop through result
        echo "  <table><tr>
                    <td>ID:</td>
                    <td>" . $row['time_slot_id'] . "</td>
                </tr>
                <tr>
                    <td>Day of the week:</td>
                    <td>" . $row['day_of_the_week'] . "</td>
                </tr>
                <tr>
                    <td>Start Time:</td>
                    <td>" . $row['start_time'] . "</td>
                </tr>
                <tr>
                    <td>End Time:</td>
                    <td>" . $row['end_time'] . "</td>
                </tr></table>";
                $temp+=1;
        if(($temp % 4) == 0){
            echo "</tr><tr>";
        } else echo "   </td></td></td></td></td></td></td>
                        <td><td><td><td><td><td><td>";
        echo "</td><td>";
    }
    echo "</td</tr></table>"; ?>
    <form action="AdminPage.php" method="post"><br>
        <input type="hidden" name='email' value= <?php echo $email ?> >
        <input type="hidden" name="password" value= <?php echo $password ?> >
        <input type="submit" class="button" name="returnButton" value="Return"/>
    </form>
    </center>
</body>
</html>