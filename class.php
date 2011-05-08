<?php
class page {
    
    var $page
    
    function set_page() {
        if($_GET["subject"]==NULL) $this->page = "index";
            elseif($_GET["topic"]==NULL) $this->page = "topic-index";
                elseif($_GET["subtopic"]==NULL) $this->page = "subtopic-index";
                    else $this->page = "notes";
    }
    
    function get_page() {
        return $this->page;
}

class database {
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
}
?>