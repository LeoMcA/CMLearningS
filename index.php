<?php
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
        foreach($filenames as $value) {
            $filename = explode("-",$value);
            $subjects[] = $filename[0];
        }
        $subjects_unique = array_unique($subjects);
        foreach($subjects_unique as $value) {
            echo "<li><a href=\"index.php?subject=" . $value . "\">" . $value . "</a></li>";
        }
        echo "</ul>";
    }
    if($page=="topic-index")
        {
        echo "<ul>";
        foreach($filenames as $value) {
            $filename = explode("-",$value);
            if($_GET["subject"]==$filename[0]) $topics[] = $filename[1];
        }
        $topics_unique = array_unique($topics);
        foreach($topics_unique as $value) {
            echo "<li><a href=\"index.html?subject=" . $_GET["subject"] . "&topic=" . $value . "\">" . $value . "</a></li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>