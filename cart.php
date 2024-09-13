<?php
session_start();
require "products.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Your Cart</h1>
    <ul>
        <?php if (empty($_SESSION['cart'])): ?>
            <li>Your cart is empty.</li>
        <?php else: ?>
            <?php 
            $total_price = 0;
            foreach ($_SESSION['cart'] as $item): 
                $product = $item['product'];
                $quantity = $item['quantity'];
                $total_price += $product['price'] * $quantity;
            ?>
                <li>
                    <?php echo htmlspecialchars($product['name']); ?> - <?php echo htmlspecialchars($product['price']); ?> PHP x <?php echo htmlspecialchars($quantity); ?>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <p>Total Price: <?php echo htmlspecialchars($total_price); ?> PHP</p>
    <a href="reset-cart.php">Clear my cart</a>
    <a href="place_order.php">Place the order</a>
    <br><br>
    <a href="index.php">Back to Products</a>
</body>
</html>
