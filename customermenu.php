<?php

include("config/session.php");
include("config/config.php");

$sql = "SELECT * FROM category";
$result = $conn->query($sql);

include("config/headcustomer.php");
?>
		<div class="secsquare">
			<p><b> Select Category </b> <a href="orderplaced.php">Cart order</a></p>
			<hr>

			<?php
			while($row = $result->fetch_assoc()){
				echo '<div class="category" style="height: 90px">
				<a href="customeritem.php?category='.$row['id_cate'].'">
					<img src="./assets/image/'.$row['image_category'].'" class="c2"></a>
			</div>';
			}

			?>

		</div>

	</div>

</body>

</html>