<?php
include('class.php');

$database = new SQLiteDatabase('db.sqlite', 0666);
    
$query = 'CREATE TABLE Revision' .
            '(Subject TEXT, Topic TEXT, Subtopic TEXT, Notes TEXT);';

$database->queryExec($query);

$query = 'INSERT INTO Revision (Subject, Topic, Subtopic, Notes)' .
            'VALUES ("' . $_POST["subject"] . '", "' . $_POST["topic"] . '", "' . $_POST["subtopic"] . '", \'' . $_POST["notes"] . '\');';

$database->queryExec($query);

header( 'Location: index.php?subject=' .  $_POST["subject"] . '&topic=' . $_POST["topic"] . '&subtopic=' . $_POST["subtopic"]);
?>