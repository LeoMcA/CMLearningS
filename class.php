<?php
class page {
    
    var $page;
    
    function get_page() {
        if($_GET["subject"]==NULL) $this->page = "index";
        if($_GET["topic"]==NULL) $this->page = "topic-index";
        if($_GET["subtopic"]==NULL) $this->page = "subtopic-index";
            else $this->page = "notes";
    }
    
    function return_page() {
        return $this->page;
    }
    
}

class database {
    
    var $database
    
    function set_database() {
        $db = sqlite_open('db.sqlite', 0666, $error);
        $query = 'CREATE TABLE Revision' . '(Subject TEXT, Topic TEXT, Subtopic TEXT, Notes TEXT)';
        sqlite_query($database, $query);
        $query = 'INSERT INTO Revision (Subject, Topic, Subtopic, Notes) VALUES ("' . $_POST["subject"] . '", "' . $_POST["topic"] . '", "' . $_POST["subtopic"] . '", "' . $_POST["notes"] . '");';
        sqlite_query($database, $query);
    }
    
    function get_database() {
        $page = new page();
        $query = "SELECT Subject, Topic, Subtopic, Notes FROM Revision";
        $result = sqlite_array_query(sqlite_open('db.sqlite', 0666, $error), $query);
        $item = array();
        foreach($result as $value) {
            if($page->return_page()=="index") $item[] = $value[Subject];
            if($page->return_page()=="topic-index") if($value[Subject]==$_GET["subject"]) $item[] = $value[Topic];
            if($page->return_page()=="subtopic-index") if($value[Subject]==$_GET["subject"]) if($value[Topic]==$_GET["topic"]) $item[] = $value[Subtopic];
            if($page->return_page()=="notes") if($value[Subject]==$_GET["subject"]) if($value[Topic]==$_GET["topic"]) if($value[Subtopic]==$_GET["subtopic"]) $item[] = $value[Notes];
        }
        $item = array_unique($item);
        if($page->return_page()=="notes") echo $item[0]; else {
            echo "<ul>";
            foreach($item as $value) {
                echo "<li><a href=\"index.php?subject="; if($page->return_page()=="topic-index") echo $_GET["subject"]."&topic="; if($page->return_page()=="subtopic-index") echo $_GET["topic"]."&subtopic="; echo $value."\">".$value."</a></li>";
            }
            echo "</ul>";
        }
        
    }
    
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