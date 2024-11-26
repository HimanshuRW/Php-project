<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'stripe-php-master/init.php';

// ... rest of your code

\Stripe\Stripe::setApiKey('sk_test_51NndDXSIDierbZqclFAZYEu6CYXZQgJYv6ejEGEK3oDEnMjpobEYtZYYkBsPxvhdN38xr4tmgdOEt7etD1QRYj5w00AT9mn3Aj');


header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:8080/dsw/UI'; 

$amt = $_POST['amount'];
$amt = (int)$amt;

$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'inr', // Use INR
            'product_data' => [
                'name' => 'Food',
            ],
            'unit_amount' => $amt*100, // Amount in paise (₹20.00)
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/success.php',
    'cancel_url' => $YOUR_DOMAIN . '/failure.php',
]);


echo json_encode(['id' => $checkout_session->id]);