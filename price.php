<?php

include "conn.php";
if (isset($_GET["min_price"])) {
    $statement = $db->prepare("SELECT items.name, price, quantity, quality FROM items WHERE price between ? and ?");
    $statement->execute([$_GET["min_price"], $_GET["max_price"]]);
    $data = $statement->fetchAll();
    echo json_encode($data);
}
?>
