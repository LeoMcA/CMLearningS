<?php
    session_start();
    
    // if(file_exists('db.sqlite')); else header( 'Location: add.html' );

    include('class.php');

    $page = new page;
    
    $user = new user;
    
    $database = new SQLiteDatabase('db.sqlite', 0666);
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/formalize.css">
    <script type='text/javascript' src='http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script src="js/jquery.formalize.js"></script>
    <title></title>
</head>
<body>
    <header>
    <nav>
    <h1><?php $page->print_bread(); ?></h1>
    <?php
    if($user->is_loggedin()=='true') {
        printf("<ul class='links'><li><a class='add' href='#'>Add</a></li>");
        printf("<li><a class='edit' href='#'>Edit</a></li>");
        printf("<li><a href='index.php?page=logout'>Logout %s</a></li></ul>",$_SESSION['user']);
    }
    if($user->is_loggedin()=='false') {
        printf("<ul class='links'><li><a class='signup' href='#'>Sign up</a></li>");
        printf("<li><a class='login' href='#'>Login</a></li></ul>");
    }
    ?>
    </nav>
    </header>
<section class='main'>
    <section class='drop-down'>
    <form action='index.php?page=add' method='post' class='add'>
<aside class='names'>
    <input type='text' name='subject' placeholder='Subject'><br>
    <input type='text' name='topic' placeholder='Topic'><br>
    <input type='text' name='subtopic' placeholder='Subtopic'><br>
    <input type='submit' value='Submit'>
</aside>
    <aside class='notes'><textarea name='notes' placeholder='Notes'></textarea></aside><br>
    </form>
    <form action='index.php?page=edit' method='post' class='edit'>
<aside class='names'>
    <input type='text' name='subject' placeholder='Subject' value='<?php printf($_GET['subject']); ?>'><br>
    <input type='text' name='topic' placeholder='Topic' value='<?php printf($_GET['topic']); ?>'><br>
    <input type='text' name='subtopic' placeholder='Subtopic' value='<?php printf($_GET['subtopic']); ?>'><br>
    <input type='submit' value='Submit'>
</aside>
    <aside class='notes'><textarea name='notes' placeholder='Notes'><?php $page->print_notes($page->get_notes()); ?></textarea></aside><br>
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
    </section>
    <article>
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
                'VALUES ("' . addslashes($_POST["subject"]) . '", "' . addslashes($_POST["topic"]) . '", "' . addslashes($_POST["subtopic"]) . '", "' . addslashes($_POST["notes"]) . '");';
            $database->queryExec($query);

            header( 'Location: index.php?page=notes&subject=' .  $_POST["subject"] . '&topic=' . $_POST["topic"] . '&subtopic=' . $_POST["subtopic"]);
        }
        
        if($page->get_page()=='e') {
            $query = 'DELETE FROM Revision ' .
                'WHERE Subject="'.$_POST["subject"].'" AND Topic="'.$_POST["topic"].'" AND Subtopic="'.$_POST["subtopic"].'";';
            $database->queryExec($query);
            
            $query = 'INSERT INTO Revision (Subject, Topic, Subtopic, Notes)' .
                'VALUES ("' . addslashes($_POST["subject"]) . '", "' . addslashes($_POST["topic"]) . '", "' . addslashes($_POST["subtopic"]) . '", "' . addslashes($_POST["notes"]) . '");';
            $database->queryExec($query);

            header( 'Location: index.php?page=notes&subject=' .  $_POST["subject"] . '&topic=' . $_POST["topic"] . '&subtopic=' . $_POST["subtopic"]);
        }
        
    ?>
    </article>
    </section>
</body>
</html>
