<?php
session_start();
require_once "./utilities/pdo/pdo.php";
require_once "./utilities/php_snippets/helper.php";
require_once "./utilities/php_snippets/header.php";
require_once "./utilities/php_snippets/footer.php";
// Check input field
if (
    isset($_POST['usr_fname']) &&
    isset($_POST['usr_email']) &&
    isset($_POST['usr_password'])
) {
    $usr_inputs = array($_POST['usr_fname'], $_POST['usr_email'], $_POST['usr_password']);
    // Validate input
    validateinput($usr_inputs);
    // BCRYPT php password hashing and salting
    $options = array(
        'cost' => 9
    );
    $new_usr_hash_password = password_hash($_POST['usr_password'], PASSWORD_BCRYPT, $options);
    // Inserts data in users table
    $insert_query = "INSERT INTO users (name, email, password, hash)
    VALUES (:usr_name, :usr_email, :usr_password, :password_hash)";
    $stmt = $pdo->prepare($insert_query);
    $stmt->execute(array(
        ':usr_name' => $_POST['usr_fname'],
        ':usr_email' => $_POST['usr_email'],
        ':usr_password' => $_POST['usr_password'],
        ':password_hash' => $new_usr_hash_password
    ));
    // Store data in session to be passed in login
    $_SESSION['signup_credentials'] = array(
        'fname' => $_POST['usr_fname'],
        'email' => $_POST['usr_email'],
        'password' => $_POST['usr_password'],
        'password_hash' => $new_usr_hash_password
    );
    // Redirect to login page
    header("Location: ./login.php");
    return;
}
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
            <div class="form-text-box">
                <h1 class="form-heading">Sign Up</h1>
                <p class="form-sub-heading">Start a collection of your favorite entertainment now.</p>
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
                    <input class="inpt-field" type="password" id="password" name="usr_password" required placeholder="Create password" minLength="8" maxLength="72">
                </div>
                <p class="pass-length-info">Between 8 and 72 characters</p>
                <?php
                // Flash message
                flash_message();
                ?>
                <button class="join-btn" type="submit" name="join">Join now</button>
            </form>
            <hr class="join-divider signup-divider">
            <p class="is-user">Already have an account? <a href="./login.php">Log in</a></p>
        </section>
    </main>
    <?php
    // Footer template
    index_footer();
    ?>
</body>

</html>