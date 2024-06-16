<?php
// add_to_cart.php
session_start();

// Check if the cart session variable already exists, if not create it
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Retrieve product details from the form
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];

// Check if the product is already in the cart
$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['id'] == $product_id) {
        $item['quantity']++;
        $found = true;
        break;
    }
}

if (!$found) {
    // If product is not in the cart, add it
    $_SESSION['cart'][] = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => 1
    ];
}

// Redirect back to the product page or cart page
header('Location: cart.php');
exit();
?>
