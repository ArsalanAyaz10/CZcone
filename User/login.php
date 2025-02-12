

<?php

require_once '../connection.php';
session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    
    $errors = [];

    
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
       
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

       
        if (!password_verify($password, $hashed_password)) {
            $errors['password'] = "Incorrect password.";
        }
    } else {
        $errors['email'] = "Email does not match any account.";
    }

    $stmt->close();

    
    if (!empty($errors)) {
        
        $_SESSION['login_errors'] = $errors;
        $_SESSION['login_email'] = $email; 
        header("Location: login.html");
        exit();
    } else {
      
       
        $_SESSION['loggedin'] = true;

        $_SESSION['user_id'] = $user_id; 

 
        header("Location: ../index.php");
        exit();
    }
}

$conn->close();
?>
