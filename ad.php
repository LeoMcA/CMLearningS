<!doctype html>
<html>
<head>
    <title><?php if(isset($_SESSION['user'])){ echo "Add page"; } else{ echo "Please login"; } ?></title>
</head>
<body>
<?php
    if(isset($_SESSION['user'])) {
        echo "<form action='add.php' method='post'>" .
            "Subject: <br><input type='text' name='subject'><br>" .
            "Topic: <br><input type='text' name='topic'><br>" .
            "Subtopic: <br><input type='text' name='subtopic'><br>" .
            "Notes: <br><textarea rows='2' cols='20' name='notes'></textarea><br>" .
            "<input type='submit' value='Submit'>" .
            "</form>";
    }
    else {
        echo "<form action='login.php' method='post'>" . 
        "Username: <br><input type='text' name='username'><br>" .
        "Password: <br><input type='text' name='password'><br>" .
        "<input type='submit' value='Submit'>" .
        "</form>";
?>
</body>
</html>