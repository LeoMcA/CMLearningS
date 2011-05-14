<?php
<<<<<<< HEAD
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
    
    var $table;
    var $database;
    
    function set_database($db) {
        $this->database = sqlite_open($db, 0666, $error);
    }
    
    function get_database() {
        return $this->database;
    }
    
    function set_table($table_name, $col_name) {
        $query = 'CREATE TABLE' . $table_name;
        sqlite_query($this->database, $query);
    }
    
    function get_table() {
    }
    
    function set_column() {
        $query = 'ALTER TABLE' . $table_name . 'ADD COLUMN' . $col_name;
        sqlite_query($this->database, $query);
    }
    
    function get_column() {
    }
    
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
    
}
=======
    class page {
        
        var $page;
        
        function __construct() {
            if($_GET["subject"]==NULL) $this->page = "index";
            elseif($_GET["topic"]==NULL) $this->page = "topic-index";
            elseif($_GET["subtopic"]==NULL) $this->page = "subtopic-index";
            else $this->page = "notes";
        }
        
        function set_page() {
            if($_GET["subject"]==NULL) $this->page = "index";
            elseif($_GET["topic"]==NULL) $this->page = "topic-index";
            elseif($_GET["subtopic"]==NULL) $this->page = "subtopic-index";
            else $this->page = "notes";
        }
        
        function if_page($i,$ti,$sti,$n) {
            if($this->page = "index") $i;
            if($this->page = "topic-index") $ti;
            if($this->page = "subtopic-index") $sti;
            if($this->page = "notes") $n;
        }
        
        function get_page() {
            return $this->page;
        }
    
    }
>>>>>>> oodb
?>