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
    
    class title {
        
        var $title;
        
        function get_title() {
            global $page;
            return $page->if_page("Subject Index","Topic Index for ".$_GET["subject"],"Subtopic Index for ".$_GET["topic"],"Notes for ".$_GET["subtopic"]);
        }
        
    }
    
    class user {
        
        function set_user() {
            global $database;
            $query = 'CREATE TABLE user (username TEXT, hash TEXT);';
            $database->queryExec($query);
            $hash = sha1($_POST['password']);
            $query = 'INSERT INTO user (username, hash) VALUES ('.$_POST['username'].', \''.$hash.'\');';
            $database->queryExec($query);
        }
        
        function get_user() {
            global $database;
            $hash = sha1($_POST['password']);
            $query = 'SELECT username FROM user WHERE username = '.$_POST['username'].' AND hash = '.$hash.';';
            $result = $database->query($query);
            if ($result->numRows() < 1) {
    /* Access denied */
    echo 'Sorry, your username or password was incorrect!';
            }
            else {
    /* Log user in */
    printf('Welcome back %s!', $_POST['username']);
            }
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