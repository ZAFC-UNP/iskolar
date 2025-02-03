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


    <!-- Custom fonts for this template-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/bar.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="icon" type="img/png" href="img/unplogo.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .fab {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 56px;
            height: 56px;
            background-color: #4e73df;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            z-index: 1000;
            transition: transform 0.5s ease; /* Add transition for smooth rotation */
        }

        .fab.active {
            transform: rotate(45deg); 
        }

        .fab i {
            color: #fff;
            font-size: 24px;
        }

        .fab-options {
            position: fixed;
            bottom: 80px;
            right: 20px;
            display: none;
            flex-direction: column;
            align-items: center;
            z-index: 999;
        }

        .fab-option {
            width: 40px;
            height: 40px;
            background-color: #4e73df;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .fab-option i {
            color: #fff;
            font-size: 20px;
        }

        .action-icons {
            justify-content: center;
        }
        .action-icons i {
            margin-right: -10px;
            margin-bottom: 10px;
            margin-left: 5px;
            cursor: pointer;

        }
        #profilePic {
            width: 200px;
            height: 200px;
            margin: 4px;
        }
        @media (max-width: 576px) {
            #profilePic {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
        }
        .dropdown-menu.notifications-container {
            max-height: 300px; /* Set the maximum height you want */
            overflow-y: auto;  /* Enable vertical scrolling if content exceeds max-height */
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-custom sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index-admin.php">
                <div class="sidebar-brand-icon">
                    <img src="img/unplogo.png" alt="UNP iSkolar" height="60px">
                </div>
                <div class="sidebar-brand-text mx-3">iSkolar</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index-admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">Admin</div>
            <!-- Nav Item - Announcements -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAnnouncements"
                    aria-expanded="true" aria-controls="collapseAnnouncements">
                    <i class="fas fa-fw fa-bullhorn"></i>
                    <span>Announcements</span>
                </a>
                <div id="collapseAnnouncements" class="collapse" aria-labelledby="headingAnnouncements" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Announcements:</h6>
                        <a class="collapse-item" href="announcements.php">View All Announcements</a>
                        <a class="collapse-item" href="create_announcement.php">Create Announcement</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Users -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rlinded">
                    <h6 class="collapse-header">Add Users:</h6>
                        <a href="addUser.php" class="collapse-item ">Add User Account</a>
                        <h6 class="collapse-header">List of Scholars:</h6>
                        <a class="collapse-item" href="users.php">All Registered Scholars</a>
                        <a class="collapse-item" href="activeUsers.php">Active Scholars</a>
                        <a class="collapse-item" href="inactiveUsers.php">Inactive Scholars</a>
                        <a href="pending.php" class="collapse-item">Pending Scholars</a>
                        <a href="graduate.php" class="collapse-item">Graduated Scholars</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Generate Reports:</h6>
                        <a class="collapse-item" href="generateReport.php">Generate Report</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGenerateReport"
                    aria-expanded="true" aria-controls="collapseGenerateReport">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Generate Report</span>
                </a>
                <div id="collapseGenerateReport" class="collapse" aria-labelledby="headingGenerateReport" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Generate Report:</h6>
                        <a class="collapse-item" href="generateReport.php">Current Scholarship list</a>
                        <a class="collapse-item" href="generatePastList.php">Previous Lists</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="sidebar-heading">School Year</div>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="confirmNewTerm()">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Enter New Semester</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <!-- Sidebar Message -->
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light navbar-bg-custom topbar mb-4 text-white static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
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
                    <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Notifications -->
        <span id="notification-counter" class="badge badge-danger badge-counter"></span>
    </a>

    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in notifications-container"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Notifications
        </h6>
        <div id="notifications-list"></div>
    </div>
</li>
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
                <a class="dropdown-item" href="showProfile.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <?php if ($username == '21-03561'): ?>
                    <a class="dropdown-item" href="logs.php">
                        <i class="fas fa-file-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logs
                    </a>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#scholarshipModal">
    <i class="fas fa-file-alt fa-sm fa-fw mr-2 text-gray-400"></i>
    Scholarship Programs
</a>
                <?php endif; ?>
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
                        <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                         <!-- Total dropped Card Example -->
                         <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-header py-2"><h4>Basic Information</h4></div>
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
            </div>
                                    </tr>
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
                        <div class="col-xl-6 col-md-6 mb-4">
    <div class="card shadow h-100 py-2">
        <div class="card-header py-2">
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

                    
                    
                    
                    <!-- Floating Action Button -->
                    <div class="fab" id="fab" onclick="toggleFabOptions()">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="fab-options" id="fab-options">
                        <div class="fab-option" onclick="window.location.href='create_announcement.php'">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="fab-option" onclick="window.location.href='addUser.php'">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>© iSkolar Online 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <!-- <a class="scroll-to-top rounded" style="margin-bottom: 60px; margin-right: 10px;"href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a> -->
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
<!-- Modal -->
<div class="modal fade" id="scholarshipModal" tabindex="-1" aria-labelledby="scholarshipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scholarshipModalLabel">Scholarship Programs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
        style="
            background-color: #f8f9fa; /* Light background color for better contrast */
            border: 1px solid #dee2e6; /* Subtle border */
            border-radius: 50%; /* Fully rounded button */
            width: 40px; /* Larger clickable area */
            height: 40px; /* Larger clickable area */
            padding: 0; /* Remove default padding */
            font-size: 1.25rem; /* Slightly larger icon */
            color: #6c757d; /* Grey color for the icon */
            display: flex; /* Center the icon */
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Slight shadow for depth */
            transition: background-color 0.3s, color 0.3s; /* Smooth transition for hover effects */
        "
        onmouseover="this.style.backgroundColor='#e9ecef'; this.style.color='#343a40';"
        onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.color='#6c757d';">
        <i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <!-- Table to display scholarship programs -->
                <table id="scholarshipTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Program Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated here by JavaScript -->
                    </tbody>
                </table>

                <!-- Form to add a new scholarship program -->
                <form id="addScholarshipForm">
                    <div class="mb-3">
                        <label for="programName" class="form-label">Scholarship Program Name</label>
                        <input type="text" class="form-control" id="programName" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Program</button>
                </form>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.preview-link').on('click', function(e){
                e.preventDefault();
                var fileUrl = $(this).data('file');
                $('#pdfIframe').attr('src', fileUrl);
                $('#pdfModal').modal('show');
            });
        });
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
    function confirmNewTerm() {
        Swal.fire({
            title: 'Confirm New Semester',
            text: 'Are you sure you want to enter a new semester?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, proceed',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading alert
                Swal.fire({
                    title: 'Please wait...',
                    html: 'Saving your information...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Redirect to your PHP script after the loading alert is displayed
                setTimeout(() => {
                    window.location.href = 'controller/NewTerm.php'; // Adjust the path accordingly
                }, 100); // Short delay to allow Swal to render
            }
        });
        return false; // Prevent default link behavior
    }
</script>
<script>
    $(document).ready(function() {
        // Function to fetch unread notifications count and notifications list
        function fetchNotifications() {
            $.ajax({
                url: 'controller/get_notifications.php', // PHP file to handle fetching notifications
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    //console.log('Received notification list:', response); // Log the entire response to check its structure

                    // Update notification counter
                    $('#notification-counter').html(response.unreadCount);

                    // Update notification list
                    $('#notifications-list').html(response.notificationsHTML);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching notifications:', error);
                }
            });
        }

        // Fetch notifications initially and every 10 seconds (adjust the time as needed)
        fetchNotifications();
        setInterval(fetchNotifications, 5000);
    });

    $("#alertsDropdown").click(function() {
    // Trigger the AJAX request to update the notification statuses
    $.ajax({
        type: "POST",
        url: "controller/update_notifications.php", // Replace with the URL of your PHP script
        success: function(data) {
            //console.log(data); // Log the response from the PHP script
        }
    });

    // Update the notification counter and list
    // You can add code here to update the notification counter and list
    // For example:
    $("#notification-counter").html("0");
});
</script>
<script>
    $(document).ready(function() {
        // Fetch and display scholarship programs when the modal is shown
        $('#scholarshipModal').on('show.bs.modal', function() {
            fetchScholarships();
        });

        // Fetch scholarship programs from the server
        function fetchScholarships() {
            $.ajax({
                url: 'controller/fetchScholarships.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Response received:', response); // Debugging line
                    if (response.success) {
                        var tableBody = $('#scholarshipTable tbody');
                        tableBody.empty();
                        if (response.data.length === 0) {
                            tableBody.append('<tr><td colspan="3">No scholarships available.</td></tr>');
                        } else {
                            response.data.forEach(function(program, index) {
                                tableBody.append(
                                    '<tr>' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + htmlspecialchars(program.scholarName) + '</td>' +
                                    '<td><button class="btn btn-danger btn-sm remove-btn" data-id="' + program.id + '"><i class="fas fa-trash-alt"></i></button></td>' +
                                    '</tr>'
                                );
                            });
                        }
                    } else {
                        Swal.fire('Error', response.message || 'Error fetching scholarship programs.', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching scholarship programs:', error);
                    Swal.fire('Error', 'Error fetching scholarship programs. Please try again later.', 'error');
                }
            });
        }

        // Function to encode HTML special characters
        function htmlspecialchars(str) {
            return $('<div>').text(str).html();
        }

        $('#addScholarshipForm').submit(function(e) {
            e.preventDefault();
            var programName = $('#programName').val().toUpperCase();

            $.ajax({
                url: 'controller/addScholarship.php', // Server script to add data
                type: 'POST',
                data: { scholarName: programName },
                success: function(response) {
                    if (response.success) {
                        fetchScholarships(); // Refresh the list
                        $('#programName').val(''); // Clear the form input
                        Swal.fire('Success', 'Scholarship Program Added', 'success');
                    } else {
                        Swal.fire('Error', 'Failed to add Scholarship Program', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Failed to add Scholarship Program', 'error');
                }
            });
        });

        // Handle click event for remove buttons
        $('#scholarshipTable').on('click', '.remove-btn', function() {
            var scholarshipId = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to remove this scholarship program.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/removeScholarship.php', // Server script to remove data
                        type: 'POST',
                        data: { scholarId: scholarshipId },
                        success: function(response) {
                            if (response.success) {
                                fetchScholarships(); // Refresh the list
                                Swal.fire('Removed!', 'Scholarship Program has been removed.', 'success');
                            } else {
                                Swal.fire('Error', response.message || 'Failed to remove Scholarship Program', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Failed to remove Scholarship Program', 'error');
                        }
                    });
                }
            });
        });
    });
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
