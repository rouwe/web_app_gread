<?php
session_start();
require_once "./utilities/php_snippets/header.php";
require_once "./utilities/php_snippets/static_contents.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="charset" content="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Roweme B. Santos">
  <title>Add Gread | Your library of entertainment</title>
  <link rel="icon" href="./assets/logo/brand_logo.png">
  <link rel="stylesheet" href="./utilities/css/component_style.css">
  <link rel="stylesheet" href="./utilities/css/index_header.css">
  <link rel="stylesheet" href="./utilities/css/media_query.css">
  <link rel="stylesheet" href="./utilities/css/dashboard_header.css">
  <link rel="stylesheet" href="./utilities/css/dashboard.css">
  <link rel="stylesheet" href="./utilities/css/action.css">
  <link rel="stylesheet" href="./utilities/css/add.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Raleway:wght@300;400;500;600;700;800&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
  <?php
  // Display user dashboard
  dashboard_header();
  echo ('<!-- Main -->
    <main class="main-container">
      <!-- Navigation -->
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
            <a class="action-link" href="./">
              <div class="action-box active-box">
                <svg class="action-icon active-icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M25.8018 12.7327L16.6143 4.69364C16.1194 4.26065 15.3806 4.26065 14.8857 4.69364L5.69821 12.7327C5.41338 12.9819 5.25 13.342 5.25 13.7205V24.9374C5.25 25.6623 5.83763 26.2499 6.5625 26.2499H11.8125C12.5374 26.2499 13.125 25.6623 13.125 24.9374V19.6874C13.125 18.9625 13.7126 18.3749 14.4375 18.3749H17.0625C17.7874 18.3749 18.375 18.9625 18.375 19.6874V24.9374C18.375 25.6623 18.9626 26.2499 19.6875 26.2499H24.9375C25.6624 26.2499 26.25 25.6623 26.25 24.9374V13.7205C26.25 13.342 26.0866 12.9819 25.8018 12.7327Z" stroke="#4A4A4A" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </a>
            <!-- Add -->
            <a class="action-link" href="./add.php">
              <div class="action-box">
                <svg class="action-icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6.5625 26.25L24.9375 26.25C25.6624 26.25 26.25 25.6624 26.25 24.9375L26.25 6.5625C26.25 5.83763 25.6624 5.25 24.9375 5.25L6.5625 5.25C5.83763 5.25 5.25 5.83763 5.25 6.5625L5.25 24.9375C5.25 25.6624 5.83763 26.25 6.5625 26.25Z" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M10.5 15.75H21" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M15.75 21L15.75 10.5" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </a>
            <!-- Edit -->
            <a class="action-link" href="./edit.php">
              <div class="action-box">
                <svg class="action-icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M26.25 18.375V24.9375C26.25 25.6624 25.6624 26.25 24.9375 26.25H6.5625C5.83763 26.25 5.25 25.6624 5.25 24.9375V6.5625C5.25 5.83763 5.83763 5.25 6.5625 5.25H13.125M21 6.5625L24.9375 10.5M17.0625 18.375H13.125V14.4375L24.9375 2.625L28.875 6.5625L17.0625 18.375Z" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </a>
            <!-- Delete -->
            <a class="action-link" href="./delete.php">
              <div class="action-box">
                <svg class="action-icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5.25 7.875H26.25M7.875 7.875H23.625V26.25C23.625 26.9749 23.0374 27.5625 22.3125 27.5625H9.1875C8.46263 27.5625 7.875 26.9749 7.875 26.25V7.875ZM11.8125 3.9375H19.6875C20.4124 3.9375 21 4.52513 21 5.25V7.875H10.5V5.25C10.5 4.52513 11.0876 3.9375 11.8125 3.9375Z" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </a>
            <!-- Info -->
            <a class="action-link" href="./about.php">
              <div class="action-box info-box">
                <svg class="action-icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15.75 27.5625C22.2739 27.5625 27.5625 22.2739 27.5625 15.75C27.5625 9.22614 22.2739 3.9375 15.75 3.9375C9.22615 3.9375 3.93752 9.22614 3.93752 15.75C3.93752 22.2739 9.22615 27.5625 15.75 27.5625Z" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M15.75 14.4375V21" stroke="#4A4A4A" stroke-width="2.83333" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M15.6846 10.5H15.8159V10.6312H15.6846V10.5Z" stroke="#4A4A4A" stroke-width="2.83333" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </a>
          </div>
        </div>
      </nav>
      <!-- Gread Content Header -->
      <section class="gread-content-container">
        <!-- Content Header -->
        <div class="gread-content-header">
          <!-- Heading -->
          <div class="gread-header-box">
            <h1 class="gread-header">Anime</h1>
            <svg class="active-gread-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M19.7071 9.70711C20.0976 9.31658 20.0976 8.68342 19.7071 8.29289C19.3166 7.90237 18.6834 7.90237 18.2929 8.29289L19.7071 9.70711ZM12 16L11.2929 16.7071C11.4804 16.8946 11.7348 17 12 17C12.2652 17 12.5196 16.8946 12.7071 16.7071L12 16ZM5.70711 8.29289C5.31658 7.90237 4.68342 7.90237 4.29289 8.29289C3.90237 8.68342 3.90237 9.31658 4.29289 9.70711L5.70711 8.29289ZM18.2929 8.29289L11.2929 15.2929L12.7071 16.7071L19.7071 9.70711L18.2929 8.29289ZM12.7071 15.2929L5.70711 8.29289L4.29289 9.70711L11.2929 16.7071L12.7071 15.2929Z" fill="#4A4A4A" />
            </svg>
          </div>
          <!-- Divider -->
          <hr class="gread-header-divider">
        </div>
        <!-- GREADS -->
        <div class="gread-content-body">');
  ?>
  <!-- Action heading -->
  <div class="action-heading-box">
    <h2 class="action-heading">New Gread</h2>
  </div>
  <!-- Action content -->
  <div class="action-content-box">
    <svg class="action-close-icon" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M26.2499 26.2499L3.75 3.75" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      <path d="M26.2501 3.75L3.75 26.2501" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    <!-- Preview box -->
    <div class="preview-container">
      <span class="preview-text">Preview</span>
      <!-- Preview -->
      <div class="preview-box">
        <div class="preview-img-box">
          <img class="preview-img" src="./assets/temp_preview.png" alt="">
        </div>
        <!-- Text box -->
        <div class="preview-text-box">
          <span class="preview-title">
            <strong>Gread Title</strong>
          </span>
          <p class="preview-description">Description</p>
        </div>
      </div>
    </div>
    <!-- Add Form -->
    <form class="action-form-container" method="POST" enctype="multipart/form-data">
      <!-- Title -->
      <div class="form-box inpt-title-box">
        <label class="inpt-label" for="title">Title</label>
        <input class="inpt-field inpt-title" type="text" id="title" name="add_title" placeholder="Gread title" required maxlength="128">
      </div>
      <!-- Description -->
      <div class="form-box inpt-description-box">
        <label class="inpt-label" for="description">Description</label>
        <textarea class="inpt-field inpt-description" id="description" name="add_description" placeholder="Gread description" maxlength="256"></textarea>
      </div>
      <!-- Upload Image thumbnail -->
      <div class="inpt-img-box">
        <label class="inpt-label" for="thumbnail">Upload Image</label>
        <input class="inpt-file" type="file" name="add_thumbnail" accept="image/*, image/png, image/jpeg">
      </div>
      <!-- Proceed and Cancel -->
      <div class="decision-box">
        <button class="add-btn" type="submit" name="submit" value="Add">Add</button>
        <button class="cancel-btn" type="submit" name="cancel" value="Cancel">Cancel</button>
      </div>
    </form>
  </div>
  <?php
  // End <!-- GREADS -->
  echo ('</div>');
  ?>
  </main>
  <script src="./utilities/js/index.js"></script>
  <script src="./utilities/js/navigation.js"></script>
</body>

</html>