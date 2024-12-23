<?php 
include '../templates/header.php';
require '../functions/user.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    try {
        if (registerUser($username, $email, $password)) {
            header("Location: login.php");
            exit;
        }
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Duplicate entry
            $error = "Username or email already exists.";
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>

<div class="auth-container">
    <div class="form-box">
        <div class="auth-header">
            <h2>Create Account</h2>
            <p>Join ImageHive today</p>
        </div>
        
        <?php if ($error): ?>
            <div class="form-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" id="registerForm" class="login-form">
            <div class="input-group">
                <input type="text" name="username" required>
                <label>Username</label>
                <div class="input-highlight"></div>
            </div>
            
            <div class="input-group">
                <input type="email" name="email" required>
                <label>Email</label>
                <div class="input-highlight"></div>
            </div>
            
            <div class="input-group">
                <input type="password" name="password" required>
                <label>Password</label>
                <div class="input-highlight"></div>
            </div>
            
            <button type="submit" class="submit-btn">
                <span>Sign Up</span>
                <div class="ripple"></div>
            </button>
        </form>
        
        <div class="auth-footer">
            <p>Already have an account? <a href="login.php" class="signup-link">Login</a></p>
        </div>
    </div>
</div>