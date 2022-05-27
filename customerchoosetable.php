<?php

include("config/session.php");
include("config/config.php");

if (isset($_GET['table'])) {
	
	$_SESSION['table'] = $_GET['table'];
    header("Location: customerchoose.php");
	
} else {
	// header("Location: customerchoosetable.php");
}

include("config/head.php");
?>

		<img class="i" src="./assets/image/copy_967522286 (1).png">
		<div class="secsquare">
			<p><b> choose table </b></p>
			<hr>
			<br>

			<a class="btn-order" href="customerchoosetable.php?table=1">Table 1</a>
			<a class="btn-order" href="customerchoosetable.php?table=2">Table 2</a>
			<a class="btn-order" href="customerchoosetable.php?table=3">Table 3</a>
			<a class="btn-order" href="customerchoosetable.php?table=4">Table 4</a>
			<a class="btn-order" href="customerchoosetable.php?table=5">Table 5</a>
		</div>

	</div>
</body>

</html>