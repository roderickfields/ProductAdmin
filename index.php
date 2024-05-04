<?php include 'header.php'; ?>
<?php include 'conn.php'; ?>

<nav>
    <div class="container">
        <h2>Products Admin</h2>
        <a href="add_product.php">Add Products</a>
    </div>
</nav>

<div class="container">
    <h2>All Products</h2>
    <form class="search-filter-form" method="GET">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search" placeholder="Search...">

        <label for="sort">Sort by:</label>
        <select id="sort" name="sort">
            <option value="name">Name</option>
            <option value="price">Price</option>
        </select>

        <button type="submit">Search & Sort</button>
    </form>

    <ul class="products-list">
        <?php
        $products = getAllProducts();

        // Check if search query is set
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = $_GET['search'];
            $products = searchProducts($search);
        }

        // Sort products based on selected option
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            if ($sort == 'name') {
                usort($products, function ($a, $b) {
                    return strcmp($a['name'], $b['name']);
                });
            } elseif ($sort == 'price') {
                usort($products, function ($a, $b) {
                    return $a['price'] - $b['price'];
                });
            }
        }

        foreach ($products as $product) {
            echo '<li class="product-item">';
            echo '<h3>' . $product['name'] . '</h3>';
            echo '<img src="' . $product['thumbnail'] . '" alt="' . $product['name'] . '">';
            echo '<p>Price: $' . $product['price'] . '</p>';
            echo '</li>';
        }
        ?>
    </ul>
</div>

<?php include 'footer.php'; ?>