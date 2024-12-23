<?php 
include '../templates/header.php'; 
require '../functions/user.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (loginUser($email, $password)) {
        header("Location: ../index.php");
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<div class="auth-container">
    <div class="form-box">
        <div class="auth-header">
            <h2>Welcome Back</h2>
            <p>Login to your ImageHive account</p>
        </div>
        
        <?php if ($error): ?>
            <div class="form-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" id="loginForm" class="login-form">
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
                <span>Login</span>
                <div class="ripple"></div>
            </button>
        </form>
        
        <div class="auth-footer">
            <p>Don't have an account? <a href="register.php" class="signup-link">Sign Up</a></p>
        </div>
    </div>
</div>