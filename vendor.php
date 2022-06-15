
<?php

include "conn.php";
if (isset($_GET["vendor"])) {
    $statement = $db->prepare("SELECT items.name, price, quantity, quality FROM items inner join vendors on FID_Vender = ID_Vendors WHERE Vendors.name=?"); // подготовленный запрос
    $statement->execute([$_GET["vendor"]]);
    while ($data = $statement->fetch()) {
        echo " <br> Name: {$data['name']}  <br>Price: {$data['price']}  <br>Quantity: {$data['quantity']}  <br>Quality: {$data['quality']}<hr> ";
    }
}
?>
