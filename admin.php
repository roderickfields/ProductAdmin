<?php 
session_start();
include 'parts/header.php'; 
include 'conn.php'; 

// Retrieve all products
$products = getAllProducts();

// Handle sort functionality
if(isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    if ($sort == 'name') {
        usort($products, function($a, $b) {
            return $a['name'] <=> $b['name'];
        });
    } elseif ($sort == 'price') {
        usort($products, function($a, $b) {
            return $a['price'] <=> $b['price'];
        });
    }
}

// Handle filter functionality
if(isset($_GET['category']) && !empty($_GET['category'])) {
    $filteredProducts = array_filter($products, function($product) {
        return $product['category'] == $_GET['category'];
    });
    $products = $filteredProducts;
}

?>

<div class="container">
    <h2>Product Admin</h2>
    <form class="sort-filter-form" method="GET" action="">
        <label for="sort">Sort by:</label>
        <select id="sort" name="sort">
            <option value="name">Name</option>
            <option value="price">Price</option>
        </select>
        <label for="category">Filter by Category:</label>
        <select id="category" name="category">
            <option value="">All</option>
            <!-- Assuming categories are retrieved from database -->
            <?php 
            $categories = array_unique(array_column($products, 'category'));
            foreach ($categories as $category): ?>
                <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Apply</button>
    </form>
    <table class="product-table">
        <!-- Table header -->
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Description</th>
                <th>Thumbnail</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table body -->
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['category']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td><img src="<?php echo $product['thumbnail']; ?>" alt="<?php echo $product['name']; ?>" style="max-width: 100px;"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'parts/footer.php'; ?>
