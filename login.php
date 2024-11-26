<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM staff WHERE staff_id='$username' AND staff_password='$password'";
    $result = mysqli_query($con, $query);
    if(!$result){
        echo "Error: ".mysqli_error($con);
    }
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['staff_id'] = $row['staff_id'];
        $_SESSION['staff_name'] = $row['staff_name'];
        header('Location: cafe.html');
    } else {
        echo '<script>alert("Invalid credentials")</script>';
    }
}
?>