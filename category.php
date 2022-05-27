<?php
include('logincheck.php');
include("config/config.php");

$sql = "SELECT * FROM category";
$result = $conn->query($sql);

if (isset($_GET['delete'])) {
    $id_cate = $_GET['delete'];

    $sql = "SELECT * FROM category  where id_cate = $id_cate ";
    $items = $conn->query($sql);
    $items = $items->fetch_assoc();
    $target_dir = "./assets/image/";
    if (file_exists($target_dir . $items['image_category'])) {
        unlink($target_dir . $items['image_category']);
    }


    $sql = "DELETE FROM category WHERE id_cate = $id_cate";
    $conn->query($sql);
    header("Location: category.php");
}
include('config/head.php');
?>

<div class="secsquare">
	<p><b> Select Category </b> <a href="addcategory.php">add category</a></p>
	<hr>
	<?php
	while ($row = $result->fetch_assoc()) {
		echo '<div class="category"">
				<a href="items.php?category=' . $row['id_cate'] . '">
					<img src="./assets/image/' . $row['image_category'] . '" class="c2"></a>
					<a href="addcategory.php?category=' . $row['id_cate'] . '" class="btn-order">edit</a>
					<a onclick="return confirmation()" href="category.php?delete=' . $row['id_cate'] .'" class="btn-order">remove</a> 
				</div>';
	}

	?>

</div>
</div>

</div>

<script type="text/javascript">
        function confirmation() {
            return confirm('Are you sure you want to delete this category?');
        }
    </script>
</body>

</html>