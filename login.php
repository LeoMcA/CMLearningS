<?php
include('class.php');
$database = new SQLiteDatabase('db.sqlite', 0666);
$user = new user;
if($user->get_user()=='false') {
    echo 'user dosdf exist';
}
else {
    session_start();
    $username = $user->get_user();
    $_SESSION['user'] = $username[0];
}
?>