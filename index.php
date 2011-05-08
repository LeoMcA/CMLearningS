<?php
if(file_exists('db.sqlite')); else header( 'Location: add.html' );
?>
<!doctype html>
<html>
<head>
    <title><?php if($page=="index") echo "Subject Index"; elseif($page=="topic-index") echo "Topic Index for " . $_GET["subject"]; elseif($page=="subtopic-index") echo "Subtopic Index for " . $_GET["topic"]; elseif($page=="notes") echo "Notes for " . $_GET["subtopic"]; ?></title>
</head>
<body>
    <h1><?php if($page=="index") echo "Subject Index"; elseif($page=="topic-index") echo "Topic Index for " . $_GET["subject"]; elseif($page=="subtopic-index") echo "Subtopic Index for " . $_GET["topic"]; elseif($page=="notes") echo "Notes for " . $_GET["subtopic"]; ?></h1>
    <?php
    if($page=="index") accessdb();
    if($page=="topic-index") accessdb();
    if($page=="subtopic-index") accessdb();
    if($page=="notes") accessdb();
    ?>
</body>
</html>