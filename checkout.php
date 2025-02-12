<?php
session_start();

require("connection.php");

$firstName = $lastName = $phone = $address = $address2 = $country = $state = $zip = "";

if (isset($_GET['delete'])) {
    $idToDelete = $_GET['delete'];
    $deleteQuery = "DELETE FROM address WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $idToDelete);

    if ($stmt->execute()) {
        //nothing
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

    $stmt = $conn->prepare("INSERT INTO address (first_name, last_name, phone, address, address2, country, state, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $firstName, $lastName, $phone, $address, $address2, $country, $state, $zip);

    if ($stmt->execute()) {
        header("Location: checkout.php");  
        $firstName = $lastName = $phone = $address = $address2 = $country = $state = $zip = "";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$sql = "SELECT * FROM address ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$addressData = null;
if ($result && $result->num_rows > 0) {
    $addressData = $result->fetch_assoc(); 
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
    <div class="container mb-5">
        <main>
            <div class="py-5 text-center">
                <h2>Checkout</h2>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Shipping address</h4>
                <div class="card">
                    <div class="card-body">
                        <?php if ($addressData): ?>
                            <h5 class="card-title">
                                <?php echo $addressData['first_name'] . ' ' . $addressData['last_name']; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <?php echo $addressData['address'] . ', ' . $addressData['state'] . ', ' . $addressData['zip']; ?>
                            </h6>
                            <p class="card-text"><?php echo $addressData['phone']; ?></p>
                            <input type="checkbox" name="address" id=""> Use this Address
                        <?php else: ?>
                            <p>No address found. Please fill out the form to add your address.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Shipping address</h4>
                    <form class="needs-validation" method="POST"
                        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
                        <input type="hidden" name="token" value="<?php echo $token; ?>">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">First name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                            </div>

                            <div class="col-12">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>

                            <div class="col-12">
                                <label for="address2" class="form-label">Address 2 (Optional)</label>
                                <input type="text" class="form-control" id="address2" name="address2">
                            </div>

                            <div class="col-md-5">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select" id="country" name="country" required>
                                    <option value="">Choose...</option>
                                    <option>United States</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <select class="form-select" id="state" name="state" required>
                                    <option value="">Choose...</option>
                                    <option>California</option>
                                </select>
                            </div>


                            <div class="col-md-3">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="text" class="form-control" id="zip" name="zip" required>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h4 class="mb-3">Payment</h4>
                        <div class="my-3">
                            <div class="form-check">
                                <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked=""
                                    required="">
                                <label class="form-check-label" for="credit">Credit card</label>
                            </div>
                            <div class="form-check">
                                <input id="debit" name="paymentMethod" type="radio" class="form-check-input"
                                    required="">
                                <label class="form-check-label" for="debit">Debit card</label>
                            </div>
                            <div class="form-check">
                                <input id="paypal" name="paymentMethod" type="radio" class="form-check-input"
                                    required="">
                                <label class="form-check-label" for="paypal">PayPal</label>
                            </div>
                        </div>

                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-expiration" class="form-label">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                    </form>
                </div>
            </div>
        </main>
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