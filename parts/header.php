<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop | Roderick Fields</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicon_io/site.webmanifest">
</head>

<body>

    <header class="navbar">
        <div class="container display-flex">
            <div class="flex-none">
                <h1><a href="index.php">Home</a></h1>
            </div>
            <div class="flex-stretch"></div>
            <nav class="flex-none nav">
                <ul class="container display-flex">
                    <li><a href="admin.php">Admin</a></li>

                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="cart.php">Cart <?php echo isset($_SESSION['cart']) ? '(' . count($_SESSION['cart']) . ')' : '(0)' ?></a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="checkout.php">Checkout</a></li>
                </ul>
            </nav>
        </div>
    </header>



    <main class="container py-4">