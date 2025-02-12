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

        .team-member {
            margin-top: 20px;
        }

        .team-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ddd;
            /* Optional: Add border */
        }

        .team-member h4 {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .team-member p {
            font-size: 14px;
            color: #555;
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

    <main class="container mt-5">
        <!-- About Us Section -->
        <section>
            <h1>About Us</h1>
            <p>Welcome to our company. We are dedicated to providing the best service possible.</p>
            <p>Our mission is to deliver high-quality products that bring value to our customers. We strive for
                excellence in everything we do and are committed to continuous improvement.</p>
            <p>Our team is composed of experienced professionals who are passionate about their work. We believe in
                fostering a collaborative and inclusive environment where everyone can thrive.</p>
        </section>

        <!-- Google Map Section -->
        <section class="mt-5">
            <h2>Our Location</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.908248100481!2d67.04296232519802!3d24.798595127969715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33d028f1f1e9b%3A0x2e19791cb6e83319!2sBadar%20Commercial%20Area%20Defence%20V%20Defence%20Housing%20Authority%2C%20Karachi%2C%20Karachi%20City%2C%20Sindh%2075500%2C%20Pakistan!5e0!3m2!1sen!2snl!4v1736192096297!5m2!1sen!2snl"
                            allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <a href="https://goo.gl/maps/UunqAWheod6SYCr48" target="_blank" class="btn btn-primary mt-3">View on
                        Google Maps</a>
                </div>
                <div class="col-md-6">
                    <p>We are located in the heart of the city, with easy access to public transport and key business
                        hubs.</p>
                </div>
            </div>
        </section>

        <!-- Our Vision Section -->
        <section class="mt-5">
            <h2>Our Vision</h2>
            <p>To be the leading provider of innovative and sustainable solutions that empower businesses and
                individuals to reach their full potential.</p>
        </section>

        <!-- Our Values Section -->
        <section class="mt-5">
            <h2>Our Values</h2>
            <ul>
                <li><strong>Integrity:</strong> We uphold the highest standards of honesty and fairness in all our
                    actions.</li>
                <li><strong>Innovation:</strong> We continuously seek new and creative ways to improve our products and
                    services.</li>
                <li><strong>Customer-Centric:</strong> Our customers are at the center of everything we do, and we are
                    committed to providing exceptional service.</li>
                <li><strong>Excellence:</strong> We strive for the highest quality in everything we do, ensuring that we
                    exceed customer expectations.</li>
            </ul>
        </section>

        <!-- Meet the Team Section -->
        <section class="mt-5">
            <h2>Meet the Team</h2>
            <div class="row text-center">
                <div class="col-md-4 team-member">
                    <img src="arsal.jpg" alt="Team Member 1" class="team-image">
                    <h4>Arsalan Ayaz</h4>
                    <p>CEO & Founder</p>
                </div>
                <div class="col-md-4 team-member">
                    <img src="harry.jpg" alt="Team Member 2" class="team-image">
                    <h4>Zohaib Hassan</h4>
                    <p>Lead Developer</p>
                </div>
                <div class="col-md-4 team-member">
                    <img src="bad.jpg" alt="Team Member 3" class="team-image">
                    <h4>Badshah</h4>
                    <p>Marketing Director</p>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="mt-5">
            <h2>What Our Clients Say</h2>
            <div class="testimonial">
                <p>"This company is outstanding! Their customer support is top-notch, and the quality of their products
                    exceeded our expectations. Highly recommend!"</p>
                <footer>- Sarah Williams, CEO of XYZ Corp.</footer>
            </div>
            <div class="testimonial">
                <p>"Working with this team was a game-changer for our business. Their innovative solutions helped us
                    streamline our operations and achieve success!"</p>
                <footer>- James Lee, Founder of ABC Ltd.</footer>
            </div>
        </section>
    </main>

    <div class="footer mt-auto bg-dark text-light">
        <div class="container py-3">
            <div class="row d-flex footer-items">
                <div class="col-lg-4">
                    <h5>Categories</h5>
                    <ul>
                        <li><a class="dropdown-item text-white" href="ProductsScreen.php?category=Laptop">Laptops</a>
                        </li>
                        <li><a class="dropdown-item text-white" href="ProductSscreen.php?category=monitor">Monitors</a>
                        </li>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>