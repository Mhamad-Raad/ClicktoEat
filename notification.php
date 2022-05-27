<?php
include('logincheck.php');
include('config/config.php');
if (isset($_GET['decline'])) {
	$id = $_GET['decline'];
	$sql = "UPDATE invoice_items SET item_states='1' WHERE id_invo_item='$id'";
	$conn->query($sql);
}
if (isset($_GET['accept'])) {
	$id = $_GET['accept'];
	$sql = "UPDATE invoice_items SET item_states='0' WHERE id_invo_item='$id'";
	$conn->query($sql);
}

if (isset($_GET['cancel'])) {
	$tbl = $_SESSION['table'];
	$sql = "DELETE FROM invoice WHERE table_number = $tbl and states = 0";

	if ($conn->query($sql) === TRUE) {
	}
}
if (isset($_GET['done'])) {
	$id = $_GET['done'];
	$sql = "UPDATE invoice SET states = 1  WHERE id_invoice = '$id'";
	if ($conn->query($sql) === TRUE) {
		//"record updaa successfully";
		header("Location: notification.php");
	}
}
if (isset($_GET['show'])) {
	$id_invoice = $_GET['show'];
	$sql = "SELECT * FROM invoice inner join invoice_items on id_invoice = id_invoice_fk inner join items on id_item_fk = id_item where id_invoice = $id_invoice ";

	$shows = $conn->query($sql);
} else {
	$sql = "SELECT sum(number_order * price) as total_price,sum(number_order) as total_order,invoice.* FROM invoice inner join invoice_items on id_invoice = id_invoice_fk inner join items on id_item_fk = id_item where states = 0 group by id_invoice order by id_invoice desc";
	$items = $conn->query($sql);
}


function time_elapsed_string($datetime, $full = false)
{
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ago' : 'just now';
}

?>
<?php include('config/head.php');  ?>

<div class="c1">

	<p><b> Customer Order</b></p>
	<img src="./assets/image/lineyellow.png" class="lineimp">

	<div class="list-item ">
		<?php
		$total_price = 0;
		$states = 0;
		if (isset($items) and $items and $items->num_rows > 0) {

			while ($row = $items->fetch_assoc()) {
				$states = $row['states'];
				$type = ($row['type'] == 0) ? "Dine-in" : "Take-Awy";
				echo '<div class="list fullsize">
					
					<div class="list-row">
						<span class="left">Table' . $row['table_number'] . '</span>
						<span class="right">' . $row['total_price'] . ' $</span>
						<span class="right">' . $row['total_order'] . '  order </span>
					</div>
                <div class="list-row">
				<span>' . $type . ' </span><br>
				<span>' . time_elapsed_string($row['date']) . ' </span>';
				
				echo '<a  href="notification.php?show=' . $row['id_invoice'] . '" class="right btn-order">show</a>';
				echo '</div>
					</div>';
			}
		} elseif (isset($shows) and $shows and $shows->num_rows > 0) {
			$i = 0;
			$id_invoice = 0;
			while ($row = $shows->fetch_assoc()) {
				if ($i == 0) {
					$id_invoice = $row['id_invoice'];
					echo '<div class="list">
						<div class="list-row">
						<span class="left">Table ' . $row['table_number'] . '</span>
						<span class="right">' . time_elapsed_string($row['date']) . '</span>
						</div>
					</div>';
				}
				$i++;
				$all_price = ($row['item_states'] == 0)?$row['number_order'] * $row['price']:0;
				$total_price += $all_price;
				echo '<div class="list fullsize">
					<div class="list-row">
                    <span class="left">' . $row['item_name'] . '</span>
                    <span class="right">' . $all_price . ' $</span>
					</div>
					<div class="list-row">
                    <span>' . $row['gr'] . ' gr</span>
                    <span>' . $row['kcal'] . ' kcal</span>
                    <span class="right">' . $row['number_order'] . ' order ' . $row['price'] . ' $</span>
					</div>
                <div class="list-row">
				<span>' . $row['time_cook'] . ' min </span>';
				$btn = ($row['item_states'] == 1)?'accept':'decline';
				echo '<a onclick="return confirmation()" href="notification.php?'.$btn.'=' . $row['id_invo_item'] . '&&show='.$row['id_invoice_fk'].'" class="right btn-order">'.$btn.'</a>';

				echo '</div>
					</div>';
			}

			echo '<div class="list fullsize">
					<div class="list-row">
					<span class="left">totla price</span>
					<span class="right">' . $total_price . ' $</span>
					</div>
				</div>

				<div class="list fullsize">
					<div class="list-row">
					<a onclick="return confimdone()" href="notification.php?done=' . $id_invoice . '" class="btn-order">Done</a>
					<a href="notification.php" class="btn2 right">back</a>
					</div>
					
				</div>';
		}
		?>
	</div>
</div>


<a href="staffchoose.php">
	<div class="b1">
		<img src="./assets/image/back.png" class="l2">
	</div>
</a>

<script type="text/javascript">
	function confirmation() {
		return confirm('Are you sure you want to delete this item in your order ?');
	}

	function confimorder() {
		return confirm('Are you sure cancle your order ?');
	}

	function confimdone() {
		return confirm('Are you sure done order ?');
	}
</script>
</div>

<?php include('config/footer.php'); ?>