<?php 
session_start();
include 'parts/header.php'; 
include 'conn.php'; 

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo '<section>
            <div class="container">
                <h2>Shopping Cart</h2>
                <p>Your shopping cart is empty</p>
            </div>
          </section>';
} else {
    echo '<section>
            <div class="container">
                <h2>Shopping Cart</h2>
                <table class="table lined vertical border striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
    $totalCartAmount = 0; // Initialize total cart amount
    foreach ($_SESSION['cart'] as $product_id) {
        $product = getProductById($product_id);
        $quantity = isset($_SESSION['cart_quantity'][$product_id]) ? $_SESSION['cart_quantity'][$product_id] : 1;
        $totalProductAmount = $product['price'] * $quantity;
        $totalCartAmount += $totalProductAmount;
        echo '<tr>';
        echo '<td>' . $product['name'] . '</td>';
        echo '<td>$' . $product['price'] . '</td>';
        echo '<td>'; // Quantity
        echo '<form method="post" action="">';
        echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
        echo '<button type="submit" name="decrease_quantity">-</button>'; // Decrease quantity
        echo ' '.$quantity.' '; // Display current quantity
        echo '<button type="submit" name="increase_quantity">+</button>'; // Increase quantity
        echo '</form>';
        echo '</td>';
        echo '<td>$' . $totalProductAmount . '</td>'; // Total amount for this product
        echo '<td><form method="post" action=""><input type="hidden" name="product_id" value="' . $product_id . '"><button type="submit" name="remove_product" class="w3-button w3-red">Remove</button></form></td>'; // Remove product button
        echo '</tr>';
    }
    echo '</tbody>';
    echo '<tfoot>';
    echo '<tr>';
    echo '<td colspan="3"><strong>Total</strong></td>';
    echo '<td colspan="2">$' . $totalCartAmount . '</td>'; // Total amount for the whole cart
    echo '</tr>';
    echo '</tfoot>';
    echo '</table></div></div></section>';

    // Checkout button
    echo '<div class="container">
            <form action="checkout.php" method="post">
                <button type="submit" class="w3-button w3-green">Checkout</button>
            </form>
          </div>';
}

if(isset($_POST['remove_product']) && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    // Remove product from session cart array
    $index = array_search($product_id, $_SESSION['cart']);
    if($index !== false) {
        unset($_SESSION['cart'][$index]);
        unset($_SESSION['cart_quantity'][$product_id]);
    }
    // Refresh the page
    header("Location: cart.php");
    exit();
}

if(isset($_POST['decrease_quantity']) && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    // Decrease quantity
    if(isset($_SESSION['cart_quantity'][$product_id])) {
        $_SESSION['cart_quantity'][$product_id] = max(1, $_SESSION['cart_quantity'][$product_id] - 1);
    }
}

if(isset($_POST['increase_quantity']) && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    // Increase quantity
    if(isset($_SESSION['cart_quantity'][$product_id])) {
        $_SESSION['cart_quantity'][$product_id]++;
    } else {
        $_SESSION['cart_quantity'][$product_id] = 2; // Start from 2 when increasing for the first time
    }
}

include 'parts/footer.php'; 
?>
