<?php
// Start session and include database connection
session_start();
include 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: User/login.html");
  exit();
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$query = "SELECT first_name, last_name, email FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if the user has uploaded a profile picture


// If no profile picture is found, use the default avatar
if (empty($profile_picture) || !file_exists('uploads/' . $profile_picture)) {
    $profile_picture = 'default-avatar.webp';  // Set the default avatar
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile - Computer Zone Pakistan</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">
  <style>
    .profile-avatar {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin: auto;
      display: block;
    }

    .profile-container {
      text-align: center;
      margin-top: 50px;
    }

    .profile-info {
      margin-top: 20px;
      text-align: left;
    }

    .section-title {
      font-weight: bold;
      font-size: 1.5rem;
      margin-top: 30px;
    }

    .profile-content {
      margin-top: 10px;
      text-align: left;
      font-size: 1rem;
    }

    .btn-primary {
      background-color: #7c4d20;
      border-color: #7c4d20;
    }
  </style>
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
                <li><a class="dropdown-item text-white" href="User/logout.php">Logout</a></li>
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

  <!-- Profile Content -->
  <div class="container">
    <div class="profile-container">
      <img src="avatar1.webp" alt="Avatar" class="profile-avatar">
      <h2><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h2>
      <p><?php echo htmlspecialchars($user['email']); ?></p>
    </div>

    <!-- Additional User Info Sections -->
    <div class="profile-info">
      <div class="section-title">Account Information</div>
      <div class="profile-content">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
      </div>

      <div class="section-title">Purchase History</div>
      <div class="profile-content">
        <p>Your recent orders and purchase history will be displayed here.</p>
        <!-- You can fetch and display purchase history from the database in a similar way -->
      </div>

      <div class="section-title">Wishlist</div>
      <div class="profile-content">
        <p>Your wishlist items (e.g., laptops, PCs) will be displayed here. Add items to your wishlist for future purchase.</p>
      </div>

      <div class="section-title">Manage Account</div>
      <div class="profile-content">
        <p><a href="update.php" class="btn btn-primary">Update Profile</a></p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
