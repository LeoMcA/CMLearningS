<?php
    class page {
        
        var $page;
        
        function __construct() {
            $this->set_page();
        }
        
        function set_page() {
            if($_GET['page']=='topics') $this->page = 't';
            if($_GET['page']=='subtopics') $this->page = 's';
            if($_GET['page']=='notes') $this->page = 'n';
            if($_GET['page']=='signup') $this->page = 'su';
            if($_GET['page']=='login') $this->page = 'li';
            if($_GET['page']=='logout') $this->page = 'lo';
            if($_GET['page']=='add') $this->page = 'a';
            if($_GET['page']=='edit') $this->page = 'e';
            else $this->page = "i";
        }
        
        function get_page() {
            return $this->page;
        }
    
    }
    
    class user {
        
        function set_user() {
            global $database;
            $query = 'CREATE TABLE user (username TEXT, hash TEXT);';
            $database->queryExec($query);
            $hash = sha1($_POST['password']);
            $query = "INSERT INTO user (username, hash) VALUES ('".$_POST['username']."', '".$hash."');";
            $database->queryExec($query);
        }
        
        function get_user() {
            global $database;
            $hash = sha1($_POST['password']);
            $query = "SELECT username FROM user WHERE username = '".$_POST['username']."' AND hash = '".$hash."';";
            $result = $database->query($query);
            if ($result->numRows() < 1) {
                return 'false';
            }
            else {
                return $result->fetch();
            }
        }
    }
    
    class notes {
        
        query_database($query) {
            global $database;
            global $page;
            return $database->arrayQuery($query);
        
        get_subjects() {
            $result = $this->query_database('SELECT Subject FROM Revision');
            $item = array();
            foreach($result as $value) {
                $item[] = $value['Subject'];
            }
            return array_unique($item);
        }
        
        get_topics() {
            $result = $this->query_database('SELECT Subject, Topic FROM Revision');
            $item = array();
            foreach($result as $value) {
                if($value['Subject']==$_GET['subject']) {
                    $item[] = $value['Topic'];
                }
            }
            return array_unique($item);
        }
        
        get_subtopics() {
            $result = $this->query_database('SELECT Subject, Topic, Subtopic FROM Revision');
            $item = array();
            foreach($result as $value) {
                if($value['Subject']==$_GET['subject']) {
                    if($value['Topic']==$_GET['topic']) {
                        $item[] = $value['Subtopic'];
                    }
                }
            }
            return array_unique($item);
        }
        
        get_notes() {
            $result = $this->query_database('SELECT Subject, Topic, Subtopic, Notes FROM Revision');
            if($result['Subject']==$_GET['subject']) {
                if($result['Topic']==$_GET['topic']) {
                    if($result['Subtopic']==$_GET['subtopic']) {
                        return $value[Notes];
                    }
                }
            }
        }
            
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