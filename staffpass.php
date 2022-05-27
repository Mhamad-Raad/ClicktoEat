<?php
include("config/session.php");
include("config/config.php");
$msg = "";
if(isset($_POST['password'])){
	$password = addslashes(trim($_POST['password']));
	$sql = "SELECT * FROM config where id = 1 and password = md5($password)";
	$result = $conn->query($sql);
	$result = $result->fetch_assoc();
	if(isset($result['id'])){
		// echo "successfully";
		$_SESSION['login'] = true;
		header('Location: staffchoose.php');
	} else {
		$msg = "try agin";
	}
	
}
include("config/head.php");

?>

		<img class="i" src="./assets/image/copy_967522286 (1).png">
		<div class="secsquare">
			<p><b> Login as</b></p>
			<hr>
			<?=$msg?>
			<form action="staffpass.php" method="post">
				<input type="Password" class="underline" name="password" placeholder="password" required>

				<!-- <a href="staffchoose.php"></a> -->
				<input class="b" type="submit" value="Login">

			</form>
		</div>
	</div>

</body>

</html>