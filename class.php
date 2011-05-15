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
        
        function ifecho_page($i,$ti,$sti,$n) {
            if($this->page = "index") echo $i;
            if($this->page = "topic-index") echo $ti;
            if($this->page = "subtopic-index") echo $sti;
            if($this->page = "notes") echo $n;
        }
        
        function get_page() {
            return $this->page;
        }
    
    }
?>