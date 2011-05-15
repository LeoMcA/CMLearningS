<?php
    if(file_exists('db.sqlite')); else header( 'Location: add.html' );

    include('class.php');

    $page = new page;
    
    $database = new SQLiteDatabase('db.sqlite', 0666);
    
    function accessdb() {
    global $database;
    global $page;
    $query = "SELECT Subject, Topic, Subtopic, Notes FROM Revision";
    $result = $database->arrayQuery($query);
    $item = array();
    foreach($result as $value) {
        if($page->get_page()=="index") {
            $item[] = $value[Subject];
        }
        if($page->get_page()=="topic-index") {
            if($value[Subject]==$_GET["subject"]) {
                $item[] = $value[Topic];
            }
        }
        if($page->get_page()=="subtopic-index") {
            if($value[Subject]==$_GET["subject"]) {
                if($value[Topic]==$_GET["topic"]) {
                    $item[] = $value[Subtopic];
                }
            }
        }
        if($page->get_page()=="notes") {
            if($value[Subject]==$_GET["subject"]) {
                if($value[Topic]==$_GET["topic"]) {
                    if($value[Subtopic]==$_GET["subtopic"]) {
                        $item[] = $value[Notes];
                    }
                }
            }
        }
    }
    $item = array_unique($item);
    if($page->get_page()=="notes") {
        echo $item[0];
    }
    else {
        echo "<ul>";
        foreach($item as $value) {
            echo "<li><a href=\"index.php?subject=";
            echo $page->if_page('',$_GET["subject"]."&topic=",$_GET["subject"]."&topic=".$_GET["topic"]."&subtopic="); 
            echo $value."\">".$value."</a></li>";
        }
        echo "</ul>";
    }
}
?>
<!doctype html>
<html>
<head>
</head>
<body>
    <title style="display:inline;"><?php echo $page->if_page("Subject Index","Topic Index for ".$_GET["subject"],"Subtopic Index for ".$_GET["topic"],"Notes for ".$_GET["subtopic"]); ?></title>
    <?php
    accessdb();
    ?>
</body>
</html>