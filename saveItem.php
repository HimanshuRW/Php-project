<?php
include 'db.php';
$item_id = $_POST['id'];
$item_name = $_POST['name'];
$item_price = $_POST['price'];
$item_description = $_POST['description'];
$item_category = $_POST['category'];
$delete_id = $_POST['delete_id'];

if($item_id){
    echo "update - item : ";
    updateItem($item_id, $item_name, $item_price, $item_description,  $item_category);
} else if($delete_id){
    echo "delete - item : ";
    deleteItem($delete_id);
} else {
    echo "add - item : ";
    addNewItem($item_name, $item_price, $item_description,  $item_category);
}

?>