<?php
if(file_exists('db.sqlite')); else header( 'Location: add.html' );
if($_GET["subject"]==NULL) $page = "index";
elseif($_GET["topic"]==NULL) $page = "topic-index";
elseif($_GET["subtopic"]==NULL) $page = "subtopic-index";
else $page = "notes";

function indexList() {
    global $page;
    $query = "SELECT Subject, Topic, Subtopic FROM Revision";
    $result = sqlite_array_query(sqlite_open('db.sqlite', 0666, $error), $query);
    $item = array();
    foreach($result as $value) {
        if($page=="index") $item[] = $value[Topic];
        if($page=="topic-index") if($value[Subject]==$_GET["subject"]) $item[] = $value[Topic];
        if($page=="subtopic-index") if($value[Subject]==$_GET["subject"]) if($value[Topic]==$_GET["topic"]) $item[] = $value[Subtopic];
    }
    echo "<ul>";
    foreach($item as $value) {
        echo "<li><a href=\"index.php?subject="; if($page=="topic-index") echo $_GET["subject"]."&topic="; if($page=="subtopic-index") echo $_GET["topic"]."&subtopic="; echo $value."\">".$value."</a></li>";
    }
    echo "</ul>";
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
    if($page=="index") indexList();
    if($page=="topic-index") indexList();
    if($page=="subtopic-index") indexList();
    if($page=="notes") {
    }
    ?>
</body>
</html>