<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Computer Zone Pakistan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> 
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Navbar -->
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

  <!-- Contact Us Form -->
  <div class="container py-5">
    <h2 class="text-center mb-4">Contact Us</h2>
    <form action="#" method="POST">
      <div class="mb-3">
        <label for="firstName" class="form-label">First Name</label>
        <input type="text" class="form-control" id="firstName" name="firstName" required>
      </div>

      <div class="mb-3">
        <label for="lastName" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="lastName" name="lastName" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>

      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
      </div>

      <button type="submit" class="btn btn-warning">Send Message</button>
    </form>
  </div>
  <!-- End of Contact Us Form -->

  <!-- Footer -->
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
