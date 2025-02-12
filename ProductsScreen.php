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
      <a class="navbar-brand text-white" href="index.php"><img src="images/computerzone-logo-1540160816084000.webp"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
              <li><a class="dropdown-item text-white" href="ProductsScreen.php?category=Laptop">Laptops</a></li>
              <li><a class="dropdown-item text-white" href="ProductSscreen.php?category=monitor">Monitors</a></li>
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

  <?php

require("connection.php");

function fetchProductsByCategory($conn, $category)
{
    $sql = "SELECT * FROM products WHERE category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    return $stmt->get_result();
}

$category = isset($_GET['category']) ? $_GET['category'] : 'laptop'; 


$products = fetchProductsByCategory($conn, $category);
$conn->close();
?>

<!-- Carousel Section -->
<div id="carouselExampleDark" class="carousel carousel-dark slide mb-5" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <?php
        $index = 0;
        foreach ($products as $product) {
            echo '<li data-bs-target="#carouselExampleDark" data-bs-slide-to="' . $index . '" class="' . ($index === 0 ? 'active' : '') . '"></li>';
            $index++;
        }
        ?>
    </ol>
    <div class="carousel-inner">
        <?php
        $isFirst = true;
        foreach ($products as $product) {
            $imageData = base64_encode($product['image']);
            echo '
            <div class="carousel-item ' . ($isFirst ? 'active' : '') . '" data-bs-interval="3000">
                <img src="data:image/jpeg;base64,' . $imageData . '" class="d-block w-100" alt="Product Image">
                <div class="carousel-caption d-none d-md-block">
                    <h5>' . htmlspecialchars($product['title']) . '</h5>
                </div>
            </div>';
            $isFirst = false;
        }
        ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>
<!-- End of Carousel -->

<!-- Cards-->
<div class="container mb-5">
    <div id="products" class="row">
        <div class="col-12">
            <h3><?php echo ucfirst($category); // Capitalize the category ?></h3>
        </div>
        <div class="row">
            <?php
            $count = 0;
            foreach ($products as $product) {
                if ($count % 4 == 0 && $count != 0) {
                    echo '</div><div class="row">';
                }
                $imageData = base64_encode($product['image']);
                ?>
                <div class="col-xl-3 col-lg-4 col-md-6 position-relative">
                    <a href="product.php?product_id=<?php echo urlencode($product['product_id']); ?>" class="text-decoration-none">
                        <div class="card product-item">
                            <i class="bi bi-heart-fill position-absolute liked"></i>
                            <i class="bi bi-heart position-absolute like"></i>
                            <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" class="card-img-top" alt="Product Image" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to See Product Details">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['title']); ?></h5>
                                <p class="card-text price">Rs. <?php echo number_format($product['price'], 2); ?>
                                    <span class="float-end rating-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                </p>
                                <div class="product text-center">
                                    <a href="cart_action.php?action=add_to_cart&product_id=<?php echo $product['product_id']; ?>&quantity=1" class="btn btn-dark w-100">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                $count++;
            }
            ?>
        </div>
    </div>
</div>
<!-- Cards-->

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
  <!-- End of Footer -->
</body>

</html>