<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $thumbnail = uploadThumbnail();

    addProduct($name, $price, $category, $description, $thumbnail);
}

// Function to upload thumbnail image
function uploadThumbnail() {
    $targetDir = "products_images/";
    $targetFile = $targetDir . basename($_FILES["thumbnail"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["thumbnail"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

?>

<?php include 'header.php'; ?>

<nav>
    <div class="container">
        <h2>Add Products</h2>
        <a href="index.php">All Products</a>
    </div>
</nav>

<div class="container">
    <form class="form-container" action="add_product.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" min="0" step="0.01" required><br>

        <label for="category">Category:</label><br>
        <input type="text" id="category" name="category" required><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" required></textarea><br>

        <label for="thumbnail">Thumbnail Image:</label><br>
        <input type="file" id="thumbnail" name="thumbnail" required accept="image/*"><br>

        <input type="submit" value="Add Product">
    </form>
</div>


<?php include 'footer.php'; ?>
