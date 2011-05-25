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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title></title>
</head>
<body>
    <header>
    <nav>
    <?php
    if($user->is_loggedin()=='true') {
        printf("<a class='add' href='#'>Add</a>");
        printf("<a class='edit' href='#'>Edit</a>");
        printf("<a href='index.php?page=logout'>Logout %s</a>",$_SESSION['user']);
    }
    if($user->is_loggedin()=='false') {
        printf("<a class='signup' href='#'>Sign up</a>");
        printf("<a class='login' href='#'>Login</a>");
    }
    </nav>
    ?>
    <h1></h1>
    </header>
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
        
        if($page->get_page()=='su') {
            $user->set_user();
            printf('Signed up');
        }
        
        if($page->get_page()=='li') {
            if($user->get_user()=='false') {
                printf('Sorry, that user does not exsist');
            }
            else {
                $username = $user->get_user();
                $_SESSION['user'] = $username[0];
                printf('Logged in');
            }
        }
        
        if($page->get_page()=='lo') {
            session_destroy();
            printf('Loggged out');
        }
        
        if($page->get_page()=='a') {
            $query = 'CREATE TABLE Revision' .
                '(Subject TEXT, Topic TEXT, Subtopic TEXT, Notes TEXT);';
            $database->queryExec($query);

            $query = 'INSERT INTO Revision (Subject, Topic, Subtopic, Notes)' .
                'VALUES ("' . $_POST["subject"] . '", "' . $_POST["topic"] . '", "' . $_POST["subtopic"] . '", \'' . $_POST["notes"] . '\');';
            $database->queryExec($query);

            header( 'Location: index.php?page=notes&subject=' .  $_POST["subject"] . '&topic=' . $_POST["topic"] . '&subtopic=' . $_POST["subtopic"]);
        }
        
        if($page->get_page()=='e') {
            $query = 'DELETE FROM Revision ' .
                'WHERE Subject="'.$_POST["subject"].'" AND Topic="'.$_POST["topic"].'" AND Subtopic="'.$_POST["subtopic"].'";';
            $database->queryExec($query);
            
            $query = 'INSERT INTO Revision (Subject, Topic, Subtopic, Notes)' .
                'VALUES ("' . $_POST["subject"] . '", "' . $_POST["topic"] . '", "' . $_POST["subtopic"] . '", \'' . $_POST["notes"] . '\');';
            $database->queryExec($query);

            header( 'Location: index.php?page=notes&subject=' .  $_POST["subject"] . '&topic=' . $_POST["topic"] . '&subtopic=' . $_POST["subtopic"]);
        }
        
    ?>
    <div class='drop-down'>
    <form action='index.php?page=add' method='post' class='add'>
    Subject: <br><input type='text' name='subject'><br>
    Topic: <br><input type='text' name='topic'><br>
    Subtopic: <br><input type='text' name='subtopic'><br>
    Notes: <br><textarea style='width:100%;height:500px;' name='notes'></textarea><br>
    <input type='submit' value='Submit'>
    </form>
    <form action='index.php?page=edit' method='post' class='edit'>
    Subject: <br><input type='text' name='subject' value='<?php printf($_GET['subject']); ?>'><br>
    Topic: <br><input type='text' name='topic' value='<?php printf($_GET['topic']); ?>'><br>
    Subtopic: <br><input type='text' name='subtopic' value='<?php printf($_GET['subtopic']); ?>'><br>
    Notes: <br><textarea style='width:100%;height:500px;' name='notes'><?php $page->print_notes($page->get_notes()); ?></textarea><br>
    <input type='submit' value='Submit'>
    </form>
    <form action='index.php?page=login' method='post' class='login'>
    Username: <br><input type='text' name='username'><br>
    Password: <br><input type='password' name='password'><br>
    <input type='submit' value='Submit'>
    </form>
    <form action='index.php?page=signup' method='post' class='signup'>
    Username: <br><input type='text' name='username'><br>
    Password: <br><input type='password' name='password'><br>
    <input type='submit' value='Submit'>
    </form>
    </div>
</body>
</html>