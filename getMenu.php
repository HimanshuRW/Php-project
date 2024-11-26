<?php

// write php code to get menu from database
$con = mysqli_connect("localhost","root","","restaurant");

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT * FROM items";

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $response = array();
    while($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
    echo json_encode($response);
} else {
    echo "0 results";
}

?>