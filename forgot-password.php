<?php
session_unset();
session_start();
include('includes/dbcon.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $toast_message = '';
    $_SESSION['email'] = $email; // Store email in session
  
    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $toast_message_error = "Invalid email address!";
    } else {
      // Verify if email exists in users table
      $query = "SELECT * FROM user WHERE email = '$email'";
      $result = $conn->query($query);
  
      if ($result->num_rows > 0) {
        // Check if session is already set
        if (isset($_SESSION['otp'])) {  
          $toast_message = "OTP already sent!";
          $show_otp_form = true;  
        } else {
          $mail = new PHPMailer(true);
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'unpiskolar@gmail.com';
          $mail->Password = 'zdzkgzbouwkqudlz';
          $mail->SMTPSecure = 'ssl';
          $mail->Port = 465;
  
          $mail->setFrom('unpiskolar@gmail.com', 'UNP iSkolar Online');
          $mail->addAddress($email);
          $mail->addReplyTo('unpiskolar@gmail.com', 'UNP iSkolar Online');
  
          $mail->isHTML(true);
          $otp = rand(100000, 999999);
          $expiration_time = time() + 300; // 5 minutes
          $_SESSION['otp'] = array('code' => $otp, 'expiration_time' => $expiration_time);
          $mail->Subject = "Reset Password OTP";
          $email_template = '
            <div style="font-family: Arial, sans-serif; color: #333; text-align: center; padding: 20px; border: 1px solid #e0e0e0; border-radius: 8px; max-width: 600px; margin: 0 auto;">
                <a style="max-width: 150px; margin-bottom: 20px; text-align:center;">  University of Northern Philippines </a>
                <h2 style="color: #333;">Let`s reset your password</h2>
                <p style="font-size: 16px; color: #555;">
                    Use this code to reset your password. This code will expire in 5 minutes.
                </p>
                <div style="font-size: 32px; font-weight: bold; margin: 20px 0; padding: 20px; background-color: #f1f1f1; border: 1px solid #ccc; border-radius: 8px; display: inline-block;">
                    '. $otp .'
                </div>
                <p style="font-size: 14px; color: #555; margin-top: 20px;">
                    If you didn’t request this email, you can safely ignore it.
                </p>
                <p style="font-size: 14px; color: #555; margin-top: 10px;">
                    Best regards,<br>
                    University of Northern Philippines
                </p>
            </div>';
        
          $mail->Body = $email_template;
  
          if (!$mail->send()) {
            $toast_message_error = "Error sending OTP: ". $mail->ErrorInfo;
          } else {
            $show_otp_form = true;
            $toast_message = "OTP sent successfully!";
          }
        }
      } else {
        $toast_message_error = "Email not found!";
      }
    }
  }
  
  if (isset($_POST['verify_otp'])) {
    $input_otp = $_POST['otp'];
  
    if (isset($_SESSION['otp'])) {
      $otp_data = $_SESSION['otp'];
      $current_time = time();
  
      if ($current_time < $otp_data['expiration_time']) {
        if ($input_otp == $otp_data['code']) {
          // OTP is valid, show password change form
          $show_password_change_form = true;
        } else {
          $toast_message_error = "Invalid OTP!";
        }
      } else {
        $toast_message_error = "OTP has expired!";
        unset($_SESSION['otp']);
      }
    } else {
      $toast_message_error = "OTP not found!";
    }
  }
  
  if (isset($_POST['change_password'])) {
    unset($_SESSION['otp']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['email'];

    if ($new_password == $confirm_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password in users table
        $query = "UPDATE user SET password = '$hashed_password' WHERE email = '$email'";
        $conn->query($query);
        header('Location: passwordChangeSuccess.php ');
    } else {
        $toast_message_error = "Passwords do not match!";
    }
}
  
  ?>
  

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/bar.css" rel="stylesheet">
    <link rel="icon" href="img/unplogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/bar.css">

</head>

<body class="bg-gradient-custom">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <?php if (!isset($show_otp_form) && !isset($show_password_change_form)) { ?>
                                        <form class="user" method="post">
                                            <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address...">
                                            </div>
                                            <button type="submit" name="reset_password" class="btn btn-primary btn-user btn-block">Reset Password</button>
                                        </form>
                                        <?php } elseif (isset($show_otp_form)) { ?>
                                        <form class="user" method="post">
                                            <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="otp" name="otp" placeholder="Enter OTP...">
                                            </div>
                                            <button type="submit" name="verify_otp" class="btn btn-primary btn-user btn-block">Verify OTP</button>
                                        </form>
                                        <?php } elseif (isset($show_password_change_form)) {?>
                                        <form class="user" method="post">
                                            <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="new_password" name="new_password" placeholder="Enter New Password...">
                                            </div>
                                            <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="confirm_password" name="confirm_password" placeholder="Confirm New Password...">
                                            </div>
                                            <button type="submit" name="change_password" class="btn btn-primary btn-user btn-block">Change Password</button>
                                        </form>
                                        <?php }?>

                                        <?php if (!empty($toast_message)) {?>
                                        <script>
                                            $(document).ready(function() {
                                            toastr.success('<?php echo $toast_message;?>');
                                            });
                                        </script>
                                        <?php }?>
                                        <?php if (!empty($toast_message_error)) {?>
                                        <script>
                                            $(document).ready(function() {
                                            toastr.error('<?php echo $toast_message_error;?>');
                                            });
                                        </script>
                                        <?php }?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="index.php">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>