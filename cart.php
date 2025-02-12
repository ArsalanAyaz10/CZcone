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


  if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];

    $query = "DELETE FROM cart WHERE cart_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cart_id);
    if ($stmt->execute()) {
      echo "<script>window.location.href = 'cart.php';</script>";
      exit();
    } else {
      echo "Error removing item: " . $conn->error;
    }

    $stmt->close();
  }

  $query = "SELECT cart.cart_id, cart.quantity, cart.title, cart.price, cart.image 
          FROM cart";

  $result = mysqli_query($conn, $query);

  if (!$result) {
    die("Error: " . mysqli_error($conn));
  }
  ?>

  <div class="container mb-5">
    <div class="d-flex flex-row align-items-start">
      <div class="col-8 d-flex flex-column m-2">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <div class="cart-item p-3">
            <div class="d-flex flex-row">
              
              <img class="col-2 img-fluid" src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>"
                alt="Product Image" />

              <div class="col-6 p-2">
                <h5><?php echo $row['title']; ?></h5>
                <p>$<?php echo number_format($row['price'], 2); ?></p>
              </div>

              <div class="col-2 p-2">
                Quantity
                <select name="quantity" id="quantity-<?php echo $row['cart_id']; ?>">
                  <option value="1" <?php echo ($row['quantity'] == 1) ? 'selected' : ''; ?>>1</option>
                  <option value="2" <?php echo ($row['quantity'] == 2) ? 'selected' : ''; ?>>2</option>
                  <option value="3" <?php echo ($row['quantity'] == 3) ? 'selected' : ''; ?>>3</option>
                </select>
              </div>


              <div class="col-2 d-flex justify-content-end align-items-start close">
                <a href="cart.php?cart_id=<?php echo $row['cart_id']; ?>" class="text-danger"
                  onclick="return confirm('Are you sure you want to remove this item?');">
                  <i class="bi bi-x-circle"></i>
                </a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
      <?php

      $total_price = 0;
      $shipping_fee = 10; 
      $discount = 10;
      
      $query = "SELECT cart.cart_id, cart.quantity, cart.title, cart.price 
          FROM cart"; 
      
      $result = mysqli_query($conn, $query);

      if (!$result) {
        die("Error: " . mysqli_error($conn));
      }

      while ($row = mysqli_fetch_assoc($result)) {
        $total_price += $row['price'] * $row['quantity'];
      }
      $final_total = $total_price + $shipping_fee - $discount;
      ?>

      <div class="col-4 order p-3 m-2">
        <h4>Order Total</h4>
        <div class="d-flex flex-row py-2">
          <input type="text" class="form-control" placeholder="promo code" />
          <button class="btn btn-primary">Apply</button>
        </div>
        <div class="d-flex flex-row justify-content-between p-2">
          <span class="billing-item">Items</span>
          <span class="billing-cost">$<?php echo number_format($total_price, 2); ?></span>
        </div>
        <div class="d-flex flex-row justify-content-between p-2">
          <span class="billing-item">Shipping</span>
          <span class="billing-cost">$<?php echo number_format($shipping_fee, 2); ?></span>
        </div>
        <div class="d-flex flex-row justify-content-between p-2">
          <span class="billing-item">Discount</span>
          <span class="billing-cost">-$<?php echo number_format($discount, 2); ?></span>
        </div>
        <div class="d-flex flex-row justify-content-between p-2">
          <span class="billing-item fs-5">Total</span>
          <span class="billing-cost fs-5">$<?php echo number_format($final_total, 2); ?></span>
        </div>

        <div class="d-flex mt-3">
          <a href="checkout.php" class="btn btn-primary flex-grow-1">Pay Now</a>
        </div>
      </div>

    </div>
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
  <!-- End of Footer -->
 
</body>

</html>