<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Computer Zone Pakistan | Computer & Laptop Prices in Pakistan - Gaming Products - Graphic Cards - Karachi
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .featured-products {
            background-color: #eaeaea;
            /* Light gray background */
            padding: 15px;
            /* Add spacing around the text */
            text-align: center;
            /* Center-align the text */
            font-family: Arial, sans-serif;
            /* Font style */
            font-weight: bold;
            /* Bold text */
            font-size: 16px;
            /* Adjust font size */
            color: #333;
            /* Dark gray text color */
            text-transform: uppercase;
            /* Make text uppercase */
            border: 1px solid #dcdcdc;
            /* Light gray border */
            margin: 20px 0;
            /* Add spacing above and below the section */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</head>




<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #7c4d20;">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php"><img
                    src="images/computerzone-logo-1540160816084000.webp"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu bg-dark">
                            <li><a class="dropdown-item text-white"
                                    href="ProductsScreen.php?category=Laptop">Laptops</a></li>
                            <li><a class="dropdown-item text-white"
                                    href="ProductSscreen.php?category=monitor">Monitors</a></li>
                            <li><a class="dropdown-item text-white" href="ProductsScreen.php?category=gpu">GPU</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="cart.php" tabindex="-1">
                            Cart<i class="bi bi-cart-plus-fill"></i>
                            <span class="cart-badge badge bg-success">4</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="about.php">About Us</a>
                    </li>
                </ul>

                <!-- Navbar User Options -->
                <ul class="navbar-nav mb-2 mb-lg-0 mx-lg-2 order-sm-last">
                    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="User/signup.html">Register/Login</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="myaccount" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                My Account
                            </a>
                            <ul class="dropdown-menu bg-dark">
                                <li><a class="dropdown-item text-white" href="profile.php">My Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-white" href="User/login.php.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                </ul>

                <form class="d-flex search-form">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit" data-bs-toggle="tooltip" data-bs-placement="left"
                        title="Search for all products">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- End of Navbar -->
    <br><br>
    <div class="container">
        <h1>Add Product</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price">
            </div>

            <!-- Category Dropdown -->
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category">
                    <option value="laptop">Laptop</option>
                    <option value="monitor">Monitor</option>
                    <option value="gpu">GPU</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="imageUpload" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="imageUpload" accept="image/*" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>

<?php

require("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category']; // New category field
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        // Get the binary data of the uploaded image
        $image_data = file_get_contents($image_tmp);

        // Prepare the SQL query to insert data
        $sql = "INSERT INTO products (title, description, price, category, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind the parameters for the SQL query
        $stmt->bind_param("ssdsb", $title, $description, $price, $category, $image_data);

        // Send long data for the image field
        $stmt->send_long_data(4, $image_data);

        // Execute the query and check if successful
        if ($stmt->execute()) {
            echo "Product uploaded successfully.";
        } else {
            echo "Error uploading product: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "No image uploaded.";
    }
}

$conn->close();
?>