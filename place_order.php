<?php
session_start();
require "products.php";

// Generate a random order code
$order_code = bin2hex(random_bytes(8));

// Prepare the order data
$order_data = "Order Code: $order_code\n";
$order_data .= "Date and Time Ordered: " . date('Y-m-d H:i:s') . "\n\n";
$order_data .= "Order Items:\n";

$total_price = 0;
foreach ($_SESSION['cart'] as $product) {
    $order_data .= "Product ID: " . $product['id'] . "\n";
    $order_data .= "Product Name: " . $product['name'] . "\n";
    $order_data .= "Price: " . $product['price'] . " PHP\n\n";
    $total_price += $product['price'];
}
$order_data .= "Total Price: " . $total_price . " PHP\n";

// Save order data to file
$file = fopen("orders-$order_code.txt", 'w');
fwrite($file, $order_data);
fclose($file);

// Clear the cart
$_SESSION['cart'] = [];

// Display confirmation message
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Order</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order!</p>
    <p>Order Code: <?php echo htmlspecialchars($order_code); ?></p>
    <p>Total Price: <?php echo htmlspecialchars($total_price); ?> PHP</p>
    
    <!-- Back to Products button -->
    <form action="index.php" method="get">
        <button type="submit">Back to Products</button>
    </form>
</body>
</html>
