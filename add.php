<?php
$database = sqlite_open('db.sqlite', 0666, $error);
    
$query = 'CREATE TABLE Revision' .
         '(Subject TEXT, Topic TEXT, Subtopic TEXT, Notes TEXT)';
    
sqlite_query($database, $query);
}

//insert data into database
$query = 'INSERT INTO Revision (Subject, Topic, Subtopic, Notes) VALUES ("' . $_POST["subject"] . '", "' . $_POST["topic"] . '", "' . $_POST["subtopic"] . '", "' . $_POST["notes"] . '");';
    sqlite_query($database, $query);
?>
<?php header( 'Location: index.php?subject=' .  $_POST["subject"] . '&topic=' . $_POST["topic"] . '&subtopic=' . $_POST["subtopic"]); ?>