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
        Thank you for registering with UNP Iskolar. To complete your registration, please click the link below to verify your email address:
    </p>
    <p>
        <a href="http://localhost/iskolar/auth/createAccount.php?email=' . urlencode($email) . '&idNum=' . urlencode($idNum) .'&upId='.urlencode($upId). '&code=' . urlencode($verify_token) .'" style="font-size: 16px; color: #007bff; text-decoration: none;">Verify Email Address</a>
    </p>
    <p style="font-size: 14px; color: #555; margin-top: 20px;">
        If you did not sign up for an account, please ignore this email.
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
    $expected_fields = ['idNum', 'scholarName', 'year', 'college', 'course', 'lastname', 'middlename', 'firstname', 'suffix', 'email', 'contactNumber', 'civilStatus', 'childrenCount', 'sex', 'noOfUnits', 'noOfSubjects', 'dob', 'region', 'province', 'city', 'barangay'];
    foreach ($expected_fields as $field) {
        if (!isset($_POST[$field])) {
            $_SESSION['status'] = "Missing required field: $field";
            header('Location: http://localhost/iskolar/register.php');
            exit();
        }
    }
    $data = json_decode(file_get_contents('php://input'), true);
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
    $email = $_POST['email'];
    $contactNumber = $_POST['contactNumber'];
    $telNumber = $_POST['telNumber'];
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
    $verify_token = md5(rand());
    $dateCreated = $today->format('Y-m-d H:i:s');
    $dateUpdated = $today->format('Y-m-d H:i:s');
    
    // Check if email or ID number already exists
    $check_query = "SELECT email, idNum FROM userprofile WHERE email = ? OR idNum = ? LIMIT 1";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $email, $idNum);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0)//when exist, redirect
     {
        $_SESSION['status'] = "User already exists!";
        header('Location: http://localhost/iskolar/auth/error_register.php');
        exit();
    } else {
        $stmt->close();

        // Prepare SQL statement to insert data into the database
        $sql = 'INSERT INTO userprofile 
(idNum, verify_token, scholarName, year, schoolYear, sem, college, course, major, 
lastname, middlename, firstname, suffix, email, contactNumber, telNumber, dob, civilStatus, 
childrenCount, cmi, sex, gender, noOfUnits, noOfSubjects, grade, age, dateCreated, dateUpdated, 
region, province, city, barangay) 
VALUES 
(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
';        
        $stmt = $conn->prepare($sql); // Prepare the statement
        if (!$stmt) {
            $_SESSION['status'] = "Database error: " . $conn->error;
            header('Location: http://localhost/iskolar/register.php');
            exit();
        }
        
        $stmt->bind_param("ssssssssssssssssssisssiisissssss", 
    $idNum, $verify_token, $scholarName, $year, $schoolYear, $sem, $college, $course, $major, 
    $lastname, $middlename, $firstname, $suffix, $email, 
    $contactNumber, $telNumber, $dob, $civilStatus, $childrenCount,$cmi, $sex, $gender, 
    $noOfUnits, $noOfSubjects, $grade, $age, $dateCreated, $dateUpdated, $region, 
    $province, $city, $barangay);
    
                // Execute the statement
        if ($stmt->execute()) {
            // Retrieve the generated upId for the userprofile
            $lastInsertId = $stmt->insert_id;
            $upId = $lastInsertId;

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
            $fileYear = date ('Y');
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
                        $stmt2->bind_param("ssssss", $lastInsertId, $fileName, $destPath, $fileType, $fileSize, $uploadDate);
                        $stmt2->execute();
                        $stmt2->close();
                    } else {
                        $_SESSION['status'] = "Error uploading $inputName";
                        header('Location: http://localhost/iskolar/register.php');
                        exit();
                    }
                }
            }

            sendmail_verification($idNum, $email, $verify_token, $upId);
            $_SESSION['status'] = "User registered successfully!";
            header('Location: http://localhost/iskolar/auth/registrationSuccess.php');
            exit();
        } else {
            $_SESSION['status'] = "User not registered!";
            header('Location: http://localhost/iskolar/register.php');
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
