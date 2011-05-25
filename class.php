<?php
    class page {
        
        var $page;
        
        function set_page() {
            if($_GET['page']=='topics') $this->page = 't';
            elseif($_GET['page']=='subtopics') $this->page = 's';
            elseif($_GET['page']=='notes') $this->page = 'n';
            elseif($_GET['page']=='signup') $this->page = 'su';
            elseif($_GET['page']=='login') $this->page = 'li';
            elseif($_GET['page']=='logout') $this->page = 'lo';
            elseif($_GET['page']=='add') $this->page = 'a';
            elseif($_GET['page']=='edit') $this->page = 'e';
            else $this->page = "i";
        }
        
        function get_page() {
            $this->set_page();
            return $this->page;
        }
        
        function query_database($query) {
            global $database;
            global $page;
            return $database->arrayQuery($query);
        }
        
        function get_subjects() {
            $result = $this->query_database('SELECT Subject FROM Revision');
            $item = array();
            foreach($result as $value) {
                $item[] = $value['Subject'];
            }
            return array_unique($item);
        }
        
        function get_topics() {
            $result = $this->query_database('SELECT Subject, Topic FROM Revision');
            $item = array();
            foreach($result as $value) {
                if($value['Subject']==$_GET['subject']) {
                    $item[] = $value['Topic'];
                }
            }
            return array_unique($item);
        }
        
        function get_subtopics() {
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
        
        function get_notes() {
            $result = $this->query_database('SELECT Subject, Topic, Subtopic, Notes FROM Revision');
            foreach($result as $value) {
                if($value['Subject']==$_GET['subject']) {
                    if($value['Topic']==$_GET['topic']) {
                        if($value['Subtopic']==$_GET['subtopic']) {
                             return $value['Notes'];
                        }
                    }
                }
            }
        }
        
        function print_url($value) {
            printf('index.php?page=');
            if ($this->get_page()=='i') {
                printf("topics&subject=");
            }
            if ($this->get_page()=='t') {
                printf("subtopics&subject=%s&topic=",$_GET["subject"]);
            }
            if ($this->get_page()=='s') {
                printf("notes&subject=%s&topic=%s&subtopic=",$_GET["subject"],$_GET["topic"]);
            }
            printf('%s',$value);
        }
        
        function print_list($item) {
             foreach($item as $value) {
                printf('<li><a href="');
                $this->print_url($value);
                printf('">%s</a></li>',$value);
            }
        }
        
        function print_notes($item) {
            echo $item;
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
        
        function is_loggedin() {
            if(isset($_SESSION['user'])) return 'true';
            else return 'false';
        }
    }
?>