<?php
function edit_record($inpt_img_key)
{
    require_once "./utilities/pdo/pdo.php";
    /* Adds user gread record in database
    * @inpt_img_key -  name attribute of the file input field.
    */
    // Form data
    $title = $_POST['add_title'];
    $description = $_POST['add_description'];
    // Image upload data needed
    $filename = urlencode($_FILES[$inpt_img_key]['name']);
    $size = $_FILES[$inpt_img_key]['size'];
    $filepath = "./gread_images/" . $_SESSION['active_user'] . '/' . $filename;
    $error = $_FILES[$inpt_img_key]['error'];
    $user_id = $_SESSION['user_id'];

    // Upload image in server
    upload_image($inpt_img_key, $filename);
    // Check if image upload is successful
    if (isset($_SESSION['upload_success'])) {
        // Store img data in 'gread_img' table
        $gread_img_query = "INSERT INTO gread_img (filename, size, filepath, error)
        VALUES (:img_name, :img_size, :img_filepath, :img_error_code)";
        $img_stmt = $pdo->prepare($gread_img_query);
        $img_stmt->execute(array(
            ':img_name' => $filename,
            ':img_size' => $size,
            ':img_filepath' => $filepath,
            ':img_error_code' => $error
        ));
        // Get gread_img_id
        $gread_img_id_query = "SELECT gread_img_id FROM gread_img
        WHERE filename = :img_name AND size = :img_size AND filepath = :img_filepath";
        $gread_img_id_stmt = $pdo->prepare($gread_img_id_query);
        $gread_img_id_stmt->execute(array(
            ':img_name' => $filename,
            ':img_size' => $size,
            'img_filepath' => $filepath
        ));
        $gread_img_row = $gread_img_id_stmt->fetch(PDO::FETCH_ASSOC);
        $gread_img_id = $gread_img_row['gread_img_id'];
        // Store title and description and  in 'gread' table
        $gread_query = "INSERT INTO gread (gread_img_id, user_id, title, description, date_recorded)
        VALUES(:gread_img_id, :user_id, :gread_title, :gread_description, :date_of_record)";
        $gread_query_stmt = $pdo->prepare($gread_query);
        $gread_query_stmt->execute(array(
            ':gread_img_id' => $gread_img_id,
            ':user_id' => $user_id,
            ':gread_title' => $title,
            ':gread_description' => $description,
            ':date_of_record' => date("Y-m-d") . ' ' . date("H:i:s")
        ));
        // Unset upload_success
        unset($_SESSION['upload_success']);
    }
}
