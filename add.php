<?php
$file = fopen($_POST["subject"] . "-" . $_POST["topic"] . "-" . $_POST["subtopic"] . ".xml","w");
echo fwrite($file,"<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><root><subject>" . $_POST["subject"] . "</subject><topic>" . $_POST["topic"] . "</topic><subtopic>" . $_POST["subtopic"] . "</subtopic><notes>" . $_POST["notes"] . "</notes></root>");
fclose($file);
header( 'Location: index.php?subject=' .  $_POST["subject"] . '&topic=' . $_POST["topic"] . '&subtopic=' . $_POST["subtopic"]);
?>