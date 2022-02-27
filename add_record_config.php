<?php
function upload_image($inpt_img_key)
{
    /* Upload file configuration
    *@inpt_img_key - name attribute of the file input field.
    *@upload_dir - filepath where the image will be stored
    */
    // Check and create image directory if it does not exist 
    // Directory where the image is going to be stored
    $upload_dir = "./gread_images/" . $_SESSION['active_user'] . '/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir);
    }
    // Path of the file to be uploaded
    $target_file = $upload_dir . basename($_FILES[$inpt_img_key]["name"]);
    $uploadOk = 0;
    // Type extension of the file
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check file upload error code
    $phpFileUploadErrors = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );
    if ($_FILES[$inpt_img_key]['error'] !== 0) {
        $error_code = $_FILES[$inpt_img_key]['error'];
        $_SESSION['error'] = $phpFileUploadErrors[$error_code];
        $uploadOk = 1;
        header("Location: " . $_SERVER['PHP_SELF']);
        return;
    }
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$inpt_img_key]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 0;
        } else {
            $_SESSION['error'] = "File is not an image.";
            $uploadOk = 1;
            header("Location: " . $_SERVER['PHP_SELF']);
            return;
        }
    }
    // Check file size
    if ($_FILES[$inpt_img_key]["size"] > 2000000) {
        $_SESSION['error'] = "Sorry, your file is too large.";
        $uploadOk = 1;
        header("Location: " . $_SERVER['PHP_SELF']);
        return;
    }
    // Limit file type
    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 1;
        header("Location: " . $_SERVER['PHP_SELF']);
        return;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        $_SESSION['error'] = "Sorry, your file was not uploaded.";
        header("Location: " . $_SERVER['PHP_SELF']);
        return;
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$inpt_img_key]["tmp_name"], $target_file)) {
            $_SESSION['upload_success'] = "The file " . htmlspecialchars(basename($_FILES[$inpt_img_key]["name"])) . " has been uploaded.";
            header("./about.php");
            return;
        } else {
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
            header("Location: " . $_SERVER['PHP_SELF']);
            return;
        }
    }
}

function add_record($inpt_img_key)
{
    require_once "./utilities/pdo/pdo.php";
    /* Adds user gread record in database
    * @inpt_img_key -  name attribute of the file input field.
    */
    // Form data
    $title = $_POST['add_title'];
    $description = $_POST['add_description'];
    // Image upload data needed
    $filename = $_FILES[$inpt_img_key]['name'];
    $size = $_FILES[$inpt_img_key]['size'];
    $filepath = "./gread_images/" . $_SESSION['active_user'] . '/' . basename($filename);
    $error = $_FILES[$inpt_img_key]['error'];
    $user_id = $_SESSION['user_id'];

    // Upload image in server
    upload_image($inpt_img_key);
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
        $gread_query = "INSERT INTO gread (gread_img_id, user_id, title, description)
        VALUES(:gread_img_id, :user_id, :gread_title, :gread_description)";
        $gread_query_stmt = $pdo->prepare($gread_query);
        $gread_query_stmt->execute(array(
            ':gread_img_id' => $gread_img_id,
            ':user_id' => $user_id,
            ':gread_title' => $title,
            ':gread_description' => $description
        ));
        // Unset upload_success
        unset($_SESSION['upload_success']);
    }
}
