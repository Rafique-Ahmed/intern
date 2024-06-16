<!-- product.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Page</title>
</head>
<body>
    <h1>Product Name</h1>
    <p>Product Description</p>
    <p>Price: $10</p>
    <form method="post" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="1">
        <input type="hidden" name="product_name" value="Product Name">
        <input type="hidden" name="product_price" value="10">
        <button type="submit">Add to Cart</button>
    </form>
</body>
</html>
