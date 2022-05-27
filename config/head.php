<!DOCTYPE html>
<html>

<head>
    <title>menu</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
<?php
if(isset($_SESSION['login'])){
    echo "<div class='adminpanel'>
    <a class='admin-btn' href='logout.php'>Logout</a> <a class='admin-btn' href='notification.php'>Notification</a> <a class='admin-btn' href='category.php'>Category</a> <a class='admin-btn' href='orderdone.php'>Order done</a> <a class='admin-btn' href='staffchoose.php'>Home</a>
    </div>";
}
?>
    <div class="square">
        <img src="./assets/image/pic.png">