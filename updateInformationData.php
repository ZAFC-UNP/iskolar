<?php
session_start();
include('includes/dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendmail_verification($idNum, $email, $verify_token, $upId)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'unpiskolar@gmail.com';
    $mail->Password = 'zdzkgzbouwkqudlz';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->addEmbeddedImage('../img/unplogo.png', 'unplogo');
    $mail->addEmbeddedImage('../img/emailFooter.png', 'footer');

    $mail->setFrom('unpiskolar@gmail.com', 'UNP iSkolar Online');
    $mail->addAddress($email);
    $mail->addReplyTo('unpiskolar@gmail.com', 'UNP iSkolar Online');

    $mail->isHTML(true);
    $mail->Subject = "UNP ISKOLAR EMAIL VERIFICATION";
    $email_template = '
    <div style="font-family: Arial, sans-serif; color: #333; text-align: center; padding: 20px; border: 1px solid #e0e0e0; border-radius: 8px; max-width: 600px; margin: 0 auto;">
    <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
        <img src="cid:unplogo" alt="UNP Logo" style="width: 60px; height: 60px; margin-right: 10px;">
        <h2 style="font-size: 20px; color: #28855F; margin: 0;">University of Northern Philippines</h2>
    </div>
        <p style="font-size: 16px; color: #333;">
        Good day ka-iskolar <strong><?php echo htmlspecialchars($idNum); ?></strong>,
    </p>
    <p style="font-size: 16px; color: #555;">
    Your application has been sent. Please wait for the confirmation while the office head is verifying your application. You will be notified as soon as your application has been validated.
    </p>
    <p style="font-size: 14px; color: #555; margin-top: 20px;">
        If you did not sign up for an account, please ignore this email.
    </p>
    <p>
    This is a system generated message. For more inquires, visit us at our office located at 2nd floor of Student Center building.
    </p>
    <p style="font-size: 14px; color: #555; margin-top: 10px;">
        Best regards,<br>
        UNP OSAS-SFAS
    </p>
    <img src="cid:footer" alt="UNP Footer" style="width: 560px; height:100px; margin: 10px;">
</div>
';
    

    $mail->Body = $email_template;
    
    try {
        $mail->send();
        $_SESSION['status'] = "Email verification sent!";
    } catch (Exception $e) {
        $_SESSION['status'] = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all expected POST variables are set
    $expected_fields = ['idNum', 'scholarName', 'year', 'college', 'course', 'lastname', 'middlename', 'firstname', 'suffix', 'civilStatus', 'childrenCount', 'sex', 'noOfUnits', 'noOfSubjects', 'dob', 'region', 'province', 'city', 'barangay'];
    foreach ($expected_fields as $field) {
        if (!isset($_POST[$field])) {
            $_SESSION['status'] = "Missing required field: $field";
            exit();
        }
    }

    // Assign variables
    $idNum = strtoupper($_POST['idNum']);
    $scholarName = strtoupper($_POST['scholarName']);
    $year = strtoupper($_POST['year']);
    $schoolYear = $_POST['schoolYear'];
    $sem = $_POST['sem'];
    $college = strtoupper($_POST['college']);
    $course = strtoupper($_POST['course']);
    $major = strtoupper($_POST['major']);
    $lastname = strtoupper($_POST['lastname']);
    $middlename = strtoupper($_POST['middlename']);
    $firstname = strtoupper($_POST['firstname']);
    $suffix = isset($_POST['suffix']) ? strtoupper($_POST['suffix']) : '';
    $civilStatus = $_POST['civilStatus'];
    $childrenCount = $_POST['childrenCount'];
    $cmi = $_POST['cmi'];
    $sex = $_POST['sex'];
    $gender = strtoupper($_POST['gender']);
    $noOfUnits = $_POST['noOfUnits'];
    $noOfSubjects = $_POST['noOfSubjects'];
    $grade= $_POST['grade'];
    $dob = $_POST['dob'];
    $region = strtoupper($_POST['region']);
    $province = strtoupper($_POST['province']);
    $city = strtoupper($_POST['city']);
    $barangay = strtoupper($_POST['barangay']);

    // Calculate age from date of birth
    $birthdate = new DateTime($dob);
    $today = new DateTime();
    $age = $birthdate->diff($today)->y;
    $verify_token = $_POST['verify_token'];
    $dateUpdated = $today->format('Y-m-d H:i:s');

    // Check if user exists
    $check_query = "SELECT upId FROM userprofile WHERE idNum = ? AND verify_token = ? LIMIT 1";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $idNum, $verify_token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $_SESSION['status'] = "User  not found or invalid token!";
        //header('Location: http://localhost/iskolar/auth/error_register.php');
        exit();
    } else {
        $stmt->bind_result($upId);
        $stmt->fetch();
        $stmt->close();

        // Fetch email and contactNumber of the user
        $fetch_query = "SELECT email, contactNumber FROM userprofile WHERE idNum = ? AND verify_token = ? LIMIT 1";
        $stmt_fetch = $conn->prepare($fetch_query);
        $stmt_fetch->bind_param("ss", $idNum, $verify_token);
        $stmt_fetch->execute();
        $stmt_fetch->bind_result($email, $contactNumber);
        $stmt_fetch->fetch();
        $stmt_fetch->close();

      // Escape input values to prevent SQL injection
$scholarName = mysqli_real_escape_string($conn, $scholarName);
$year = mysqli_real_escape_string($conn, $year);
$schoolYear = mysqli_real_escape_string($conn, $schoolYear);
$sem = mysqli_real_escape_string($conn, $sem);
$college = mysqli_real_escape_string($conn, $college);
$course = mysqli_real_escape_string($conn, $course);
$major = mysqli_real_escape_string($conn, $major);
$lastname = mysqli_real_escape_string($conn, $lastname);
$middlename = mysqli_real_escape_string($conn, $middlename);
$firstname = mysqli_real_escape_string($conn, $firstname);
$suffix = mysqli_real_escape_string($conn, $suffix);
$dob = mysqli_real_escape_string($conn, $dob);
$civilStatus = mysqli_real_escape_string($conn, $civilStatus);
$childrenCount = (int) $childrenCount; // Cast to integer
$cmi = (int) $cmi; // Cast to integer
$sex = mysqli_real_escape_string($conn, $sex);
$gender = mysqli_real_escape_string($conn, $gender);
$noOfUnits = (int) $noOfUnits; // Cast to integer
$noOfSubjects = (int) $noOfSubjects; // Cast to integer
$grade = (int) $grade; // Cast to integer
$age = (int) $age; // Cast to integer
$dateUpdated = mysqli_real_escape_string($conn, $dateUpdated);
$region = mysqli_real_escape_string($conn, $region);
$province = mysqli_real_escape_string($conn, $province);
$city = mysqli_real_escape_string($conn, $city);
$barangay = mysqli_real_escape_string($conn, $barangay);
$idNum = mysqli_real_escape_string($conn, $idNum);
$verify_token = mysqli_real_escape_string($conn, $verify_token);

// Prepare SQL statement to update data in the database
$sql = "UPDATE userprofile SET 
    scholarName = '$scholarName', 
    year = '$year', 
    schoolYear = '$schoolYear', 
    sem = '$sem', 
    college = '$college', 
    course = '$course', 
    major = '$major', 
    lastname = '$lastname', 
    middlename = '$middlename', 
    firstname = '$firstname', 
    suffix = '$suffix',  
    dob = '$dob', 
    civilStatus = '$civilStatus', 
    childrenCount = $childrenCount, 
    cmi = $cmi, 
    sex = '$sex', 
    gender = '$gender', 
    noOfUnits = $noOfUnits, 
    noOfSubjects = $noOfSubjects, 
    grade = $grade, 
    age = $age, 
    dateUpdated = '$dateUpdated', 
    region = '$region', 
    province = '$province', 
    city = '$city', 
    barangay = '$barangay' 
WHERE idNum = '$idNum' AND verify_token = '$verify_token'";

// Execute the query
if (mysqli_query($conn, $sql)) {
    // Handle success
    $_SESSION['status'] = "User updated successfully!";
    header('Location: http://localhost/iskolar/auth/registrationSuccess.php');
    exit();
} else {
    // Handle error
    $_SESSION['status'] = "User not updated! Error: " . mysqli_error($conn);
    header('Location: http://localhost/iskolar/updateInformation.php');
    exit();
}



        // Execute the statement
        if ($stmt->execute()) {
            // Handle file uploads
            $uploadsDir = "uploads/$idNum";
            if (!is_dir($uploadsDir)) {
                mkdir($uploadsDir, 0777, true);
            }

            $files = [
                'certOfScholarship' => 'COS',
                'grades' => 'Grades',
                'unpcat' => 'UNPCAT',
                'goodMoral' => 'GoodMoral',
                'cor' => 'COR'
            ];
            $fileYear = date('Y');
            foreach ($files as $inputName => $fileSuffix) {
                if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES[$inputName]['tmp_name'];
                    $fileName = $idNum . "_$fileSuffix" . "_$fileYear.pdf";
                    $destPath = $uploadsDir . DIRECTORY_SEPARATOR . $fileName;

                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        $fileType = $_FILES[$inputName]['type'];
                        $fileSize = $_FILES[$inputName]['size'];
                        $uploadDate = date('Y-m-d H:i:s');

                        // Insert file details into user_files table
                        $sql = "INSERT INTO user_files (upId, file_name, file_path, file_type, file_size, upload_date) VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt2 = $conn->prepare($sql);
                        $stmt2->bind_param("ssssss", $upId, $fileName, $destPath, $fileType, $fileSize, $uploadDate);
                        $stmt2->execute();
                        $stmt2->close();
                    } else {
                        $_SESSION['status'] = "Error uploading $inputName";
                        //header('Location: http://localhost/iskolar/register.php');
                        exit();
                    }
                }
            }

            sendmail_verification($idNum, $email, $verify_token, $upId);
            $_SESSION['status'] = "User  updated successfully!";
            //header('Location: http://localhost/iskolar/auth/registrationSuccess.php');
            exit();
        } else {
            $_SESSION['status'] = "User  not updated!";
            // header('Location: http://localhost/iskolar/register.php');
            exit();  
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Error</title>
</head>
<body>
    <h1>Error</h1>
    <p>There was an error processing your registration. Please try again.</p>
</body>
</html>
