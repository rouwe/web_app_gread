<?php
function edit_record($inpt_img_key, $old_thumbnail_data, $gread_id, $gread_img_id, $old_date_recorded)
{
    require_once "./utilities/pdo/pdo.php";
    require_once "./add_record_config.php";
    global $pdo;
    /* Updates user gread record in database
    * @inpt_img_key -  name attribute of the file input field.
    * @old_thumbnail_data
    */
    // Form data (If no new text => value is default)
    $title = trim($_POST['add_title']);
    $description = trim($_POST['add_description']);
    // Current thumbnail data
    $filename = $old_thumbnail_data['filename'];
    $size = $old_thumbnail_data['size'];
    $error = $old_thumbnail_data['error'];
    $user_id = $_SESSION['user_id'];
    // Check if there's new thumbnail and overwrite old
    if (isset($_FILES[$inpt_img_key]['name'])) {
        if (strlen($_FILES[$inpt_img_key]['name']) != 0) {
            // Upload image in server
            $size = $_FILES[$inpt_img_key]['size'];
            $error = $_FILES[$inpt_img_key]['error'];
            upload_image($inpt_img_key, $filename);
        }
    }
    // New thumbnail successfuly moved to user image dir
    $new_date_recorded = date("Y-m-d H:i:s");
    if (isset($_SESSION['upload_success'])) {
        // Update gread img in database
        $update_query = "UPDATE gread_img
            SET filename = :old_filename, size = :new_size, error = :new_error,
            date_recorded = :new_date
            WHERE gread_img_id = :img_id AND date_recorded = :old_date_recorded";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->execute(array(
            ':old_filename' => $filename,
            ':new_size' => $size,
            ':new_error' => $error,
            ':new_date' => $new_date_recorded,
            ':img_id' => $gread_img_id,
            ':old_date_recorded' => $old_date_recorded
        ));
    }
    // If there's no new image, sync the date recorded column to match with gread table
    $update_date_recorded_query = "UPDATE gread_img
    SET date_recorded = :new_date
    WHERE gread_img_id = :img_id AND date_recorded = :old_date_recorded";
    $update_date_stmt = $pdo->prepare($update_date_recorded_query);
    $update_date_stmt->execute(array(
        ':new_date' => $new_date_recorded,
        ':img_id' => $gread_img_id,
        ':old_date_recorded' => $old_date_recorded
    ));
    // // Update gread title and description
    $update_query = "UPDATE gread
        SET title = :new_title, description = :new_description, date_recorded = :date_recorded
        WHERE gread_id = :gread_id AND gread_img_id = :img_id AND user_id = :uid";
    $update_stmt = $pdo->prepare($update_query);
    $update_stmt->execute(array(
        ':new_title' => $title,
        ':new_description' => $description,
        ':date_recorded' => $new_date_recorded,
        ':gread_id' => $gread_id,
        ':img_id' => $gread_img_id,
        ':uid' => $user_id
    ));
    unset($_SESSION['upload_success']);
}
