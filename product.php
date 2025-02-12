<?php
session_start();
?>
<?php
require_once 'connection.php';
$product_id = isset($_GET['product_id']) ? (int) $_GET['product_id'] : 0;
$product_details = null;

if ($product_id > 0) {
    
    $sql = "SELECT * FROM products WHERE product_id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product_details = $result->fetch_assoc();
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid product ID.";
}

if (isset($_GET['action']) && $_GET['action'] === 'add_to_cart' && isset($_GET['product_id'])) {
    $product_id = (int) $_GET['product_id'];
    $quantity = isset($_GET['quantity']) ? (int) $_GET['quantity'] : 1;


    $stmt = $conn->prepare("SELECT * FROM cart WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
       
        $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE product_id = ?");
        $stmt->bind_param("ii", $quantity, $product_id);
    } else {
        $title = $product_details['title'];
        $description = $product_details['description'];
        $price = $product_details['price'];
        $image = $product_details['image'];

        $stmt = $conn->prepare("INSERT INTO cart (product_id, title, description, price, image, quantity) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdsi", $product_id, $title, $description, $price, $image, $quantity);
    }

    if ($stmt->execute()) {
        $message = "Product added to cart successfully!";
    } else {
        $message = "Failed to add product to cart.";
    }
    $stmt->close();
}

$conn->close();
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
            padding: 15px;
            text-align: center;
            font-family: Arial, sans-serif;
            font-weight: bold;
            font-size: 16px;
            color: #333;
            text-transform: uppercase;
            border: 1px solid #dcdcdc;
            margin: 20px 0;
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

    <div class="container mb-5">
        <?php if ($product_details): ?>
            <div class="row d-flex flex-row">

                <div class="col-md-8 product-image">
                    <img class="img-fluid"
                        src="data:image/jpeg;base64,<?php echo base64_encode($product_details['image']); ?>"
                        alt="<?= $product_details['title'] ?>" />
                </div>

                <div class="col-md-4">
                    <h6 class="text-uppercase text-secondary"><?= $product_details['brand'] ?? 'Brand' ?></h6>
                    <h2 class="fs-3"><?= $product_details['title'] ?></h2>
                    <h5 class="text-secondary fs-6 fw-bold">Rs. <?= number_format($product_details['price'], 2) ?></h5>
                    

                    

                   

                    <a href="?action=add_to_cart&product_id=<?= $product_details['product_id'] ?>&quantity=1"
                        class="btn btn-dark w-100 my-5">
                        <i class="bi bi-cart-plus-fill"></i> Add to Cart
                    </a>

                    <div>
                        <span class="text-secondary text-small">Details:</span>
                        <div class="accordion" id="productDetailsAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Product Description
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#productDetailsAccordion">
                                    <div class="accordion-body">
                                        <?= $product_details['description'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p>Product not found!</p>
        <?php endif; ?>
    </div>

    <div class="footer mt-auto bg-dark text-light">
    <div class="container py-3">
      <div class="row d-flex footer-items">
        <div class="col-lg-4">
          <h5>Categories</h5>
          <ul>
          <li><a class="dropdown-item text-white" href="ProductsScreen.php?category=Laptop">Laptops</a></li>
              <li><a class="dropdown-item text-white" href="ProductSscreen.php?category=monitor">Monitors</a></li>
              <li><a class="dropdown-item text-white" href="ProductsScreen.php?category=gpu">GPU</a></li>
          </ul>
        </div>
        <div class="col-lg-4">
          <h5>Useful Links</h5>
          <ul>
            <li><a href="#">Terms</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Mission</a></li>
            <li><a href="contact.php">Contact Us</a></li>
          </ul>
        </div>
        <div class="col-lg-4">
          <h5>Get Updates</h5>
          <div class="d-flex subscribe">
            <input type="text" class="form-control">
            <button class="btn btn-warning">Subscribe</button>
          </div>
          <div class="mt-2">
            <div class="btn-group me-2 social-icons" role="group" aria-label="First group">
              <button type="button"
                class="btn btn-secondary mx-1 d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-facebook"></i>
              </button>
              <button type="button"
                class="btn btn-secondary mx-1 d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-instagram"></i>
              </button>
              <button type="button"
                class="btn btn-secondary mx-1 d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-twitter"></i>
              </button>
              <button type="button"
                class="btn btn-secondary mx-1 d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-linkedin"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  
  </div>
</body>

</html>