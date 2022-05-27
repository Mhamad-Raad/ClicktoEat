<?php
include('logincheck.php');

include("config/config.php");
$cate = $_GET['add'] ?? '';

$id_item = null;
$item_name = null;
$gr = null;
$kcal = null;
$size = null;
$time_cook = null;
$price = null;
$image = null;
if (isset($_GET['item'])) {
	$itm = $_GET['item'];
	$sql = "SELECT * FROM category inner join items on id_cate = id_cate_fk where id_item = $itm";
	$item = $conn->query($sql);
	$item = $item->fetch_assoc();

	$id_item = $item['id_item'];
	$item_name = $item['item_name'];
	$gr = $item['gr'];
	$kcal = $item['kcal'];
	$size = $item['size'];
	$time_cook = $item['time_cook'];
	$price = $item['price'];
	$image = $item['image'];
}

if (isset($_POST['item_name'])) {
	$target_dir = "./assets/image/";
	$old_image = $_POST['old_image'];
	$item_image = $old_image;
	// var_dump($old_image);
	// die();

	if(isset($_FILES["item_image"]["name"]) and $_FILES["item_image"]["size"] > 0){
		$target_file = $target_dir . basename($_FILES["item_image"]["name"]);
	
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$item_image = time() . '.' . $imageFileType;
		move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_dir . $item_image);

		if($old_image != '' and file_exists($target_dir.$old_image)){
			unlink($target_dir.$old_image);
		}
	}



	$id_item = $_POST['id_item'];
	$item_name = $_POST['item_name'];
	$gr = $_POST['gr'];
	$kcal = $_POST['kcal'];
	$size = $_POST['size'];
	$time_cook = $_POST['time_cook'];
	$price = $_POST['price'];
	$id_cate_fk = $_POST['id_cate_fk'];

	if($id_item != ''){ // update
		$sql = "UPDATE items SET item_name='$item_name',gr='$gr',kcal='$kcal',size='$size',time_cook='$time_cook',price='$price',image='$item_image' WHERE id_item='$id_item'";
		if ($conn->query($sql) === TRUE) {
			//   echo "New record updaa successfully";
			header("Location: items.php?category=$id_cate_fk");
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	} else { // insert
		$sql = "INSERT INTO items (item_name, gr, kcal,size,time_cook,price,id_cate_fk,image)
	VALUES ('$item_name', '$gr', '$kcal','$size','$time_cook','$price','$id_cate_fk','$item_image')";
	
		if ($conn->query($sql) === TRUE) {
			//   echo "New record created successfully";
			header("Location: items.php?category=$id_cate_fk");
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

	}

}
$require = ($id_item != "")? '': 'required';

include('config/head.php');
?>


		<div class="secsquare">
			<form action="infoadditem.php" enctype="multipart/form-data" method="post">

				<input type="hidden" name="id_cate_fk" value="<?= $cate ?>">
				<input type="hidden" name="id_item" value="<?= $id_item ?>">
				<p><b> Please enter the information needed below: </b> </p>
				<hr>

				<p>what's the item name?</p> <input type="text" class="underline" name="item_name" placeholder="Item name Here" value="<?= $item_name ?>" required>

				<p>what's the item calories?</p> <input type="text" value="<?= $kcal ?>" class="underline" name="kcal" placeholder="Item calories Here" required>
				<p>what's the item gr?</p> <input type="text" value="<?= $gr ?>" class="underline" name="gr" placeholder="Item gr Here" required>
				<p>what's the item size?</p> <input type="text" value="<?= $size ?>" class="underline" name="size" placeholder="Item size Here" required>

				<p>within what range of time the item can be delievered?</p> <input type="text" class="underline" value="<?= $time_cook ?>" name="time_cook" placeholder="Item delivery time Here" required>

				<p>what's the price of the item added?</p> <input type="text" value="<?= $price ?>" class="underline" name="price" placeholder="Item price Here" required>

				<p>Image</p>
				<input class="underline" <?=$require?> type="file" name="item_image">
				<input type="hidden" name="old_image" value="<?= $image ?>">
				<img class="old-image" src="./assets/image/<?= $image ?>" alt="">
				<br>
				<button type="submit" class="b"> OK </button>
			</form>
		</div>
</body>

</html>