<?php
if(file_exists('db.sqlite')); else header( 'Location: add.html' );

    include('class.php')

    $page = new page();
    
    $database = new SQLiteDatabase('db.sqlite', 0666);
    
    function accessdb() {
    $query = "SELECT Subject, Topic, Subtopic, Notes FROM Revision";
    $result = $database->arrayQuery($query);
    $item = array();
    foreach($result as $value) {
        if($page->get_page()=="index") $item[] = $value[Subject];
        if($page->get_page()=="topic-index") if($value[Subject]==$_GET["subject"]) $item[] = $value[Topic];
        if($page->get_page()=="subtopic-index") if($value[Subject]==$_GET["subject"]) if($value[Topic]==$_GET["topic"]) $item[] = $value[Subtopic];
        if($page->get_page()=="notes") if($value[Subject]==$_GET["subject"]) if($value[Topic]==$_GET["topic"]) if($value[Subtopic]==$_GET["subtopic"]) $item[] = $value[Notes];
    }
    $item = array_unique($item);
    if($page->get_page()=="notes") echo $item[0]; else {
        echo "<ul>";
        foreach($item as $value) {
            echo "<li><a href=\"index.php?subject="; if($page->get_page()=="topic-index") echo $_GET["subject"]."&topic="; if($page->get_page()=="subtopic-index") echo $_GET["topic"]."&subtopic="; echo $value."\">".$value."</a></li>";
        }
        echo "</ul>";
    }
}
?>
<!doctype html>
<html>
<head>
    <title><?php if($page->get_page()=="index") echo "Subject Index"; elseif($page->get_page()=="topic-index") echo "Topic Index for " . $_GET["subject"]; elseif($page->get_page()=="subtopic-index") echo "Subtopic Index for " . $_GET["topic"]; elseif($page->get_page()=="notes") echo "Notes for " . $_GET["subtopic"]; ?></title>
</head>
<body>
    <h1><?php if($page=="index") echo "Subject Index"; elseif($page=="topic-index") echo "Topic Index for " . $_GET["subject"]; elseif($page=="subtopic-index") echo "Subtopic Index for " . $_GET["topic"]; elseif($page=="notes") echo "Notes for " . $_GET["subtopic"]; ?></h1>
    <?php
    accessdb();
    ?>
</body>
</html>