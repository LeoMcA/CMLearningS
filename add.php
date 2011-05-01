<?php
if(file_exists('db.sqlite')) {
    $database = sqlite_open('db.sqlite', 0666, $error);
}

else {
    
    $database = sqlite_open('db.sqlite', 0666, $error);
    
    $query = 'CREATE TABLE Table' .
         '(Subject TEXT, Topic TEXT, Subtopic TEXT, Notes TEXT)';
    
    sqlite_query($query);
}

//insert data into database
$query =
    'INSERT INTO Table (Subject, Topic, Subtopic, Notes) ' .
    'VALUES ("' . $_POST["subject"] . '", "' . $_POST["topic"] . '", "' . $_POST["subtopic"] . '", "' . $_POST["notes"] . '");'
    sqlite_query($query);
?>
<?php header( 'Location: index.php?subject=' .  $_POST["subject"] . '&topic=' . $_POST["topic"] . '&subtopic=' . $_POST["subtopic"]); ?>