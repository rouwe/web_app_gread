<?php
// Input validation
function validate_input_length($inputArray)
{
    for ($i = 0; $i < count($inputArray); $i++) {
        // Validate inputs length
        if (
            strlen($inputArray[$i]) < 1
        ) {
            $_SESSION['error'] = 'All fields are required. Please try again.';
            header("Location: " . $_SERVER['PHP_SELF']);
            return false;
        }
        return true;
    }
}
// Flash notification
function flash_message()
{
    // Displays a message and removes it in session after reloading
    if (isset($_SESSION['error'])) {
        echo ('<p class="notification-message" style="color:red;">' . $_SESSION["error"] . "</p>\n");
        unset($_SESSION['error']);
    } elseif (isset($_SESSION['success'])) {
        echo ('<p class="notification-message" style="color:green;">' . $_SESSION['success'] . "</p>\n");
        unset($_SESSION['success']);
    }
}
function search_redirect($get_query = null)
{
    // Redirect back to homepage and search
    if ($get_query !== null) {
        header("Location: ./?query=" . $get_query);
        return;
    }
}
