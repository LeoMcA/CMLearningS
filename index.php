<?php
    session_start();
    
    if(file_exists('db.sqlite')); else header( 'Location: add.html' );

    include('class.php');

    $page = new page;
    
    $database = new SQLiteDatabase('db.sqlite', 0666);
?>
<!doctype html>
<html>
<head>
    <script type="text/javascript" src="tinymce/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
    <title><?php $title = new title; echo $title->get_title(); ?></title>
    <script type="text/javascript">
        tinyMCE.init({
            theme : "advanced",
            mode : "textareas",
            plugins : "fullpage",
            theme_advanced_buttons3_add : "fullpage"
        });
    </script>
</head>
<body>
    <a href='logout.php'>Logout</a>
    <h1><?php $title = new title; echo $title->get_title(); ?></h1>
    <?php accessdb();
    $user = new user;
    echo $user->is_loggedin("<form action='add.php' method='post'>" .
            "Subject: <br><input type='text' name='subject'><br>" .
            "Topic: <br><input type='text' name='topic'><br>" .
            "Subtopic: <br><input type='text' name='subtopic'><br>" .
            "Notes: <br><textarea rows='2' cols='20' name='notes'></textarea><br>" .
            "<input type='submit' value='Submit'>" .
            "</form>","<form action='login.php' method='post'>" . 
            "Username: <br><input type='text' name='username'><br>" .
            "Password: <br><input type='password' name='password'><br>" .
            "<input type='submit' value='Submit'>" .
            "</form>" .
            "<form action='create_user.php' method='post'>" .
            "Username: <br><input type='text' name='username'><br>" .
            "Password: <br><input type='password' name='password'><br>" .
            "<input type='submit' value='Submit'>" .
            "</form>");
    ?>
</body>
</html>