<?php 
session_start();
include 'parts/header.php'; 
include 'conn.php'; 

// Handle search functionality
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $products = searchProducts($search);
} else {
    $products = getAllProducts();
}

if(isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    
    // Check if the product is already in the cart
    if(!in_array($product_id, $_SESSION['cart'])) {
        // Add product to session cart array
        $_SESSION['cart'][] = $product_id;
        echo '<script>alert("Product added to cart.");</script>'; // Optional: Show alert
    } else {
        echo '<script>alert("This product is already in your cart.");</script>'; // Optional: Show alert
    }
}
?>

<div class="container">
    <h2>Product Grid</h2>
    <!-- Add search form -->
    <form class="search-form" method="GET" action="">
        <input type="text" name="search" placeholder="Search...">
        <button type="submit">Search</button>
    </form>
    <div class="grid gap">
        <?php
        foreach ($products as $product) {
            echo '<div class="col-xs-12 col-md-4">';
            echo '<figure class="figure product">';
            echo '<img src="' . $product['thumbnail'] . '" alt="' . $product['name'] . '">';
            echo '<figcaption>';
            echo '<div>' . $product['name'] . '</div>';
            echo '<div>$' . $product['price'] . '</div>';
            echo '<form method="post" action="">'; // Changed action to current page
            echo '<input type="hidden" name="product_id" value="' . $product['id'] . '">';
            echo '<button type="submit" name="add_to_cart" class="w3-button w3-green">Add to Cart</button>';
            echo '</form>';
            echo '</figcaption>';
            echo '</figure>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<?php include 'parts/footer.php'; ?>
