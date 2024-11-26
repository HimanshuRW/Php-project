<?php

$con = mysqli_connect("localhost", "root", "", "restaurant");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

function getItemsByids($ids)
{
    global $con;
    $items = [];
    $query = "SELECT * FROM items WHERE id IN ($ids)";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }
    return $items;
}

function addNewItem($name, $price, $description, $section)
{
    global $con;
    $query = "INSERT INTO items (name, price, description, section) VALUES ('$name', $price, '$description', '$section')";
    echo $query;
    if (mysqli_query($con, $query)) {
        return true;
    } else {
        return false;
    }
}


function updateItem($id, $name, $price, $description, $section)
{
    global $con;
    $query = "UPDATE items SET name='$name', price=$price, description='$description', section='$section' WHERE id=$id";
    echo $query;
    if (mysqli_query($con, $query)) {
        return true;
    } else {
        return false;
    }
}

function deleteItem($id)
{
    global $con;
    $query = "DELETE FROM items WHERE id=$id";
    echo $query;
    if (mysqli_query($con, $query)) {
        return true;
    } else {
        return false;
    }
}


function getOrders(){
    global $con;
    $sql = "SELECT o.order_id, i.name AS item_name, oi.quantity FROM orders o JOIN order_items oi ON o.order_id = oi.order_id JOIN items i ON oi.item_id = i.id WHERE o.status = 'pending';";
    $result = $con->query($sql);
    $orders = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }
    return $orders;
}
?>