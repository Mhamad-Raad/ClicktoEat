<?php
include('logincheck.php');
include("config/config.php");

$sql = "SELECT * FROM category";
$category = $conn->query($sql);
$cate = '';
if (isset($_GET['category'])) {
    $cate = $_GET['category'];

    $sql = "SELECT * FROM category inner join items on id_cate = id_cate_fk where id_cate = $cate order by id_item desc";
    $items = $conn->query($sql);
}
if (isset($_GET['delete']) and isset($_GET['category'])) {
    $cate = $_GET['category'];
    $id_item = $_GET['delete'];

    $sql = "SELECT * FROM items  where id_item = $id_item ";
    $items = $conn->query($sql);
    $items = $items->fetch_assoc();
    $target_dir = "./assets/image/";
    if (file_exists($target_dir . $items['image'])) {
        unlink($target_dir . $items['image']);
    }


    $sql = "DELETE FROM items WHERE id_item = $id_item";
    $conn->query($sql);
    header("Location: items.php?category=$cate");
}

include('config/head.php'); 

?>


        <div class="categorys">
            <?php
            while ($row = $category->fetch_assoc()) {
                echo '<div class="cate">
				<a href="items.php?category=' . $row['id_cate'] . '">
                <img src="./assets/image/' . $row['image_category'] . '"></a>
                </div>';
            }

            ?>
            <img src="./assets/image/line.png">
        </div>
        <div class="categorysa">
            <a class="add" href="infoadditem.php?add=<?= $cate ?>">
                <img src="./assets/image/add.png" class="add">
            </a>

        </div>

        <div class="list-item">
            <?php
            while ($row = $items->fetch_assoc()) {
                echo '<div class="list">

                <img class="item-image" src="./assets/image/' . $row['image'] . '">
                <div class="list-row">
                    <span class="left">' . $row['item_name'] . '</span>
                    <span class="right">' . $row['price'] . ' $</span>
                </div>
                <div class="list-row">
                    <span>' . $row['gr'] . ' gr</span>
                    <span>' . $row['kcal'] . ' kcal</span>
                </div>
                <div class="list-row">
                    <span>' . $row['time_cook'] . ' min</span>
                    <a onclick="return confirmation()" href="items.php?category=' . $row['id_cate'] . '&&delete=' . $row['id_item'] . '" class="right">remove</a> 
                     <a href="infoadditem.php?add=' . $cate . '&&item=' . $row['id_item'] . '" class="right">edit</a>
                </div>
				<a href="items.php?category=' . $row['id_cate'] . '">
                </a>
                </div>';
            }

            ?>
        </div>

    </div>

    <script type="text/javascript">
        function confirmation() {
            return confirm('Are you sure you want to delete this item?');
        }
    </script>

</body>

</html>