<?php
include('logincheck.php');  
include("config/config.php");
$cate = $_GET['add'] ?? '';

$id_cate = null;
$category = null;

$image = null;
if (isset($_GET['category'])) {
	$cate = $_GET['category'];
	$sql = "SELECT * FROM category where  id_cate = $cate";
	$cate = $conn->query($sql);
	$cate = $cate->fetch_assoc();
// var_dump($category);
// die();
	$id_cate = $cate['id_cate'];
	$category = $cate['category'];
	$image = $cate['image_category'];
}

if (isset($_POST['category'])) {
	$target_dir = "./assets/image/";
	$old_image = $_POST['old_image'];
	$image_category = $old_image;
	if(isset($_FILES["image_category"]["name"]) and $_FILES["image_category"]["name"] != ''){
		$target_file = $target_dir . basename($_FILES["image_category"]["name"]);
	
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$image_category = time() . '.' . $imageFileType;
		move_uploaded_file($_FILES["image_category"]["tmp_name"], $target_dir . $image_category);

		if($old_image != '' and file_exists($target_dir.$old_image)){
			unlink($target_dir.$old_image);
		}
	}



	$id_cate = $_POST['id_cate'];
	$category = $_POST['category'];

   	

	if($id_cate != ''){ // update
		$sql = "UPDATE category SET category='$category',image_category='$image_category' WHERE id_cate='$id_cate'";
		if ($conn->query($sql) === TRUE) {
			//   echo "New record updaa successfully";
			header("Location: category.php");
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	} else { // insert
		$sql = "INSERT INTO category (category,image_category) VALUES ('$category','$image_category')";
        
		if ($conn->query($sql) === TRUE) {
			//   echo "New record created successfully";
			header("Location: category.php");
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

	}

}
$require = ($id_cate != "")? '': 'required';

include('config/head.php'); 
?>
		<div class="secsquare">
			<form action="addcategory.php" enctype="multipart/form-data" method="post">

				<input type="hidden" name="id_cate" value="<?= $id_cate ?>">
				<p><b> Please enter the information needed below: </b> </p>
				<hr>

				<p>what's the category name?</p> <input type="text" class="underline" name="category" placeholder="Item name Here" value="<?= $category ?>" required>

				<p>Image</p>
				<input class="underline" <?=$require?> type="file" name="image_category">
				<input type="hidden" name="old_image" value="<?= $image ?>">
				<img class="old-image" src="./assets/image/<?= $image ?>" alt="">
				<br>
				<button type="submit" class="b"> OK </button>
			</form>
		</div>
</body>

</html>