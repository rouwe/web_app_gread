<?php
require_once "./utilities/php_snippets/header.php";
require_once "./utilities/php_snippets/footer.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="charset" content="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roweme B. Santos">
    <title>Sign up | Your library of entertainment</title>
    <link rel="icon" href="./assets/logo/brand_logo.png">
    <link rel="stylesheet" href="./utilities/css/component_style.css">
    <link rel="stylesheet" href="./utilities/css/header.css">
    <link rel="stylesheet" href="./utilities/css/footer.css">
    <link rel="stylesheet" href="./utilities/css/media_query.css">
    <link rel="stylesheet" href="./utilities/css/signup.css">
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
        <section class="signup-container">
            <!-- Text Box -->
            <div class="signup-text-box">
                <h1 class="signup-heading">Sign Up</h1>
                <p class="signup-sub-heading">Start a collection of your favorite entertainment now.</p>
            </div>
            <!-- Form -->
            <form class="form-container" method="POST" enc>
                <div class="inpt-field-box">
                    <label class="inpt-label" for="full_name">Full Name</label>
                    <input class="inpt-field" type="text" id="full_name" class="inpt_fname" name="usr_fname" required placeholder="Enter your full name">
                </div>
                <div class="inpt-field-box">
                    <label class="inpt-label" for="email">Email</label>
                    <input class="inpt-field" type="email" id="email" class="inpt_email" name="usr_email" required placeholder="yourname@email.com">
                </div>
                <div class="inpt-field-box pass-field">
                    <label class="inpt-label" for="password">Password</label>
                    <input class="inpt-field" type="password" id="password" class="inpt_password" required placeholder="Create password" minLength="8" maxLength="72">
                </div>
                <p class="pass-length-info">Between 8 and 72 characters</p>
                <button class="join-btn" type="submit" name="join">Join now</button>
            </form>
            <p class="is-user">Already have an account? <a href="./login.php">Log in</a></p>
        </section>
    </main>
    <?php
    // Footer template
    index_footer();
    ?>
</body>

</html>