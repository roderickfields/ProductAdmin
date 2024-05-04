<?php
session_start();
include 'parts/header.php';
include 'conn.php';

if (isset($_POST['submit_checkout'])) {
    // Process payment and complete checkout

    // Clear cart after checkout
    unset($_SESSION['cart']);
    unset($_SESSION['cart_quantity']);
    echo '<script>alert("Thank you for your purchase. Your order has been completed.");</script>'; // Optional: Show alert
}
?>

<section>
    <div class="container">
        <h2>Checkout</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" class="form-control" required>
                    <option value="">Select Payment Method</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <!-- Add more payment methods as needed -->
                </select>
            </div>
            <!-- Add more form fields as needed -->

            <button type="submit" name="submit_checkout" class="btn btn-primary">Complete Order</button>
        </form>
    </div>

    <style>
        /* Style for form fields */
        .form-group {
            margin-bottom: 20px;
        }

        /* Style for form inputs */
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Style for submit button */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</section>

<?php include 'parts/footer.php'; ?>