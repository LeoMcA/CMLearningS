<?php
if(file_exists('db.sqlite')); else header( 'Location: add.html' );
if($_GET["subject"]==NULL) $page = "index";
elseif($_GET["topic"]==NULL) $page = "topic-index";
elseif($_GET["subtopic"]==NULL) $page = "subtopic-index";
else $page = "notes";

function accessdb() {
    global $page;
    $query = "SELECT Subject, Topic, Subtopic, Notes FROM Revision";
    $result = sqlite_array_query(sqlite_open('db.sqlite', 0666, $error), $query);
    $item = array();
    foreach($result as $value) {
        if($page=="index") $item[] = $value[Subject];
        if($page=="topic-index") if($value[Subject]==$_GET["subject"]) $item[] = $value[Topic];
        if($page=="subtopic-index") if($value[Subject]==$_GET["subject"]) if($value[Topic]==$_GET["topic"]) $item[] = $value[Subtopic];
        if($page=="notes") if($value[Subject]==$_GET["subject"]) if($value[Topic]==$_GET["topic"]) if($value[Subtopic]==$_GET["subtopic"]) $item[] = $value[Notes];
    }
    $item = array_unique($item);
    if($page=="notes") echo $item[0]; else {
        echo "<ul>";
        foreach($item as $value) {
            echo "<li><a href=\"index.php?subject="; if($page=="topic-index") echo $_GET["subject"]."&topic="; if($page=="subtopic-index") echo $_GET["topic"]."&subtopic="; echo $value."\">".$value."</a></li>";
        }
        echo "</ul>";
    }
}
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