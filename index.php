<?php
    if(file_exists('db.sqlite')); else header( 'Location: add.html' );

    include('class.php');

    $page = new page;
    
    $database = new SQLiteDatabase('db.sqlite', 0666);
?>
<!doctype html>
<html>
<head>
    <script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
    <title><?php $title = new title; echo $title->get_title(); ?></title>
</head>
<body>
    <h1><?php $title = new title; echo $title->get_title(); ?></h1>
    <?php accessdb(); ?>
</body>
</html>