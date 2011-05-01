<?php
if(file_exists('db.sqlite') {
    try {
        $database = new SQLiteDatabase('db.sqlite', 0666, $error);
    }
    
    catch(Exception $e) {
        die($error);
    }
}

else {
    try {
        $database = new SQLiteDatabase('db.sqlite', 0666, $error);
    }
    
    catch(Exception $e) {
        die($error);
    }
    
    $query = 'CREATE TABLE Table' .
         '(Subject TEXT, Topic TEXT, Subtopic TEXT, Notes TEXT)';
         
    if(!$database->queryExec($query, $error)) {
        die($error);
    }
}

//insert data into database
$query =
    'INSERT INTO Table (Subject, Topic, Subtopic, Notes) ' .
    'VALUES ("' . $_POST["subject"] . '", "' . $_POST["topic"] . '", "' . $_POST["subtopic"] . '", "' . $_POST["notes"] . '"); '

if(!$database->queryExec($query, $error)) {
    die($error);
}

header( 'Location: index.php?subject=' .  $_POST["subject"] . '&topic=' . $_POST["topic"] . '&subtopic=' . $_POST["subtopic"]);
?>