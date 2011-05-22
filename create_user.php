<?php
include('class.php');
$database = new SQLiteDatabase('db.sqlite', 0666);
$user = new user;
$user->set_user();
header( 'Location: index.php' )
?>