<?php
include("config/session.php");
include("config/config.php");

if (isset($_GET['item'])) {
  $itm = $_GET['item'];
  $sql = "SELECT * FROM category inner join items on id_cate = id_cate_fk where id_item = $itm";
  $item = $conn->query($sql);
  $item = $item->fetch_assoc();
  $table = $_SESSION['table'];

  if (isset($_POST['number'])) {
    $number = $_POST['number'];
    if(isset($_SESSION['id_invo'])){
      $id_invo = $_SESSION['id_invo'];
  
      $sql = "SELECT * FROM invoice inner join invoice_items on id_invoice = id_invoice_fk inner join items on id_item_fk = id_item where table_number = $table and id_invoice = $id_invo";
      $items = $conn->query($sql);
      if(isset($items)){
        while($row = $items->fetch_assoc()){
          $_SESSION['cart'][$table][$row['id_item']] = $row['number_order'];
        }
      }
  
      $sql = "DELETE FROM invoice WHERE table_number = $table and states = 0";
      $conn->query($sql);

    }


    $_SESSION['cart'][$table][$itm] = $number;
    header("Location: customermenu.php");
  }
} else {
  header("Location: customermenu.php");
}


include("config/headcustomer.php");
?>

<div class="mainorder">

  <?php
  if (sizeof($item) > 0) {
    $value = (isset($_SESSION['cart'][$_SESSION['table']][$item['id_item']])) ? $_SESSION['cart'][$_SESSION['table']][$item['id_item']] : null;
    echo '<img src="./assets/image/' . $item['image'] . '" class="main">
      
      
      <form method="post" action="">
      <span class="five"> ' . $item['price'] . ' $</span>
      <input type="number" value="' . $value . '" name="number" min="1" required placeholder=" -   1    + ">
      <button>add to cart</button>
      </form>
      <img src="./assets/image/pizzaing.png" class="ingredient">';
  }


  ?>
</div>
</body>

</html>