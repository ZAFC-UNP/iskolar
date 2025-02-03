<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure the user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}
//var_dump($_SESSION); // Print the session variables to see if they are being set correctly
// Retrieve user information from the session
$username = $_SESSION['username'];
$photoPath = $_SESSION['photoPath'];
$userType = $_SESSION['userType'];
$fullName = $_SESSION['fullName'];

if($userType != "admin"){
    header("Location: permissionControl.php"); // Redirect to login page if not logged in
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
    <title>iSkolar Online - Generate Past Report</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
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
        .dropdown-menu.notifications-container {
            max-height: 300px; /* Set the maximum height you want */
            overflow-y: auto;  /* Enable vertical scrolling if content exceeds max-height */
        }
.custom-select {
    padding: 10px;
    border-radius: 5px;
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    height: 42px;
    transition: border-color 0.3s ease-in-out;
}

.custom-select:focus {
    border-color: #28a745;
    box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
}

.custom-select option {
    padding: 10px;
    background-color: #f1f1f1;
    font-size: 16px;
}

.custom-select option.font-weight-bold {
    font-weight: bold;
    color: #007bff;
}
.btn-link {
    float: right; /* Float to the right */
    text-decoration: none; /* Remove underline */
    color: #007bff; /* Use a color that mimics a hyperlink */
    background: none; /* No background color */
    border: none; /* No border */
    padding: 0; /* Remove padding */
    cursor: pointer; /* Change cursor to pointer */
}

.btn-link:hover {
    text-decoration: underline; /* Add underline on hover */
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
                        <a class="collapse-item active" href="generatePastList.php">Previous Lists</a>
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
                        <h1 class="h3 mb-0 text-gray-800">Generate Report Past Scholar List</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                         <!-- Total dropped Card Example -->
                         <div class="col-xl-12 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-header py-2">
                                Select Information To Generate
                        </div>
                                <div class="card-body">
                                <form action="printReportPast.php" method="POST" target="_blank">
                                <div class="form-group">
                                <label for="scholarship">Scholarship Program:</label>
                                    <?php
                                    include 'includes/dbcon.php';
                                    $sql = "SELECT scholarName FROM scholarships";
                                    $result = $conn->query($sql);
                                    ?>

                                        <select id="scholarName" name="scholarName" class="custom-select"> 
                                            <option value="">All Program</option>
                                            
                                            <?php
                                            if ($result->num_rows > 0) {
                                                // Output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    echo '<option value="'.htmlspecialchars($row['scholarName']).'">'.htmlspecialchars($row['scholarName']).'</option>';
                                                }
                                            } else {
                                                echo '<option value="">No Scholarships Available</option>';
                                            }
                                            $conn->close();
                                            ?>
                                        </select> 
                                </div>
                                <div class="form-group">
                                    <label for="college">Select College:</label>
                                    <select id="college" name="college" class="custom-select">
                                        <option value="">All Colleges</option>   
                                        <option value="CARCH">COLLEGE OF ARCHITECTURE (CARCH)</option>
                                        <option value="CAS">COLLEGE OF ARTS AND SCIENCES (CAS)</option>
                                        <option value="CBAA">COLLEGE OF BUSINESS ADMINISTRATION AND ACCOUNTANCY (CBAA)</option>
                                        <option value="CCJE">COLLEGE OF CRIMINAL JUSTICE EDUCATION (CCJE)</option>
                                        <option value="CCIT">COLLEGE OF COMMUNICATION AND INFORMATION TECHNOLOGY (CCIT)</option>
                                        <option value="CE">COLLEGE OF ENGINEERING (CE)</option>
                                        <option value="CFAD">COLLEGE OF FINE ARTS AND DESIGN (CFAD)</option>
                                        <option value="CHS">COLLEGE OF HEALTH SCIENCES (CHS)</option>
                                        <option value="CHTM">COLLEGE OF HOSPITALITY AND TOURISM MANAGEMENT (CHTM)</option>
                                        <option value="CN">COLLEGE OF NURSING (CN)</option>
                                        <option value="CPAD">COLLEGE OF PUBLIC ADMINISTRATION (CPAD)</option>
                                        <option value="CSW">COLLEGE OF SOCIAL WORK (CSW)</option>
                                        <option value="CTECH">COLLEGE OF TECHNOLOGY (CTECH)</option>
                                        <option value="CTE">COLLEGE OF TEACHER EDUCATION (CTE)</option>
                                    </select>
                                </div>
                                
                                <!-- Link to Toggle Advanced Search -->
<a href="javascript:void(0);" class="btn-link" id="toggle-advanced-search">Show Advanced Search</a>

<!-- Advanced Search Form -->
<div class="advanced-search" id="advanced-search-form" style="display: none; margin-top: 20px;">
    <h5>Advanced Search</h5>
    <div class="form-group">
    <label for="schoolYear"> School Year:</label>
    <?php
include 'includes/dbcon.php';
// Query to get distinct school years from the archivedinformation table
$sql = "SELECT DISTINCT schoolYear FROM archivedinformation WHERE schoolYear IS NOT NULL ORDER BY schoolYear DESC";
$result = $conn->query($sql);

?>

<select id="schoolYear" name="schoolYear" class="custom-select">
    <option value="">All School Year</option>
    <?php
    // Check if there are any results
    if ($result->num_rows > 0) {
        // Output each school year as an option
        while($row = $result->fetch_assoc()) {
            $schoolYear = $row['schoolYear'];
            echo "<option value=\"$schoolYear\">$schoolYear</option>";
        }
    }
    ?>
</select>

<?php
// Close the database connection
$conn->close();
?>
    </div>
    <div class="form-group">
                                    <label for="year">Year Level:</label>
                                    <select id="year" name="year" class="custom-select">
                                        <option value="">All Year Level</option>
                                        <option value="1ST YEAR">1st Year</option>
                                        <option value="2ND YEAR">2nd Year</option>
                                        <option value="3RD YEAR">3rd Year</option>
                                        <option value="4TH YEAR">4th Year</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sem">Semester:</label>
                                    <select id="sem" name="sem" class="custom-select">
                                        <option value="">All Semester</option>
                                        <option value="1st Semester">1st Semester</option>
                                        <option value="2nd Semester">2nd Semester</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="userType">Scholar Status:</label>
                                    <select id="userType" name="userType" class="custom-select">
                                        <option value="">All Scholars</option>
                                        <option value="iskolar">Active Scholars</option>
                                        <option value="graduated">Graduated Scholars</option>
                                        <option value="dropped">Terminated Scholars</option>
                                    </select>
                                </div>
</div>

<button type="submit" class="btn btn-primary" style="margin-top:25px;">Generate Report</button>
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
        const fab = document.getElementById('fab');
        function toggleFabOptions() {
            const fabOptions = document.getElementById('fab-options');
            if (fabOptions.style.display === 'none' || fabOptions.style.display === '') {
                fabOptions.style.display = 'flex';
                fab.classList.add('active'); // Add the 'active' class for rotation
            } else {
                fabOptions.style.display = 'none';
                fab.classList.remove('active'); // Remove the 'active' class
            }
        }
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
    document.getElementById('toggle-advanced-search').addEventListener('click', function() {
    var advancedSearchForm = document.getElementById('advanced-search-form');
    
    // Toggle display of the advanced search form
    if (advancedSearchForm.style.display === 'none') {
        advancedSearchForm.style.display = 'block';
        this.textContent = 'Hide Advanced Search'; // Change button text
    } else {
        advancedSearchForm.style.display = 'none';
        this.textContent = 'Show Advanced Search'; // Change button text back
    }
});

</script>