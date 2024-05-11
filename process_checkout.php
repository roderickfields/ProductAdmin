<?php
session_start();
include 'conn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form inputs
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];

    // You can add more validation here as needed

    $sql = "INSERT INTO orders (name, email, address, payment_method, total_price) VALUES ('$name', '$email', '$address', '$payment_method', '{$_SESSION['total_price_all_items']}')";
    if ($conn->query($sql) === TRUE) {
        // Clear the cart session
        unset($_SESSION['cart']);
        unset($_SESSION['total_price_all_items']);

        // Redirect to a thank you page after successful order placement
        header("Location: thank_you.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
