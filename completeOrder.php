<?php
include 'db.php';

$ids = $_POST['ids'];
$sql = "UPDATE orders SET status = 'completed' WHERE order_id=$ids";
if ($con->query($sql) === TRUE) {
    echo "Order completed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
?>