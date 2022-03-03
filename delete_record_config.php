<?php
function verify_user_record($gread_id, $gread_img_id)
{
    require_once "./utilities/pdo/pdo.php";
    global $pdo;
    // Verify record data if exists and matches active user identifier and current GET arguments 
    $query_user = "SELECT COUNT(*) FROM gread
    WHERE user_id = :uid AND gread_id = :gread_id AND gread_img_id = :gread_img_id";
    $verify_stmt = $pdo->prepare($query_user);
    $verify_stmt->execute(array(
        ':uid' => $_SESSION['user_id'],
        ':gread_id' => $gread_id,
        ':gread_img_id' => $gread_img_id
    ));
    $row_count = $verify_stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row_count['COUNT(*)'] > 0) {
        $_SESSION['error'] = "No record found.";
        return false;
    }
    // Verify user email
    $query_email = "SELECT email FROM users
    WHERE user_id = :uid";
    $email_stmt = $pdo->prepare($query_email);
    $email_stmt->execute(array(
        ':uid' => $_SESSION['user_id']
    ));
    $email_row = $email_stmt->fetch(PDO::FETCH_ASSOC);
    $db_email = $email_row['email'];
    if (strlen($db_email) > 0) {
        if (!$db_email == $_SESSION['active_user']) {
            $_SESSION['error'] = "You don't have permission to delete this record.";
            return false;
        }
    } else {
        $_SESSION['error'] = "You don't have permission to delete this record.";
        return false;
    }
    return true;
}
function delete_record($gread_id, $gread_img_id, $thumbnail_info)
{
    require_once "./utilities/pdo/pdo.php";
    global $pdo;
    $user_id = $_SESSION['user_id'];
    $filename = $thumbnail_info['filename'];
    $filepath = $thumbnail_info['filepath'];
    $fullpath = $filepath . $filename;
    $size = $thumbnail_info['size'];
    $error = $thumbnail_info['error'];
    // Delete gread record
    $delete_gread_query = "DELETE FROM gread
    WHERE user_id = :uid AND gread_id = :gread_id AND gread_img_id = :gread_img_id";
    $delete_gread_stmt = $pdo->prepare($delete_gread_query);
    $delete_gread_stmt->execute(array(
        ':uid' => $user_id,
        ':gread_id' => $gread_id,
        ':gread_img_id' => $gread_img_id
    ));
    // Delete gread thumbnail record
    $delete_thumbnail_query = "DELETE FROM gread_img
    WHERE gread_img_id = :gread_img_id AND filename = :thumbnail_name
    AND size = :thumbnail_size AND filepath = :thumbnail_filepath AND error = :thumbnail_error";
    $delete_thumbnail_stmt = $pdo->prepare($delete_thumbnail_query);
    $delete_thumbnail_stmt->execute(array(
        ':gread_img_id' => $gread_img_id,
        ':thumbnail_name' => $filename,
        ':thumbnail_size' => $size,
        ':thumbnail_filepath' => $filepath,
        'thumbnail_error' => $error
    ));
    // Delete thumbnail file in directory
    $thumbnail_exists = file_exists($fullpath);
    // clearstatcache($fullpath);
    if ($thumbnail_exists) {
        $realpath = realpath($fullpath);
        unlink($realpath);
        return true;
    }
}
