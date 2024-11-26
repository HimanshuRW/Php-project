<?php
include 'db.php';

$ids_array = $_POST['ids'];
$items = getItemsByids($ids_array);
echo json_encode($items);

?>