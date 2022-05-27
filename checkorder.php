<?php
include('config/session.php');
include('config/config.php');
if(isset($_GET['remove'])){
	$id = $_GET['remove'];
	$sql = "DELETE FROM invoice_items WHERE id_item_fk = $id";
	$conn->query($sql);
}
if(isset($_GET['cancel'])){
	$tbl = $_SESSION['table'];
	$sql = "DELETE FROM invoice WHERE table_number = $tbl and states = 0";

    if ($conn->query($sql) === TRUE) {
	}
}
if(isset($_SESSION['table']) and isset($_SESSION['id_invo'])){

	$table = $_SESSION['table'];
	$id_invo = $_SESSION['id_invo'];

	$sql = "SELECT * FROM invoice inner join invoice_items on id_invoice = id_invoice_fk inner join items on id_item_fk = id_item where table_number = $table and id_invoice = $id_invo";
    $items = $conn->query($sql);

}


include('config/headcustomer.php');
?>

		<div class="c1">

			<p><b> Your Order</b></p>
			<img src="./assets/image/lineyellow.png" class="lineimp">

		<div class="list-item">
            <?php
			$total_price = 0;
            $states = 0;
			if(isset($items) and $items and $items->num_rows > 0){

				while ($row = $items->fetch_assoc()) {
                    $states = $row['states'];
					$st = ($row['item_states'] == 0)?'':"( declined )";
					$all_price = ($row['item_states'] == 0)?$row['number_order'] * $row['price']:0;
					$total_price += $all_price;
					echo '<div class="list">

					<img class="item-image" src="./assets/image/' . $row['image'] . '">
					<div class="list-row">
                    <span class="left">' . $row['item_name'] .' '.$st . '</span>
                    <span class="right">' . $all_price . ' $</span>
					</div>
					<div class="list-row">
                    <span>' . $row['gr'] . ' gr</span>
                    <span>' . $row['kcal'] . ' kcal</span>
                    <span class="right">'.$row['number_order'].' order '.$row['price'].' $</span>
					</div>
                <div class="list-row">
				<span>' . $row['time_cook'] . ' min </span>';
                if($row['states'] == 0 and $items->num_rows > 1){
                    echo '<a onclick="return confirmation()" href="checkorder.php?remove=' . $row['id_item'] . '" class="right btn-order">remove</a>';

                }

					echo '</div>
					</div>';
				}
				echo '<div class="list">
				<img class="item-image" src="./assets/image/1624025561.png" alt=" ">
				<div class="list-row">
				<span class="left">totla price</span>
				<span class="right">' . $total_price . ' $</span>
                </div>';
                    if($states == 0){
                        echo '<a class="btn-order" onclick="return confimorder()" href="checkorder.php?cancel=1">Cancle Order</a>';

                    } else {
                        echo '<h2>Your order is done</h2>';
                    }
                    echo '</div>';
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
		<a href="customerchoose.php">
			<div class="b1">
				<img src="./assets/image/back.png" class="l2">
			</div>
		</a>
		</div>



		<script type="text/javascript">
        function confirmation() {
            return confirm('Are you sure you want to delete this item in your order ?');
        }
		function confimorder() {
            return confirm('Are you sure cancle your order ?');
        }
    </script>



</body>

</html>
