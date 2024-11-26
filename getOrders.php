<?php

require_once 'db.php';

$order_data = getOrders();
echo json_encode($order_data);

?>