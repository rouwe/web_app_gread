<?php
session_start();
require_once "./utilities/pdo/pdo.php";
require_once "./utilities/php_snippets/header.php";
require_once "./utilities/php_snippets/helper.php";
require_once "./utilities/php_snippets/static_contents.php";
require_once "./utilities/php_snippets/footer.php";
if (isset($_SESSION['active_user'])) {
  // Fetch all data associated with current user
  // Query gread table
  $query = "SELECT gread_id, gread_img_id, title, date_recorded, description FROM gread
  WHERE user_id = :uid
  ORDER BY date_recorded DESC";
  $gread_stmt = $pdo->prepare($query);
  $gread_stmt->execute(array(
    ':uid' => $_SESSION['user_id']
  ));
  $gread_rows = $gread_stmt->fetchAll(PDO::FETCH_ASSOC);
  // Get total records count
  $query_count = "SELECT COUNT(*) FROM gread
      WHERE user_id = :uid";
  $query_stmt = $pdo->prepare($query_count);
  $query_stmt->execute(array(
    ':uid' => $_SESSION['user_id']
  ));
  $count_row = $query_stmt->fetch(PDO::FETCH_ASSOC);
  $record_count = $count_row['COUNT(*)'];
  // Record limit per page
  $records_per_page = 10;
  $pagination_count = ceil($record_count / $records_per_page);
  // Set previous row number
  if (
    !isset($_GET['page']) ||
    !isset($_SESSION['previous_row_number'])
  ) {
    $_SESSION['previous_row_number'] = 0;
  } else {
    // Adjusts the previous_row_number by subtracting 1 (page=1) when GET['page'] value is true and it's not 1
    $_SESSION['previous_row_number'] = ($_GET['page'] - 1) * $records_per_page;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="charset" content="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Roweme B. Santos">
  <title>Gread | Your library of entertainment</title>
  <link rel="icon" href="./assets/logo/brand_logo.png">
  <link rel="stylesheet" href="./utilities/css/component_style.css">
  <link rel="stylesheet" href="./utilities/css/index_header.css">
  <link rel="stylesheet" href="./utilities/css/media_query.css">
  <?php
  if (isset($_SESSION['active_user'])) {
    // get dashboard style
    echo ('<link rel="stylesheet" href="./utilities/css/dashboard_header.css">');
    echo ('<link rel="stylesheet" href="./utilities/css/dashboard.css">');
  } else {
    echo ('<link rel="stylesheet" href="./utilities/css/footer.css">');
    echo ('<link rel="stylesheet" href="./utilities/css/index.css">');
  }
  ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Raleway:wght@300;400;500;600;700;800&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
  <?php
  // Check if user is logged in
  if (isset($_SESSION['active_user'])) {
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
      </nav>
      <!-- Gread Content Header -->
      <div class="gread-content-container">
        <!-- Content Header -->
        <div class="gread-content-header">
          <!-- Heading -->
          <div class="gread-header-box">
            <h1 class="gread-header">Anime</h1>
            <svg class="active-gread-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M19.7071 9.70711C20.0976 9.31658 20.0976 8.68342 19.7071 8.29289C19.3166 7.90237 18.6834 7.90237 18.2929 8.29289L19.7071 9.70711ZM12 16L11.2929 16.7071C11.4804 16.8946 11.7348 17 12 17C12.2652 17 12.5196 16.8946 12.7071 16.7071L12 16ZM5.70711 8.29289C5.31658 7.90237 4.68342 7.90237 4.29289 8.29289C3.90237 8.68342 3.90237 9.31658 4.29289 9.70711L5.70711 8.29289ZM18.2929 8.29289L11.2929 15.2929L12.7071 16.7071L19.7071 9.70711L18.2929 8.29289ZM12.7071 15.2929L5.70711 8.29289L4.29289 9.70711L11.2929 16.7071L12.7071 15.2929Z" fill="#4A4A4A" />
            </svg>
          </div>
          <!-- Filter -->
          <div class="filter-box">
            <span class="current-filter">Most recent</span>
            <svg class="filter-arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M19.7071 9.70711C20.0976 9.31658 20.0976 8.68342 19.7071 8.29289C19.3166 7.90237 18.6834 7.90237 18.2929 8.29289L19.7071 9.70711ZM12 16L11.2929 16.7071C11.4804 16.8946 11.7348 17 12 17C12.2652 17 12.5196 16.8946 12.7071 16.7071L12 16ZM5.70711 8.29289C5.31658 7.90237 4.68342 7.90237 4.29289 8.29289C3.90237 8.68342 3.90237 9.31658 4.29289 9.70711L5.70711 8.29289ZM18.2929 8.29289L11.2929 15.2929L12.7071 16.7071L19.7071 9.70711L18.2929 8.29289ZM12.7071 15.2929L5.70711 8.29289L4.29289 9.70711L11.2929 16.7071L12.7071 15.2929Z" fill="#4A4A4A" />
            </svg>
          </div>
          <!-- Divider -->
          <hr class="gread-header-divider">
          <div class="categories-box">
            <button type="button" class="category-option">Anime</button>
            <button type="button" class="category-option">Manga</button>
            <button type="button" class="category-option">Novel</button>
            <button type="button" class="category-option">Others</button>
          </div>
        </div>
        <!-- GREADS -->
        <div class="gread-content-body">');
    for ($i = $_SESSION['previous_row_number']; $i < count($gread_rows); $i++) {
      // Check records per page limiter
      if ($i >= $records_per_page + $_SESSION['previous_row_number']) {
        $_SESSION['previous_row_number'] = $i;
        break;
      }
      $row = $gread_rows[$i];
      // Get gread image
      $img_query = "SELECT filename, filepath FROM gread_img
        WHERE gread_img_id = :gread_img_id";
      $img_stmt = $pdo->prepare($img_query);
      $img_stmt->execute(array(
        ':gread_img_id' => $row['gread_img_id']
      ));
      $img_id = $img_stmt->fetch(PDO::FETCH_ASSOC);
      // Display contents
      $gread_id = $row['gread_id'];
      $gread_img_id = $row['gread_img_id'];
      $title = $row['title'];
      $description = $row['description'];
      $filename = rawurlencode($img_id['filename']);
      $filepath = $img_id['filepath'] . $filename;
      $date_recorded = $row['date_recorded'];
      gread_entry($filepath, $title, $description, $gread_id, $gread_img_id);
    }
    // End <!-- GREADS -->
    echo ('</div>');
    // Pagination
    // There's an incomplete set
    if ($record_count % $records_per_page > 0) {
      pagination($pagination_count + 1);
    } else {
      pagination($pagination_count);
    }
  } else {
    // display landing page
    index_header('index');
    landing_page_content();
    index_footer();
  }
  echo ('</div>');
  ?>
  </main>
  <?php
  // Flash message
  // $_SESSION['error'] = 'Test';
  echo ('<div id="flash-message">');
  echo ('<svg class="notification-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M18 13.18V10C17.9986 8.58312 17.4958 7.21247 16.5806 6.13077C15.6655 5.04908 14.3971 4.32615 13 4.09V3C13 2.73478 12.8946 2.48043 12.7071 2.29289C12.5196 2.10536 12.2652 2 12 2C11.7348 2 11.4804 2.10536 11.2929 2.29289C11.1054 2.48043 11 2.73478 11 3V4.09C9.60294 4.32615 8.33452 5.04908 7.41939 6.13077C6.50425 7.21247 6.00144 8.58312 6 10V13.18C5.41645 13.3863 4.911 13.7681 4.55294 14.2729C4.19488 14.7778 4.00174 15.3811 4 16V18C4 18.2652 4.10536 18.5196 4.29289 18.7071C4.48043 18.8946 4.73478 19 5 19H8.14C8.37028 19.8474 8.873 20.5954 9.5706 21.1287C10.2682 21.6621 11.1219 21.951 12 21.951C12.8781 21.951 13.7318 21.6621 14.4294 21.1287C15.127 20.5954 15.6297 19.8474 15.86 19H19C19.2652 19 19.5196 18.8946 19.7071 18.7071C19.8946 18.5196 20 18.2652 20 18V16C19.9983 15.3811 19.8051 14.7778 19.4471 14.2729C19.089 13.7681 18.5835 13.3863 18 13.18V13.18ZM8 10C8 8.93913 8.42143 7.92172 9.17157 7.17157C9.92172 6.42143 10.9391 6 12 6C13.0609 6 14.0783 6.42143 14.8284 7.17157C15.5786 7.92172 16 8.93913 16 10V13H8V10ZM12 20C11.651 19.9979 11.3086 19.9045 11.0068 19.7291C10.7051 19.5536 10.4545 19.3023 10.28 19H13.72C13.5455 19.3023 13.2949 19.5536 12.9932 19.7291C12.6914 19.9045 12.349 19.9979 12 20ZM18 17H6V16C6 15.7348 6.10536 15.4804 6.29289 15.2929C6.48043 15.1054 6.73478 15 7 15H17C17.2652 15 17.5196 15.1054 17.7071 15.2929C17.8946 15.4804 18 15.7348 18 16V17Z" fill="#4A4A4A"/>
    </svg>
    ');
  flash_message();
  echo ("</div>\n");
  ?>
  <script src="./utilities/js/index.js"></script>
  <script src="./utilities/js/flash.js"></script>
  <script src="./utilities/js/pagination.js"></script>
  <script src="./utilities/js/navigation.js"></script>
</body>

</html>