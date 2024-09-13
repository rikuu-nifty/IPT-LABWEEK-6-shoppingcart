<?php
session_start();
require "products.php";

// Add to cart logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    // Find the product by ID
    foreach ($products as $product) {
        if ($product['id'] == $product_id) {
            // Add product to cart
            if (!isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] = [
                    'product' => $product,
                    'quantity' => 0
                ];
            }
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
            break;
        }
    }
}

// Redirect to the cart page
header("Location: cart.php");
exit();
