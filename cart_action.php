<?php
require_once 'connection.php';

if (isset($_GET['action']) && $_GET['action'] === 'add_to_cart' && isset($_GET['product_id'])) {
    $product_id = (int)$_GET['product_id'];
    $quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1;

    
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product_result = $stmt->get_result();

    if ($product_result->num_rows > 0) {
        $product_details = $product_result->fetch_assoc();

        
        $stmt = $conn->prepare("SELECT * FROM cart WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $cart_result = $stmt->get_result();

        if ($cart_result->num_rows > 0) {
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
            
            header('Location: index.php'); 
            exit;
        } else {
            echo "Failed to add product to cart.";
        }
        $stmt->close();
    } else {
        echo "Product not found.";
    }
}

$conn->close();
?>
