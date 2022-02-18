<?php
require_once "./utilities/php_snippets/header.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="charset" content="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Roweme B. Santos">
    <title>About | Your library of entertainment</title>
    <link rel="icon" href="./assets/logo/brand_logo.png">
    <link rel="stylesheet" href="./utilities/css/component_style.css">
    <link rel="stylesheet" href="./utilities/css/header.css">
    <link rel="stylesheet" href="./utilities/css/media_query.css">
    <link rel="stylesheet" href="./utilities/css/about.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    // Check if user is logged in
    if (isset($_SESSION['user'])) {
        // call logged_header()
    } else {
        index_header('about');
    }
    ?>
    <main class="main-container">
        <section class="about-container">
            <h1 class="main-heading">About</h1>
            <div class="about-text-box">
                <p class="about-text">
                    Gread is an online application that allows you to save all of your favorite entertainments information. You don't need to worry about remembering their basic information.
                </p>
            </div>
        </section>
    </main>
    <script src="./utilities/js/index.js"></script>
    <script src="./utilities/js/navigation.js"></script>
</body>

</html>