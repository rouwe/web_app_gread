<?php
session_start();
require_once "./utilities/php_snippets/header.php";
require_once "./utilities/php_snippets/footer.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="charset" content="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roweme B. Santos">
    <title>Log in | Your library of entertainment</title>
    <link rel="icon" href="./assets/logo/brand_logo.png">
    <link rel="stylesheet" href="./utilities/css/component_style.css">
    <link rel="stylesheet" href="./utilities/css/index_header.css">
    <link rel="stylesheet" href="./utilities/css/footer.css">
    <link rel="stylesheet" href="./utilities/css/media_query.css">
    <link rel="stylesheet" href="./utilities/css/auth.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    // Header template
    auth_header();
    ?>
    <main class="main-container">
        <!-- Signup Form -->
        <section class="auth-container">
            <!-- Text Box -->
            <div class="form-text-box login-text-box">
                <h1 class="form-heading">Welcome Back</h1>
            </div>
            <!-- Form -->
            <form class="form-container" method="POST" enc>
                <div class="inpt-field-box">
                    <label class="inpt-label" for="email">Email</label>
                    <input class="inpt-field" type="email" id="email" class="inpt_email" name="usr_email" required placeholder="yourname@email.com">
                </div>
                <div class="inpt-field-box pass-field">
                    <label class="inpt-label" for="password">Password</label>
                    <input class="inpt-field" type="password" id="password" class="inpt_password" required placeholder="Enter your password" minLength="8" maxLength="72">
                </div>
                <p class="pass-length-info">Between 8 and 72 characters</p>
                <button class="join-btn" type="submit" name="login">Login</button>
            </form>
            <p class="forgot-pass"><a href="#">Forgot password?</a></p>
            <hr class="join-divider login-divider">
            <p class="is-not-user">Do not have an account yet? <a href="./signup.php">Sign up</a></p>
        </section>
    </main>
    <?php
    // Footer template
    index_footer();
    ?>
</body>

</html>