<?php
    if(file_exists('db.sqlite')); else header( 'Location: add.html' );

    include('class.php');

    $page = new page;
    
    $database = new SQLiteDatabase('db.sqlite', 0666);
?>
<!doctype html>
<html>
<head>
</head>
<body>
    <title style="display:block;"><?php echo $page->if_page("Subject Index","Topic Index for ".$_GET["subject"],"Subtopic Index for ".$_GET["topic"],"Notes for ".$_GET["subtopic"]); ?></title>
    <?php accessdb(); ?>
</body>
</html>