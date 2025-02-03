<?php
// Include your database connection file
include('includes/dbcon.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $idNum = $_POST['idNum']; //hidden input
    $verify_token = $_POST['verify_token']; //hidden input
    $email = $_POST['email'];
    $schoolYear = $_POST['schoolYear'];
    $year = $_POST['year'];
    $sem = $_POST['sem'];
    $noOfUnits = $_POST['noOfUnits'];
    $noOfSubjects = $_POST['noOfSubjects'];
    $grade = $_POST['grade'];
    $upId = $_POST['upId'];

    // Prepare the SQL statement to update user profile
    $sql = "UPDATE userprofile up
            INNER JOIN user u ON up.upId = u.upId
            SET 
                up.schoolYear = ?, 
                up.year = ?,
                up.sem = ?, 
                up.noOfUnits = ?, 
                up.noOfSubjects = ?, 
                up.grade = ?  
            WHERE up.idNum = ? AND up.verify_token = ?";

    $stmt = $conn->prepare($sql); // Prepare the statement
    if (!$stmt) {
        $_SESSION['status'] = "Database error: " . $conn->error;
        header('Location: http://localhost/iskolar/update.php');
        exit();
    }

    $stmt->bind_param("sssiisss", $schoolYear, $year, $sem, $noOfUnits, $noOfSubjects, $grade, $idNum, $verify_token);

    // Execute the statement
    if ($stmt->execute()) {
        // Get the user's `upId` from `userprofile` using `idNum`
        $sql = "SELECT upId, dob FROM userprofile WHERE idNum = ? AND verify_token = ?";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param("ss", $idNum, $verify_token);
        $stmt2->execute();
        $stmt2->bind_result($upId, $dob);
        $stmt2->fetch();
        $stmt2->close();

        // Calculate age from birthdate
        if ($dob) {
            $dobDateTime = new DateTime($dob);
            $currentDateTime = new DateTime();
            $age = $dobDateTime->diff($currentDateTime)->y;

            // Update age in userprofile table
            $updateAgeSql = "UPDATE userprofile SET age = ? WHERE upId = ?";
            $stmt3 = $conn->prepare($updateAgeSql);
            $stmt3->bind_param("ii", $age, $upId);
            $stmt3->execute();
            $stmt3->close();
        }

// Handle file uploads
$uploadsDir = "uploads/$idNum";
if (!is_dir($uploadsDir)) {
    mkdir($uploadsDir, 0777, true);
}

$files = [
    'certOfScholarship' => 'COS',
    'grades' => 'Grades',
    'cor' => 'COR'
];
$fileYear = date('Y');
$currentMonth = (int)date('m'); // Current month as integer (1 - 12)
$fileSemester = ($currentMonth >= 8 && $currentMonth <= 12) ? '1st_sem' : '2nd_sem';

foreach ($files as $inputName => $fileSuffix) {
    $newFileName = ''; // Initialize newFileName for each iteration

    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES[$inputName]['tmp_name'];
        $baseFileName = $idNum . "_$fileSuffix" . "_$fileYear($fileSemester).pdf";
        $destPath = $uploadsDir . DIRECTORY_SEPARATOR . $baseFileName;

        // Check if file already exists and append (2), (3), etc.
        $counter = 1;
        while (file_exists($destPath)) {
            $fileNameParts = pathinfo($baseFileName);
            $baseName = $fileNameParts['filename'];
            $extension = $fileNameParts['extension'];
            $newFileName = $baseName . "($counter)." . $extension;
            $destPath = $uploadsDir . DIRECTORY_SEPARATOR . $newFileName;
            $counter++;
        }

        // Set the new file name to the final destination path
        $newFileName = $baseFileName; // Keep the original base file name

        // Debugging: Output the filename being used
        echo "Final Filename: " . $newFileName . "<br>";

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $fileType = $_FILES[$inputName]['type'];
            $fileSize = $_FILES[$inputName]['size'];
            $uploadDate = date('Y-m-d H:i:s');

            // Insert new file details into user_files table
            $insertSql = "INSERT INTO user_files (upId, file_name, file_path, file_type, file_size, upload_date) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt4 = $conn->prepare($insertSql);
            if ($stmt4 === false) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt4->bind_param("ssssss", $upId, $newFileName, $destPath, $fileType, $fileSize, $uploadDate);

            // Debugging: Output the values being bound
            echo "Binding Params: $upId, $newFileName, $destPath, $fileType, $fileSize, $uploadDate<br>";

            if ($stmt4->execute()) {
                $stmt4->close();
            } else {
                echo "Database error: " . $stmt4->error;
            }
        } else {
            $_SESSION['status'] = "Error uploading $inputName";
            header('Location: http://localhost/iskolar/update.php');
            exit();
        }
    }
}

        // Prepare the SQL query
$updateUserTypeQuery = "UPDATE user u
INNER JOIN userprofile up ON u.upId = up.upId
SET u.userType = 'pending'
WHERE up.email = ? AND up.idNum = ?";

// Prepare the statement
$stmt = $conn->prepare($updateUserTypeQuery);

if ($stmt === false) {
die("Prepare failed: " . $conn->error);
}

// Bind the parameters (assuming email and idNum are strings)
$stmt->bind_param("ss", $email, $idNum);

echo "Executing query with email: $email and idNum: $idNum<br>";
// Execute the statement
if (!$stmt->execute()) {
die("Execute failed: " . $stmt->error);
}

// Check if any rows were affected
if ($stmt->affected_rows === 0) {
echo "No rows updated. Verify that email and idNum are correct.";
} else {
echo "User updated successfully.";
}

// Close the statement
$stmt->close();

        // Insert notification
        $adminId = '21-03561'; // Replace with the actual admin ID
        $message = "A scholar, ($idNum) has updated their academic information.";

        $queryNotification = "INSERT INTO notifications (user_id, message, status, created_at) VALUES (?, ?, 0, NOW())";
        $stmtNotification = $conn->prepare($queryNotification);

        if ($stmtNotification === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmtNotification->bind_param("ss", $adminId, $message);

        if ($stmtNotification->execute()) {
            echo "Notification sent to admin.";
        } else {
            echo "Failed to send notification: " . $stmtNotification->error;
        }

$stmtNotification->close();
        $_SESSION['status'] = "Academic information updated successfully!";
        header('Location: http://localhost/iskolar/auth/success.php');
        exit();
    } else {
        $_SESSION['status'] = "Error updating information!";
        header('Location: http://localhost/iskolar/update.php');
        exit();  
    }
    
    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
