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
            if($this->page = "index") return $i;
            if($this->page = "topic-index") return $ti;
            if($this->page = "subtopic-index") return $sti;
            if($this->page = "notes") return $n;
        }
        
        function get_page() {
            return $this->page;
        }
    
    }
?>