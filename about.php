<?php
session_start();
require_once "./utilities/php_snippets/header.php";
require_once "./utilities/php_snippets/helper.php";
if (isset($_GET['query'])) {
  // Redirect to home
  search_redirect($_GET['query']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="charset" content="utf-8">
  <meta name="keywords" content="Entertainment, Anime, manga, novel, movie, books, podcast">
  <meta name="description" content="Collect all of your favorite entertainment in one place.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Roweme B. Santos">
  <title>About | Your library of entertainment</title>
  <link rel="icon" href="./assets/logo/brand_logo.png">
  <link rel="stylesheet" href="./utilities/css/component_style.css">
  <link rel="stylesheet" href="./utilities/css/dashboard_header.css">
  <link rel="stylesheet" href="./utilities/css/index_header.css">
  <link rel="stylesheet" href="./utilities/css/media_query.css">
  <link rel="stylesheet" href="./utilities/css/about.css">
  <?php
  if (isset($_SESSION['active_user'])) {
    echo ('<link rel="stylesheet" href="./utilities//css/dashboard.css">');
  }
  ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
  <?php
  // Header
  // Check if user is logged in
  if (isset($_SESSION['active_user'])) {
    dashboard_header();
  } else {
    index_header('about');
  }
  ?>
  <?php
  // Exempt page from activePage js if user not logged in
  if (isset($_SESSION['active_user'])) {
    echo ('<main class="main-container">');
  } else {
    echo ('<main id="default-home" class="main-container">');
  }
  ?>
  <?php
  if (isset($_SESSION['active_user'])) {
    echo ('<!-- Navigation -->
        <nav class="navigation">
          <div class="navigation-outline">
            <!-- Mobile Search -->
            <div class="mobile-search-container d-nav-box">
              <div class="mobile-search-box">
                <input class="mobile-search-field" type="text" name="mobile-search" placeholder="Search something..." aria-label="Mobile search">
                <button type="button" class="search-button">
                  <i>
                    <svg class="mobile-search-icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M13.125 22.3125C18.1991 22.3125 22.3125 18.1991 22.3125 13.125C22.3125 8.05088 18.1991 3.9375 13.125 3.9375C8.05088 3.9375 3.9375 8.05088 3.9375 13.125C3.9375 18.1991 8.05088 22.3125 13.125 22.3125Z" stroke="#959595" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M19.6875 19.6875L27.5625 27.5625" stroke="#959595" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </i>
                </button>
              </div>
            </div>
            <!-- Actions -->
            <div class="navigation-actions d-nav-box">
              <!-- Home -->
              <a id="home" class="action-link" href="./" title="Home">
                <div class="action-box">
                  <svg class="action-icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25.8018 12.7327L16.6143 4.69364C16.1194 4.26065 15.3806 4.26065 14.8857 4.69364L5.69821 12.7327C5.41338 12.9819 5.25 13.342 5.25 13.7205V24.9374C5.25 25.6623 5.83763 26.2499 6.5625 26.2499H11.8125C12.5374 26.2499 13.125 25.6623 13.125 24.9374V19.6874C13.125 18.9625 13.7126 18.3749 14.4375 18.3749H17.0625C17.7874 18.3749 18.375 18.9625 18.375 19.6874V24.9374C18.375 25.6623 18.9626 26.2499 19.6875 26.2499H24.9375C25.6624 26.2499 26.25 25.6623 26.25 24.9374V13.7205C26.25 13.342 26.0866 12.9819 25.8018 12.7327Z" stroke="#4A4A4A" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
              </a>
              <!-- Add -->
              <a id="add" class="action-link" href="./add.php" title="Add">
                <div class="action-box">
                  <svg class="action-icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.5 15.75H21M15.75 21V10.5M24.9375 26.25L6.5625 26.25C5.83763 26.25 5.25 25.6624 5.25 24.9375L5.25 6.5625C5.25 5.83763 5.83763 5.25 6.5625 5.25L24.9375 5.25C25.6624 5.25 26.25 5.83763 26.25 6.5625L26.25 24.9375C26.25 25.6624 25.6624 26.25 24.9375 26.25Z" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>     
                </div>
              </a>
              <!-- Edit -->
              <button id="edit" class="action-link" title="Edit">
                <div class="action-box">
                  <svg class="action-icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M26.25 18.375V24.9375C26.25 25.6624 25.6624 26.25 24.9375 26.25H6.5625C5.83763 26.25 5.25 25.6624 5.25 24.9375V6.5625C5.25 5.83763 5.83763 5.25 6.5625 5.25H13.125M21 6.5625L24.9375 10.5M17.0625 18.375H13.125V14.4375L24.9375 2.625L28.875 6.5625L17.0625 18.375Z" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
              </button>
              <!-- Delete -->
              <button id="delete" class="action-link" title="Delete">
                <div class="action-box">
                  <svg class="action-icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.25 7.875H26.25M7.875 7.875H23.625V26.25C23.625 26.9749 23.0374 27.5625 22.3125 27.5625H9.1875C8.46263 27.5625 7.875 26.9749 7.875 26.25V7.875ZM11.8125 3.9375H19.6875C20.4124 3.9375 21 4.52513 21 5.25V7.875H10.5V5.25C10.5 4.52513 11.0876 3.9375 11.8125 3.9375Z" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
              </button>
              <!-- Info -->
              <a id="about" class="action-link" href="./about.php" title="About">
                <div class="action-box info-box">
                  <svg class="action-icon" width="32" height="32" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.75 12.4375V19M25.5625 13.75C25.5625 20.2739 20.2739 25.5625 13.75 25.5625C7.22615 25.5625 1.93752 20.2739 1.93752 13.75C1.93752 7.22614 7.22615 1.9375 13.75 1.9375C20.2739 1.9375 25.5625 7.22614 25.5625 13.75ZM13.6846 8.49996H13.8159V8.63121H13.6846V8.49996Z" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </div>
              </a>
            </div>
          </div>
        </nav>');
  }
  ?>
  <!-- About -->
  <section class="about-container">
    <!-- Heading -->
    <div class="about-heading-box">
      <h1 class="main-heading">About</h1>
      <hr class="about-divider">
    </div>
    <!-- About Content -->
    <div class="about-text-box">
      <p class="about-text">
        <span class="gread-word">Gread</span> is an online application that allows you to save all of your favorite entertainments information. You don't need to worry about remembering their basic information.
      </p>
    </div>
  </section>
  </main>
  <script src="./utilities/js/index.js"></script>
  <script src="./utilities/js/navigation.js"></script>
</body>

</html>