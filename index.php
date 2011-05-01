<?php
if(file_exists('db.sqlite')) $database = sqlite_open('db.sqlite', 0666, $error); else header( 'Location: add.html' );

if($_GET["subject"]==NULL) $page = "index";
elseif($_GET["topic"]==NULL) $page = "topic-index";
elseif($_GET["subtopic"]==NULL) $page = "subtopic-index";
else $page = "notes";
?>
<!doctype html>
<html>
<head>
    <title><?php if($page=="index") echo "Subject Index"; elseif($page=="topic-index") echo "Topic Index for " . $_GET["subject"]; elseif($page=="subtopic-index") echo "Subtopic Index for " . $_GET["topic"]; elseif($page=="notes") echo "Notes for " . $_GET["subtopic"]; ?></title>
</head>
<body>
    <h1><?php if($page=="index") echo "Subject Index"; elseif($page=="topic-index") echo "Topic Index for " . $_GET["subject"]; elseif($page=="subtopic-index") echo "Subtopic Index for " . $_GET["topic"]; elseif($page=="notes") echo "Notes for " . $_GET["subtopic"]; ?></h1>
    <?php
    $filenames = glob("*-*-*.xml");
    if($page=="index")
        {
        echo "<ul>";
        $query = "SELECT Subject FROM Revision";
        $result = sqlite_query($database, $query);
        $subjects = array_unique(sqlite_fetch_array($result, SQLITE_NUM));
        foreach($subjects as $value) {
            echo "<li><a href=\"index.php?subject=" . $value . "\">" . $value . "</a></li>";
        }
        echo "</ul>";
    }
    if($page=="topic-index")
        {
        echo "<ul>";
        $query = "SELECT Topic FROM Revision";
        $result = sqlite_query($database, $query);
        $topics = array_unique(sqlite_fetch_array($result, SQLITE_NUM));
        foreach($topics as $value) {
            echo "<li><a href=\"index.php?subject=" . $_GET["subject"] . "&topic=" . $value . "\">" . $value . "</a></li>";
        }
        echo "</ul>";
    }
    if($page=="subtopic-index")
        {
        echo "<ul>";
        $query = "SELECT Subtopic FROM Revision";
        $result = sqlite_query($database, $query);
        $subtopics = array_unique(sqlite_fetch_array($result, SQLITE_NUM));
        foreach($subtopics as $value) {
            echo "<li><a href=\"index.php?subject=" . $_GET["subject"] . "&topic=" . $_GET["topic"] . "&subtopic=" . $value . "\">" . $value . "</a></li>";
        }
        echo "</ul>";
    }
    if($page=="notes") {
    }
    ?>
</body>
</html>