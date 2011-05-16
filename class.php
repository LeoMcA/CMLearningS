<?php
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
            if($this->page=="index") return $i;
            if($this->page=="topic-index") return $ti;
            if($this->page=="subtopic-index") return $sti;
            if($this->page=="notes") return $n;
        }
        
        function get_page() {
            return $this->page;
        }
    
    }
    
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
            echo $page->if_page(NULL,$_GET["subject"]."&topic=",$_GET["subject"]."&topic=".$_GET["topic"]."&subtopic=",NULL); 
            echo $value."\">".$value."</a></li>";
        }
        echo "</ul>";
    }
    }
?>