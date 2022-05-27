<?php

include('config/config.php');
$searchValue = $_GET["search"];




$query = "SELECT * FROM items where item_name LIKE '%".$searchValue."%'";
$result = mysqli_query($conn, $query);


if($result)
{
    while($row = mysqli_fetch_array($result))
    {
        $data [] = $row;
    }
    echo json_encode($data);
}
else
{
    echo "something went wrong $searchValue";
}
?>