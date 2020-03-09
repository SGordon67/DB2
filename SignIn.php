<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1> <font face="Times New Roman" color="black" size="+10"><center>Study Groups</center></font></h1>
    <center>
    <form action="test.php" method="post"><br>
        <label style="font-size:20px;">Sign In</label><br><br>
        <button type="ParentSingIn" formaction="http://localhost/dashboard/DB2/AdminSignIn.php">beep</button>
        <button type="ParentSingIn" formaction="http://localhost/dashboard/DB2/ParentSignIn.php">Parent</button>
        <button type="StudentSingIn" formaction="http://localhost/dashboard/DB2/StudentSignIn.php">Student</button><br><br><br>
        <label style="font-size:20px;">Register</label><br><br>
        <button type="SignUpParent" formaction="http://localhost/dashboard/DB2/SignUpParent.php">Parent</button>
        <button type="SignUpStudent" formaction="http://localhost/dashboard/DB2/SignUpStudent.php">Student</button>
    </form>
    <?php
    ?>
    </center>
</body>
</html>