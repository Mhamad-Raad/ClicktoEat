<!DOCTYPE html>
<html>

<head>
    <title>Clic to Eat</title>
    <link rel="stylesheet" href = "./assets/css/style.css">
</head>
<body>
<?php
if(true){
    echo "<div class='adminpanel'>
    <a class='admin-btn' href='customerchoose.php'>Home</a> <a class='admin-btn' href='customermenu.php'>Menu</a>
    <a class='admin-btn' href='checkorder.php'>check order</a>
    <a class='admin-btn' href='orderplaced.php'>my cart</a>
    <a class='admin-btn' href='search.php'>Search</a>
    </div>";
} else {
    header("Location: customerchoosetable.php");
}
?>
    <div class="square">
        <img src="./assets/image/pic.png">