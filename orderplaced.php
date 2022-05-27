<?php
include('config/session.php');
include('config/config.php');
if(isset($_GET['remove']) and isset($_SESSION['cart'][$_SESSION['table']][$_GET['remove']])){
	unset($_SESSION['cart'][$_SESSION['table']][$_GET['remove']]);
}

if(isset($_SESSION['cart'])){

	$id_cart = $_SESSION['cart'][$_SESSION['table']];
	if(isset($_GET['type'])){
		var_dump($_SESSION);
		$date = date('Y-m-d H:i:s');
		$table_number = $_SESSION['table'];
		$type = $_GET['type'];
		$sql = "INSERT INTO invoice (date,table_number,type) VALUES ('$date','$table_number','$type')";

		if ($conn->query($sql) === TRUE) {
			//   echo "New record created successfully";
			$id_invoice = $conn->insert_id;
			$_SESSION['id_invo'] = $id_invoice;
			foreach($id_cart as $key => $val){
				$sql = "INSERT INTO invoice_items (id_item_fk,number_order,id_invoice_fk) VALUES ('$key','$val','$id_invoice')";
				$conn->query($sql);
			}
			unset($_SESSION['cart']);
			header("Location: checkorder.php");
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}


	$ids = array_keys($id_cart);
	$ids = implode(",",$ids);

	$sql = "SELECT * FROM category inner join items on id_cate = id_cate_fk where id_item in($ids) order by id_item desc";
    $items = $conn->query($sql);

}

include('config/headcustomer.php');

?>


		<div class="c1">

			<p><b> Your Order</b></p>
			<img src="./assets/image/line.png" class="lineimp">

		<div class="list-item">
            <?php
			$total_price = 0;
			if(isset($items) and $items and $items->num_rows > 0){

				while ($row = $items->fetch_assoc()) {
					$all_price = $id_cart[$row['id_item']] * $row['price'];
					$total_price += $all_price;
					echo '<div class="list">

					 <img class="item-image" src="./assets/image/' . $row['image'] . '">
					<div class="list-row">
                    <span class="left">' . $row['item_name'] . '</span>
                    <span class="right">' . $all_price . ' $</span>
					</div>
					<div class="list-row">
                    <span>' . $row['gr'] . ' gr</span>
                    <span>' . $row['kcal'] . ' kcal</span>
					<span class="right">'.$id_cart[$row['id_item']].' order</span>
					</div>
                <div class="list-row">
				<span>' . $row['time_cook'] . ' min</span>
					<a onclick="return confirmation()" href="orderplaced.php?remove=' . $row['id_item'] . '" class="right btn-order">remove</a>
					<a href="infoitemorder.php?item=' . $row['id_item'] . '" class="right btn-order">edit</a>
					</div>
					</div>';
				}
				echo '<div class="list">
				<img class="item-image" src="" alt=" ">
				<div class="list-row">
				<span class="left">totla price</span>
				<span class="right">' . $total_price . ' $</span>
                </div>
				<a class="btn-order" onclick="return confimorder()" href="orderplaced.php?type=0">Dine-In</a>
				<a class="btn-order" onclick="return confimorder()" href="orderplaced.php?type=1">Take-Away</a>
				</div>';
			} else {
				echo '<div class="list11">
				<img class="item-image" src="./assets/image/1624025561.png" alt=" ">
				<div class="list-row">
				<h2 class="left">your cart is empty</h2>
				<a href="customermenu.php">Back to Menu</a>
                </div>
				</div>';
			}
            ?>
        </div>
		</div>



		<script type="text/javascript">
        function confirmation() {
            return confirm('Are you sure you want to delete this item in your order ?');
        }
		function confimorder() {
            return confirm('Are you sure send order ?');
        }
    </script>



</body>

</html>
