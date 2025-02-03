<?php
session_start();
include('includes/dbcon.php');
$page_title="View Profile";
include('includes/header.php');

if (!isset($_SESSION['uid'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

// Retrieve the username from the session
$username = $_SESSION['username'];
$photoPath = $_SESSION['photoPath'];
$userType = $_SESSION['userType'];
$fullName = $_SESSION['fullName'];


// Query the database to retrieve the upId
$user_query = mysqli_query($conn, "SELECT upId FROM user WHERE username = '$username'");

// Fetch the upId
$user_result = mysqli_fetch_assoc($user_query);
$upId_from_user = $user_result['upId'];

// Query the database to retrieve the upId from userprofile
$userprofile_query = mysqli_query($conn, "SELECT upId FROM userprofile WHERE upId = '$upId_from_user'");

// Fetch the upId
$userprofile_result = mysqli_fetch_assoc($userprofile_query);
$upId = $userprofile_result['upId'];

// Query the database to retrieve the user data
$user_data = mysqli_query($conn, "SELECT * FROM userprofile WHERE upId = '$upId'");

// Fetch the user data
$user = mysqli_fetch_assoc($user_data);

// Display the user profile
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/bar.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="icon" type="img/png" href="img/unplogo.png">
    <link rel="stylesheet" href="css/student.css">
    <title>iSkolar Online</title>
    <style>
        .sidebar-brand {
            font-family: 'Nunito', sans-serif;
            font-weight: 900;
            font-size: 1.5rem;
            color: #fff;
            text-shadow: 2px 2px 2px rgba(0,0,0,0.5);
        }
        body{
            color: black;
        }
        .hidden {
    display: none;
}
.centered-container {
    display: flex;
    justify-content: center; /* Centers the row content */
    padding: 20px;
}

.centered-container .row {
    display: flex;
    justify-content: center; /* Centers the columns within the row */
    margin: 0; /* Remove default margin */
}

.centered-container .col-md-4 {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 15px;
    flex: 1; /* Allows the columns to grow equally */
    transition: transform 0.3s;
}

.centered-container .col-md-4 h2 {
    color: #000000;
    margin-bottom: 15px;
}

.centered-container .col-md-4 p {
    line-height: 1.6;
}

.centered-container .col-md-4:hover {
    transform: translateY(-5px); /* Lift effect on hover */
}

@media (max-width: 768px) {
    .centered-container .row {
        flex-direction: column;
    }
    .centered-container .col-md-4 {
        margin-bottom: 20px; /* Space between stacked columns */
    }
}
.profile-header {
    text-align: center;
    font-size: 1.75rem;
    font-weight: 600; 
    padding: 10px;
    max-width: 600px;
    margin: 20px auto; 
}


    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
    
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light navbar-bg-custom topbar text-white static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" style="text-decoration:none;" href="index-iskolar.php">
                <div class="sidebar-brand-icon">
                  <img src="img/unplogo.png" alt="UNP iSkolar" height="60px">
                </div>
                <div class="sidebar-brand-text mx-3">iSkolar Online</div>
            </a>
            <div class="d-none d-sm-inline-block mx-3 my-2 border-left" style="border-left: 2px solid #fff; height: 50px;"></div>
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 text-center">
                        <h6>
                        <?php
                        date_default_timezone_set('Asia/Manila');
                            $currentTime = date('H');
                            if ($currentTime < 12) {
                                echo "Good morning";
                            } elseif ($currentTime < 17) {
                                echo "Good afternoon";
                            } else {
                                echo "Good evening";
                            }
                            echo " " . $_SESSION['fullName'] . ", ";
                            
                            ?>
                        </h6>
                    </div>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Profile Dropdown -->
                        <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline navbar-text text-white small">
                                    <!-- Display the idNum here -->
                                    <?php echo htmlspecialchars($username); ?> <br>
                                    <div style="margin-top: -3px"> <?php echo htmlspecialchars($userType); ?> </div>
                                </span>
                                <img class="img-profile rounded-circle" src="<?php echo htmlspecialchars($photoPath); ?>" alt="Profile Photo" onerror="this.onerror=null;this.src='img/undraw_profile.svg';">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="index-iskolar.php">
                                    <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Home
                                </a>
                            <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
    
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="profile-header h3 mb-0 text-800 mt-2 text-center">My Personal Profile</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                         <!-- Total dropped Card Example -->
                         <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card shadow h-100 py-2">
                            <div class="card-header py-2 bg-gradient-primary text-white"><h4>Basic Information</h4></div>
                                <div class="card-body">
                                <?php
                                    // Paths to your JSON files
                                    $regionFile = 'JSON/region.json';
                                    $provinceFile = 'JSON/province.json';
                                    $cityFile = 'JSON/city.json';
                                    $barangayFile = 'JSON/barangay.json';

                                    // Read and decode the JSON files
                                    $regions = json_decode(file_get_contents($regionFile), true);
                                    $provinces = json_decode(file_get_contents($provinceFile), true);
                                    $cities = json_decode(file_get_contents($cityFile), true);
                                    $barangays = json_decode(file_get_contents($barangayFile), true);

                                    // Extract codes from user data
                                    $regionCode = $user['region'];
                                    $provinceCode = $user['province'];
                                    $cityCode = $user['city'];
                                    $barangayCode = $user['barangay'];

                                    // Initialize variables for names
                                    $regionName = '';
                                    $provinceName = '';
                                    $cityName = '';
                                    $barangayName = '';

                                    // Find the region name by matching the region code
                                    foreach ($regions as $region) {
                                        if (isset($region['region_code']) && $region['region_code'] == $regionCode) {
                                            $regionName = explode('(', $region['region_name'])[0];
                                            break;
                                        }
                                    }
                                    // Find the province name by matching the province code
                                    foreach ($provinces as $province) {
                                        if (isset($province['province_code']) && $province['province_code'] == $provinceCode) {
                                            $provinceName = $province['province_name'];
                                            break;
                                        }
                                    }
                                    
                                    // Find the city name by matching the city code
                                    foreach ($cities as $city) {
                                        if (isset($city['city_code']) && $city['city_code'] == $cityCode) {
                                            $cityName = $city['city_name'];
                                            break;
                                        }
                                    }


                                    ?>
                                    <table>
                                    <tr>
                                        <div class="text-center">
                <img id="profilePic" src="<?php echo htmlspecialchars($photoPath); ?>" alt="User Photo"/>
            </div></tr>
                                        <tr>
                                        <tr>
                                            <th>ID Number:</th>
                                            <td><?php echo $user['idNum'];?></td>
                                        </tr>
                                        <th>Name:</th>
                                        <td>
                                            <?php 
                                                $name = $user['firstname'];
                                                if (!empty($user['middlename'])) {
                                                    $name.= " ". $user['middlename'];
                                                }
                                                $name.= " ". $user['lastname'];
                                                if (!empty($user['suffix'])) {
                                                    $name.= " ". $user['suffix'];
                                                }
                                                echo ucwords(strtolower($name));
                                        ?>
                                        </td>
                                    </tr>
                                    <tr>
                                            <th>Scholarship:</th>
                                            <td><?php echo ucwords(strtolower($user['scholarName']));?></td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td><?php echo $user['email'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Contact Number:</th>
                                            <td><?php echo $user['contactNumber'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Birth Date:</th>
                                            <td><?php echo $user['dob'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Age:</th>
                                            <td><?php echo $user['age'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Civil Status:</th>
                                            <td><?php echo  ucwords(strtolower($user['civilStatus']));?></td>
                                        </tr>
                                        <tr>
                                            <th>Children Count:</th>
                                            <td><?php echo $user['childrenCount'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Combined Monthly Income:</th>
                                            <td><?php echo ucwords(strtolower($user['cmi']));?></td>
                                        </tr>
                                        <tr>
                                            <th>Sex:</th>
                                            <td><?php echo  ucwords(strtolower($user['sex']));?></td>
                                        </tr>
                                        <tr>
                                            <th>Gender:</th>
                                            <td><?php echo  ucwords(strtolower($user['gender']));?></td>
                                        </tr>
                                        <tr>
                                            <th>Address:</th>
                                            <td>
                                            <?php echo (ucwords(strtolower($user['barangay'])). ', ' . $cityName . ', ' . $provinceName . ', ' . $regionName ); ?>
                                        </td>
                                        </tr>
                                    </table>
                            
                                </div>
                            </div>
                        </div>
                        <!-- Uploaded Files 2 -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-header py-2 bg-gradient-danger text-white"><h4>Uploaded Files</h4></div>
            <div class="card-body">
                <ul>
                <?php
                    $stmt = mysqli_prepare($conn, "SELECT * FROM user_files WHERE upId =?");
                    mysqli_stmt_bind_param($stmt, "i", $upId);
                    mysqli_stmt_execute($stmt);
                    $files_query = mysqli_stmt_get_result($stmt);
                    $num_rows = mysqli_num_rows($files_query);

                    if ($num_rows > 0) {
                        while ($file = mysqli_fetch_assoc($files_query)) {
                            $filePath = $file['file_path'];
                            $fileName = $file['file_name'];
                            $uploadDate = $file['upload_date'];
                            ?>
                            <li style="list-style-type: none; margin-bottom: 20px;">
                                <div style="display: flex; align-items: center;">
                                    <i class="fas fa-file-pdf" style="font-size: 24px; color: #e74c3c; margin-right: 10px;"></i>
                                    <a href="#" class="preview-link" data-file="<?php echo $filePath; ?>" data-toggle="modal" data-target="#file-review-modal">
                                        <?php echo $fileName; ?> (<?php echo $uploadDate; ?>)
                                    </a>
                                </div>
                            </li>
                            <?php
                        }
                    } else {
                        ?>
                        <li>No files uploaded.</li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-header py-2 bg-gradient-success text-white  "><h5>Academic Information</h5></div>
            <div class="card-body">
                <ul>
                    <table>
                    <tr>
                        <th>College:</th>
                        <td><?php echo $user['college'];?></td>
                    </tr>
                    <tr>
                        <th>Course:</th>
                        <td><?php 
                                $course = $user['course'];
                                if (!empty($user['major'])) {
                                    $course.= " ". $user['major'];
                                }
                                echo  ucwords(strtolower($course));
                            ?></td>
                    </tr>
                    <tr>
                        <th>Year Level:</th>
                        <td><?php echo  ucwords(strtolower($user['year']));?></td>
                    </tr>
                    <tr>
                        <th>School Year:</th>
                        <td><?php echo $user['schoolYear'];?></td>
                    </tr>
                    <tr>
                        <th>Semester:</th>
                        <td><?php echo $user['sem'];?></td>
                    </tr>
                    <tr>
                        <th>Number of Subjects:</th>
                        <td><?php echo $user['noOfSubjects'];?></td>
                    </tr>
                    <tr>
                        <th>Number of Units:</th>
                        <td><?php echo $user['noOfUnits'];?></td>
                    </tr>
                    <tr>
                        <th>GWA:</th>
                        <td><?php echo $user['grade'];?></td>
                    </tr>
                    </table>
                </ul>
            </div>
            <?php
            $email= $user['email'];
            $idNum = $user['idNum'];
            $verify_token = $user['verify_token'];
            $upId = $user['upId'];
            $url = $url = "http://localhost/iskolar/update.php?email=" . urlencode($email) . "&idNum=" . urlencode($idNum) . "&code=" . urlencode($verify_token) . "&upId=" . urlencode($upId);
            ?>
            <button class="btn-primary text-white ml-5 mr-5 " style="font-size: 16px; text-decoration: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;" 
        onclick="window.location.href='<?php echo $url; ?>'">
    Renew Scholarship
</button>
        </div>
    </div>      

    <!-- Academic Informtaion -->
    

    
    <div class="col-xl-6 col-md-6 mb-4">
    <div class="card shadow h-100 py-2">
        <div class="card-header py-2 bg-gradient-warning text-white">
            <h5>Change Password</h5>
        </div>
        <div class="card-body">
            <form id="changePasswordForm">
                <div class="form-group">
                    <label for="currentPassword">Current Password</label>
                    <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                </div>
                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm New Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
            
        </div>
    </div>
</div>

</div>


<!-- Modal for file review -->
<div class="modal fade" id="file-review-modal" tabindex="-1" role="dialog" aria-labelledby="file-review-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="file-review-modal-label"><i class="fas fa-file-pdf" style="font-size: 24px; color: #e74c3c; margin-right: 10px;"></i>File Review</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="" frameborder="0" width="100%" height="500px" id="file-review-iframe"></iframe>
            </div>
        </div>
    </div>
</div>
                    
                    
                    
                <!-- /.container-fluid -->
            </div>
<!-- End of Page Content -->

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Announcement Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Enlarged Image">
                <p id="modalTitle" class="mt-2"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- About Us Modal -->
<div class="modal fade" id="aboutUsModal" tabindex="-1" role="dialog" aria-labelledby="aboutUsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutUsModalLabel">About Us</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="indent">
                <p> This is one service unit of the Office of Student Affairs & Services that is in charge of the different scholarship and educational grants/privileges offered to students either by the university, the national government or by any interested individual, group of persons or company. </p></div>
                <div class="indent">
                <p>
                As may be required by the Memorandum of Agreement between the sponsor/s and the university through the Office of Student Affairs & Services, the coordinator for scholarship may conduct the selection and screening of students who may wish to avail of the scholarship grants/privileges. This service area is also in charge of the processing of papers needed for the release of the scholarship benefits of the grantees/scholars.</p></div>
                <div class="indent">
                <p>For more information, contact us at unpiskolar@gmail.com.</p></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade privacy" id="policyModal" tabindex="-1" role="dialog" aria-labelledby="policyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 70%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="policyModalLabel">GENERAL GUIDELINES & POLICIES ON</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body privacy-modal">
            <div id="scholarship-section">
        <h2>SCHOLARSHIP</h2>

        <ul>
            <li>1. A student applies for the scholarship/study privileges/grants before enrolment period but not (1) one month after the close of enrolment. The application is renewed each term.</li>
            <li>2. A student enjoys only one scholarship/study privilege/grant for any given term, summer not included.</li>
            <li>3. The average grade requirement and the level of performance considered for any grant is based on those obtained in the semester immediately prior to an application.</li>
            <li>4. A grade of 5.0 is a disqualification for any privilege/grant.</li>
            <li>5. Scholars/Grantees must carry the regular curricular load of the course enrolled in and must finish the course within the period prescribed.</li>
            <li>6. Conviction for any grave offense is a permanent disqualification as stipulated in the Student Code of Conduct and Discipline.</li>
        </ul>

        <p>The University of Northern Philippines has different existing scholarship and educational grants/privileges and are categorized into the following:</p>

        <h3>A. Academic Scholarship</h3>
        <div class="indent">
            <h4>A. 1. Entrance Scholar</h4>
            <ul>
                <li>Valedictorian—100% discount on tuition fee only</li>
                <li>Salutatorian—75% discount on tuition fee only</li>
            </ul>

            <h4>A. 2. BS Physics Scholar</h4>
            <ul>
                <li>100% discount on all fees except trust fund</li>
            </ul>

            <h4>A. 3. University Scholar</h4>
            <ul>
                <li>Average grade of 1.25—up with no grade lower than 1.75</li>
                <li>100% discount on all fees except trust fund</li>
            </ul>

            <h4>A. 4. College Scholar</h4>
            <ul>
                <li>Average grade of 1.26—1.75 no grade lower than 2.0</li>
                <li>100% discount on tuition fee only</li>
            </ul>

            <h4>A. 5. Dean’s List</h4>
            <ul>
                <li>Average grade of 2.0—1.76 no grade lower than 2.5</li>
                <li>50% discount on tuition fee only</li>
            </ul>

            <h4>A. 6. Top 3 Passers of the UNP College Admission Test</h4>
            <ul>
                <li>100% discount on tuition fee only</li>
            </ul>
        </div>

        <h3>B. Study Privileges</h3>
        <div class="indent">
            <h4>B. 1 UNP Employee Study Privilege</h4>
            <ul>
                <li>Employees/Dependents—100% discount on all fees and 50% discount (dependents beyond Baccalaureate degree including medicine).</li>
            </ul>

            <h4>B. 2. College Choir</h4>
            <ul>
                <li>New member—50% discount on all fees except trust fund</li>
                <li>Old Member—100% discount on all fees except trust fund</li>
            </ul>

            <h4>B. 3. Marching Band/ Millennium Band</h4>
            <ul>
                <li>100% discount on all fees except trust fund</li>
            </ul>

            <h4>B. 4. Athletic Scholar</h4>
            <ul>
                <li>Category A—100% discount on all fees</li>
                <li>Category B—100% discount on tuition fee only</li>
                <li>Category C—50% discount on tuition fee only</li>
            </ul>

            <h4>B. 5. UNP Dance Troupe</h4>
            <ul>
                <li>100% discount on all fees except trust fund</li>
            </ul>

            <h4>B. 6. ROTC Cadet Officer</h4>
            <ul>
                <li>Corps Commander—100% discount on tuition fee only</li>
                <li>Ex-O, S1 to S4—50% discount on tuition fee only</li>
            </ul>

            <h4>B. 7. Student Council Executive Officer</h4>
            <ul>
                <li>SC President—100% discount on all fees except trust fund</li>
                <li>Other SC Executive Officers—100% discount on tuition fee only</li>
                <li>SC Representatives & Mandated Presidents—100% discount on tuition fee only</li>
                <li>SC Volunteer Corps—50% discount on tuition fee</li>
            </ul>

            <h4>B. 8. New Tandem</h4>
            <ul>
                <li>Editor-in-Chief—100% discount on all fees except trust fund</li>
                <li>Associate Managing Editor—85% discount on all fees except trust fund</li>
                <li>Section Editors, Layout Artist—75% discount on all fees except trust fund</li>
                <li>Staff writers and Circulation managers—50% discount on all fees except trust fund</li>
            </ul>

            <h4>B. 9. Adopt-A-School/Community Program</h4>
            <ul>
                <li>100% discount on all fees except trust fund</li>
            </ul>

            <h4>B. 10. Barangay Study Privilege</h4>
            <ul></ul>

            <h4>B. 11. Lucky 7</h4>
            <ul></ul>
        </div>
    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


            <!-- Footer -->
            <footer class="sticky-footer footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    <a href="#" data-toggle="modal" data-target="#policyModal">Privacy and Policies</a>|
                    <a href="#" data-toggle="modal" data-target="#aboutUsModal">About Us</a>
                    <br> <br>
                        <span>All rights reservered | iSkolar Online 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" style="margin-bottom: 10px; margin-right: 10px;"href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="index.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


    <script>
                                         function toggleContent(button) {

var content = button.parentNode.querySelector('.announcement-content');


if (content.classList.contains('content-collapsed')) {
    content.classList.remove('content-collapsed');
    content.classList.add('content-expanded');
    button.textContent = 'See Less';
} else {
    content.classList.remove('content-expanded');
    content.classList.add('content-collapsed');
    button.textContent = 'See More';
}
}; 
    </script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the JSON data from PHP
        var usertypeData = <?php echo $json_data; ?>;

        // Check if the JSON data is correctly parsed
        console.log(usertypeData);

        
    });
</script>
<script>
    function showModal(imageSrc, title) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalTitle').textContent = title;
    $('#imageModal').modal('show');
}
</script>
<script>
    $(document).ready(function() {
        $('#changePasswordForm').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Show the loading spinner using SweetAlert
            Swal.fire({
                title: 'Processing...',
                text: 'Please wait while we process your request.',
                didOpen: () => {
                    Swal.showLoading(); // Show the loading spinner
                }
            });

            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: 'controller/changePassword.php', // Replace with your server-side script URL
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Handle success
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.success
                        }).then(() => {
                            // Optionally, redirect or clear form fields
                            $('#changePasswordForm')[0].reset();
                        });
                    } else {
                        // Handle error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.error
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An unexpected error occurred. Please try again later.'
                    });
                },
                complete: function() {
                    // No need to hide loader manually, Swal handles it
                }
            });
        });
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Select all preview links
    const previewLinks = document.querySelectorAll(".preview-link");

    previewLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();

            // Get the file path from the data attribute
            const filePath = link.getAttribute("data-file");
            const fileName = link.textContent;

            // Set the iframe src to load the file
            document.getElementById("file-review-iframe").src = filePath;

            // Optionally update the modal title with the file name
            document.getElementById("file-review-modal-label").innerHTML = 
                `<i class="fas fa-file-pdf" style="font-size: 24px; color: #e74c3c; margin-right: 10px;"></i>${fileName}`;

            // Show the modal
            $('#file-review-modal').modal('show');
        });
    });
});
</script>

