<?php
include('class.php');
$database = new SQLiteDatabase('db.sqlite', 0666);
$user = new user;
$user->get_user();
?>