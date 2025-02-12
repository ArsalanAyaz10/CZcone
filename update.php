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

// Check if the form is submitted to update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Update user data in the database
    $update_query = "UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE user_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sssi", $first_name, $last_name, $email, $user_id);
    $update_stmt->execute();

    // After update, fetch the updated data to display on the profile page
    header("Location: profile.php");  // Redirect to the profile page after updating
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Profile - Computer Zone Pakistan</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <style>
    .form-container {
      width: 50%;
      margin: auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-top: 50px;
    }
    .form-group {
      margin-bottom: 15px;
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
      <a class="navbar-brand text-white" href="index.php"><img src="images/computerzone-logo-1540160816084000.webp" alt="Computer Zone Logo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-white" href="cart.php">Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="about.php">About Us</a>
          </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0 mx-lg-2 order-sm-last">
          <li class="nav-item">
            <a class="nav-link text-white" href="User/logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="form-container">
      <h2>Update Your Profile</h2>
      <form method="POST" action="update.php">
        <div class="form-group">
          <label for="first_name">First Name:</label>
          <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
        </div>
        <div class="form-group">
          <label for="last_name">Last Name:</label>
          <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Update Profile</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
