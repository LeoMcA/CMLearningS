<?php
    session_start();
    
    if(file_exists('db.sqlite')); else header( 'Location: add.html' );

    include('class.php');

    $page = new page;
    
    $user = new user;
    
    $database = new SQLiteDatabase('db.sqlite', 0666);
?>
<!doctype html>
<html>
<head>
    <script type='text/javascript' src='tinymce/tiny_mce/tiny_mce.js'></script>
    <script type='text/javascript' src='http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
    <script type='text/javascript'>
        tinyMCE.init({
            theme : 'advanced',
            mode : 'textareas',
            plugins : 'fullpage',
            theme_advanced_buttons3_add : 'fullpage'
        });
    </script>
    <title><?php printf(); ?></title>
</head>
<body>
    <a href='logout.php'>Logout</a>
    <h1><?php printf(); ?></h1>
    <?php
        if($page->get_page()=='i') {
            $page->print_list($page->get_subjects());
        }
        
        if($page->get_page()=='t') {
            $page->print_list($page->get_topics());
        }
        
        if($page->get_page()=='s') {
            $page->print_list($page->get_subtopics());
        }
        
        if($page->get_page()=='n') {
            $page->print_notes($page->get_notes());
        }
    ?>
    <form action='add.php' method='post'>
    Subject: <br><input type='text' name='subject'><br>
    Topic: <br><input type='text' name='topic'><br>
    Subtopic: <br><input type='text' name='subtopic'><br>
    Notes: <br><textarea style='width:100%;height:500px;' name='notes'></textarea><br>
    <input type='submit' value='Submit'>
    </form>
    <form action='login.php' method='post'>
    Username: <br><input type='text' name='username'><br>
    Password: <br><input type='password' name='password'><br>
    <input type='submit' value='Submit'>
    </form>
    <form action='create_user.php' method='post'>
    Username: <br><input type='text' name='username'><br>
    Password: <br><input type='password' name='password'><br>
    <input type='submit' value='Submit'>
    </form>
    ?>
</body>
</html>