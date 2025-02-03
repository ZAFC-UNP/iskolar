<?php
include('includes/dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $email = $_POST['email'];
    $idNum = $_POST['idNum'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "Passwords do not match";
        exit;
    }

    // Check if email is already in user table
    $queryCheck = "SELECT * FROM user WHERE email = ?";
    $stmtCheck = $conn->prepare($queryCheck);
    $stmtCheck->bind_param("s", $email);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    if ($resultCheck->num_rows > 0) {
        header('Location: auth/error_register.php');
        exit;
    }

    // Retrieve upId from userprofile table based on idNum or email
    $queryProfile = "SELECT upId FROM userprofile WHERE idNum = ? OR email = ?";
    $stmtProfile = $conn->prepare($queryProfile);
    $stmtProfile->bind_param("ss", $idNum, $email);
    $stmtProfile->execute();
    $resultProfile = $stmtProfile->get_result();

    if ($resultProfile->num_rows == 0) {
        echo "No matching user profile found.";
        exit;
    }

    // Get the upId
    $rowProfile = $resultProfile->fetch_assoc();
    $upId = $rowProfile['upId'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Handle Avatar Upload
$avatar_path = 'uploads/avatars/default_avatar.jpg'; // Default avatar path
if (isset($_FILES['avatar']) && $_FILES['avatar']['size'] > 0) {
    // Check for upload errors
    if ($_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
        echo "Error uploading file: " . $_FILES['avatar']['error'];
        exit;
    }
    
    $avatar_tmp = $_FILES['avatar']['tmp_name'];
    $avatar_name = $_FILES['avatar']['name'];
    $avatar_ext = pathinfo($avatar_name, PATHINFO_EXTENSION);
    $avatar_filename = $idNum . '.' . $avatar_ext;
    $avatar_path = 'uploads/avatars/' . $avatar_filename;

    // Check if the uploads/avatars directory exists
    if (!is_dir('uploads/avatars')) {
        mkdir('uploads/avatars', 0777, true); // Create the directory if it doesn't exist
    }

    // Move the uploaded file and check for success
    if (!move_uploaded_file($avatar_tmp, $avatar_path)) {
        echo "Failed to move uploaded file to $avatar_path";
        exit;
    }
}

    // Insert into user table
    $queryUser = "INSERT INTO user (upId, username, email, password, photo_path, userType, position) VALUES (?,?,?,?,?, 'pending' , 'student')";
    $stmtUser = $conn->prepare($queryUser);

    if ($stmtUser === false) {
        echo "Failed to prepare the SQL statement for user: " . $conn->error;
        exit;
    }

    // Bind parameters for user table insertion
    $stmtUser->bind_param("issss", $upId, $idNum, $email, $hashed_password, $avatar_path);

    try {
        $stmtUser->execute();
        echo "User account created successfully for username: " . $idNum;

        $adminId = '21-03561'; // Replace with the actual admin ID
        $message = "A new scholar ($idNum) has registered.";

        // Insert into notifications
        $queryNotification = "INSERT INTO notifications (user_id, message, status, created_at) VALUES (?, ?, 0, NOW())";
        $stmtNotification = $conn->prepare($queryNotification);
        $stmtNotification->bind_param("ss", $adminId, $message);

        if ($stmtNotification->execute()) {
            echo "Notification sent to admin.";
        } else {
            echo "Failed to send notification.";
        }
    } catch (Exception $e) {
        echo "Error creating user account: " . $e->getMessage();
    }
}

$conn->close();
?>
