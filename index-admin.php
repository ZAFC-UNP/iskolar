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

if (empty(trim($_SESSION['fullName']))) {
    $_SESSION['fullName'] = 'Admin';
}

$fullName = ucwords(strtolower($_SESSION['fullName']));

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

    <title>iSkolar Online - Admin Dashboard</title>

<!-- Font Awesome -->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.js"></script>

<!-- Custom Styles -->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/bar.css" rel="stylesheet">

<!-- DataTables Stylesheet -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- jQuery (required for DataTables) - Load first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Popper.js -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<!-- DataTables -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Chart.js - Single version -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <link rel="icon" type="img/png" href="img/unplogo.png">
    

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
            transition: transform 0.5s ease; 
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
        @media (max-width: 768px) {
        #scholarsLineChart {
            width: 90%!important;
            height: 100%!important;
            margin: 0 auto!important;
        }
        }
        img{
            pointer-events: none;
        }

        .announcement-content {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            transition: all 0.3s ease;
            max-height: 3em; 
        }

        .content-expanded {
            white-space: normal;
            overflow: visible;
            max-height: none;
        }
        .carousel-control-prev{
            border: none;
            background-color: transparent;
            color: #fff;
            font-size: 20px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 0;

        }
        .carousel-control-next{
            border: none;
            background-color: transparent;
            color: #fff;
            font-size: 20px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 0;
            
        }
        .carousel-indicators button {
            width: 50px;
            height: 5px;
            margin-right: 5px;
            border-radius: 25px ;
            background-color: #888; 
            border: none;
            margin-bottom: 5px;
        }
        .carousel-indicators .active {
            background-color: #fff; 
        }
        .carousel-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
        }
        .carousel-item img {
            transition: transform 0.5s ease;
            height: 100%;
            object-fit: cover;
        }
        .chart-container {
            width: 100%;
            height: 400px; 
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .dropdown-menu.notifications-container {
            max-height: 300px; /* Set the maximum height you want */
            overflow-y: auto;  /* Enable vertical scrolling if content exceeds max-height */
        }
        .reset_btn {
    background-color: #007bff; /* Blue background */
    color: white; /* White text */
    padding: 10px 20px; /* Padding for size */
    font-size: 14px; /* Font size */
    border: none; /* Remove border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth transition */
    display: none;
}

.reset_btn:hover {
    background-color: #0056b3; /* Darker blue on hover */
    transform: scale(1.05); /* Slight scaling on hover */
}

.reset_btn:focus {
    outline: none; /* Remove outline when focused */
}

.reset_btn:active {
    background-color: #004085; /* Even darker blue when clicked */
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
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider ">
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
                        <a class="collapse-item" href="generatePastList.php">Previous Lists</a>
                    </div>
                </div>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="sidebar-heading">School Year</div>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="confirmNewTerm()">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Enter New Semester</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
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
        <!-- Notifications Dropdown -->
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
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline navbar-text text-white small">
                    <!-- Display the idNum here -->
                    <?php echo htmlspecialchars($username); ?> <br>
                    <div style="margin-top: -3px"> <?php echo htmlspecialchars($userType); ?> </div>
                </span>
                <img class="img-profile rounded-circle" src="<?php echo htmlspecialchars($photoPath); ?>" alt="Profile Photo"
                    onerror="this.onerror=null;this.src='img/undraw_profile.svg';">
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
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="img/carousel/1.png" class="d-block w-100" alt="Slide 1">
                    </div>
                    <div class="carousel-item">
                    <img src="img/carousel/2.png" class="d-block w-100" alt="Slide 2">
                    </div>
                    <div class="carousel-item">
                    <img src="img/carousel/3.png" class="d-block w-100" alt="Slide 3">
                    </div>
                    <div class="carousel-item">
                    <img src="img/carousel/4.png" class="d-block w-100" alt="Slide 3">
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"></span>
                </button>
                
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"></span>
                </button>
                </div>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 mt-3 text-gray-800">Admin Dashboard</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Total Users Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><span><a href="users.php">Total Scholars</a> </span></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            include('includes/dbcon.php');

                                            // $sql = "SELECT COUNT(*) AS total_users
                                            //     FROM (
                                            //         -- Select distinct users from userprofile who have a corresponding entry in the user table
                                            //         SELECT DISTINCT up.idNum
                                            //         FROM userprofile up
                                            //         INNER JOIN user u ON up.upId = u.upId
                                            //         WHERE u.userType = 'iskolar' OR u.userType = 'dropped'
                                                    
                                            //         UNION
                                            //         SELECT DISTINCT ai.idNum
                                            //         FROM archivedinformation ai
                                            //         WHERE ai.userType = 'iskolar' OR ai.userType = 'dropped'
                                            //     ) AS combined";

                                            $sql = "
                                            SELECT COUNT(*) AS total_users
                                            FROM user
                                            WHERE position = 'student' AND userType !='pending'
                                            ";

                                            $result = mysqli_query($conn, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                            echo $row["total_users"];
                                            ?>

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><span><a href="pending.php">Pending Scholar Application</a> </span></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                include('includes/dbcon.php');
                                                $sql = "SELECT COUNT(*) AS total_requests FROM user WHERE userType = 'pending'";
                                                $result = mysqli_query($conn, $sql);
                                                $row = mysqli_fetch_assoc($result);
                                                echo $row["total_requests"];
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- Graduated Card Example -->
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><span><a href="graduate.php">Total Graduated Scholars</a> </span></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                include('includes/dbcon.php');
                                                $sql = "SELECT COUNT(*) AS total_requests FROM user WHERE userType = 'graduated'";
                                                $result = mysqli_query($conn, $sql);
                                                $row = mysqli_fetch_assoc($result);
                                                echo $row["total_requests"];
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- Total dropped Card Example -->
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><span><a href="inactiveUsers.php">Total Terminated Scholars</a> </span></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                include('includes/dbcon.php');

                                                $sql = "SELECT COUNT(*) AS total_users
                                                    FROM (
                                                        -- Select distinct users from userprofile who have a corresponding entry in the user table
                                                        SELECT DISTINCT up.idNum
                                                        FROM userprofile up
                                                        INNER JOIN user u ON up.upId = u.upId
                                                        WHERE u.userType = 'dropped'
                                                    ) AS combined";

                                                $result = mysqli_query($conn, $sql);
                                                $row = mysqli_fetch_assoc($result);
                                                echo $row["total_users"];
                                                ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        
                        <?php
                            include('includes/dbcon.php');
                            // Retrieve announcements from database
                            $query = "SELECT * FROM announcement WHERE status= 'active' GROUP BY dateCreated DESC LIMIT 1";
                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $announcements[] = $row;
                                }
                            } else {
                                $announcements = array();
                            }

                            // Close connection
                            $conn->close();
                            ?>
                    </div>
                    <div class="row">
                         <d class="col-xl-12 mb-4">
                            <div class="card shadow h-100 py-2">
                                <div class="card-header bg-primary text-white py-3">
                                    <h6 class="m-0 font-weight-bold d-flex justify-content-between">📈 Past Scholar Count Graph</h6>                        
                                </div>
                                    <div class="card-body">
                                    <?php
                                    include('includes/dbcon.php');

                                    // Fetch all distinct school years from the database
                                    $sql_years = "SELECT DISTINCT schoolYear FROM archivedInformation
                                                ORDER BY schoolYear";
                                    $result_years = $conn->query($sql_years);

                                    $school_years = [];
                                    $scholar_counts = [];
                                    $dropped_counts = [];
                                    $graduated_counts = []; // New array for graduated counts
                                    $total_counts = [];

                                    // Initialize counts to zero for all years
                                    if ($result_years->num_rows > 0) {
                                        while ($row = $result_years->fetch_assoc()) {
                                            $year = $row['schoolYear'];
                                            $school_years[] = $year;
                                            $scholar_counts[$year] = 0;
                                            $dropped_counts[$year] = 0;
                                            $graduated_counts[$year] = 0; // Initialize graduated counts
                                            $total_counts[$year] = 0;
                                        }
                                    }

                                    // Query to count scholars by school year
                                    $sql_scholars = "SELECT schoolYear, COUNT(*) AS total_scholars
                                                    FROM archivedInformation
                                                    WHERE userType = 'iskolar'
                                                    GROUP BY schoolYear
                                                    ORDER BY schoolYear";
                                    $result_scholars = $conn->query($sql_scholars);

                                    if ($result_scholars->num_rows > 0) {
                                        while ($row = $result_scholars->fetch_assoc()) {
                                            $scholar_counts[$row['schoolYear']] = $row['total_scholars'];
                                        }
                                    }

                                    // Query to count dropped students by school year
                                    $sql_dropped = "SELECT schoolYear, COUNT(*) AS total_dropped
                                                    FROM archivedInformation
                                                    WHERE userType = 'dropped'
                                                    GROUP BY schoolYear
                                                    ORDER BY schoolYear";
                                    $result_dropped = $conn->query($sql_dropped);

                                    if ($result_dropped->num_rows > 0) {
                                        while ($row = $result_dropped->fetch_assoc()) {
                                            $dropped_counts[$row['schoolYear']] = $row['total_dropped'];
                                        }
                                    }

                                    // Query to count graduated students by school year
                                    $sql_graduated = "SELECT schoolYear, COUNT(*) AS total_graduated
                                                    FROM archivedInformation
                                                    WHERE userType = 'graduated'
                                                    GROUP BY schoolYear
                                                    ORDER BY schoolYear";
                                    $result_graduated = $conn->query($sql_graduated);

                                    if ($result_graduated->num_rows > 0) {
                                        while ($row = $result_graduated->fetch_assoc()) {
                                            $graduated_counts[$row['schoolYear']] = $row['total_graduated'];
                                        }
                                    }

                                    foreach ($school_years as $year) {
                                        $total_counts[$year] = $scholar_counts[$year] + $dropped_counts[$year] + $graduated_counts[$year];
                                    }

                                    // Convert PHP arrays to JSON for JavaScript
                                    $total_counts = json_encode(array_values($total_counts));
                                    $school_years = json_encode($school_years);
                                    $scholar_counts = json_encode(array_values($scholar_counts));
                                    $dropped_counts = json_encode(array_values($dropped_counts));
                                    $graduated_counts = json_encode(array_values($graduated_counts)); // Convert graduated counts to JSON
                                    ?>



                                        <div style="height:60vh; width: 80%; margin: 0 auto;">
                                            <canvas id="scholarsLineChart"></canvas>
                                        </div>
                                    </div>
                            </div>
                    </div>

                    <div class="row">
                        <!-- Scholar Type Pie Chart -->
                        <div class="col-xl-12 mb-4">
                            <div class="card shadow h-100 ">
                                <div class="card-header bg-warning text-white py-3">
                                    <h6 class="m-0 font-weight-bold d-flex justify-content-between">📝 Current Scholars Graph</h6>
                                </div>
                                <button onclick="revertChart()" class="reset_btn">Reset</button>

                                <div class="card-body">
                                <?php
                                include('includes/dbcon.php');

                                // Query to count users by scholarName where userType is 'iskolar'
                                $sql_scholarType = "SELECT userprofile.scholarName, COUNT(userprofile.upId) AS count
                                                    FROM userprofile
                                                    INNER JOIN user ON userprofile.upId = user.upId
                                                    WHERE user.userType = 'iskolar'
                                                    GROUP BY userprofile.scholarName";
                                $result_scholarType = $conn->query($sql_scholarType);

                                $scholarNames = [];
                                $scholarCounts = [];

                                if ($result_scholarType->num_rows > 0) {
                                    // If there are rows, fetch them
                                    while ($row = $result_scholarType->fetch_assoc()) {
                                        $scholarNames[] = $row['scholarName'];
                                        $scholarCounts[] = $row['count'];
                                    }

                                    // Format names (if needed)
                                    $scholarNames = array_map(function($name) {
                                        return ucwords(strtolower($name));
                                    }, $scholarNames);

                                    $scholarNames_json = json_encode($scholarNames);
                                    $scholarCounts_json = json_encode($scholarCounts);
                                } else {
                                    // No data found, setting default message for pie chart
                                    $scholarNames_json = json_encode(["No Current Scholar Data Yet"]);
                                    $scholarCounts_json = json_encode([1]);  // You can set count as 1 to indicate that it's a message
                                }
                                ?>

                                    <div class="chart-container">
                                        <canvas id="scholarsPieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                         <div class="col-xl-12 mb-4">
                            <div class="card shadow h-100 py-2">
                            <div class="card-header py-3 bg-success text-white">
                            <h6 class="m-0 font-weight-bold text-white d-flex justify-content-between">📢 List of Recent Announcements <span><a href='announcements.php' class="text-white">See all</a></span></h6></div>
                            <div class="card-body">
                                <?php if (!empty($announcements)) { ?>
                                    <?php foreach ($announcements as $announcement) { ?>
                                        <div class="row mb-3">
                                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                <img src="uploads/announcement/<?php echo htmlspecialchars($announcement['photo']); ?>" 
                                                    alt="Announcement Image" 
                                                    class="img-fluid rounded" 
                                                    style="max-height: 200px; object-fit: cover;">
                                            </div>
                                            <div class="col-md-8">
                                                <h5 class="font-weight-bold"><?php echo htmlspecialchars($announcement['title']); ?></h5>
                                                <p class="announcement-content content-collapsed"style="text-align:justify;"><?php echo htmlspecialchars($announcement['messageContent']); ?></p>
                                                <p><small class="text-muted">To: <?php echo htmlspecialchars($announcement['recipient']); ?> SCHOLARS</small></p>
                                                <p><small class="text-muted">Posted on <?php echo htmlspecialchars($announcement['dateCreated']); ?></small></p>
                                                <button class="btn btn-success btn-sm " onclick="toggleContent(this)">See More</button>
                                            </div>
                                        </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                    <p>No announcements yet</p>
                                <?php } ?>
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
    <!-- Scroll to Top Button
    <a class="scroll-to-top rounded" style="margin-bottom: 20px; margin-right: 10px;"href="#page-top">
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

   <!-- jQuery (Required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap core JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery Easing Plugin -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- DataTables -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Custom scripts for DataTables -->
<script src="js/demo/datatables-demo.js"></script>

<!-- Custom scripts for all pages (sb-admin-2) -->
<script src="js/sb-admin-2.min.js"></script>

    <script>
        $(document).ready(function() {
        var table = $('#dataTable');
        if (table.find('tbody tr').length === 0) {
        table.find('tbody').append('<tr><td colspan=\"8\">No Pending Data Found.</td></tr>');
        }
        table.DataTable();
        });
        </script>
    <script>
function acceptUser(upId, userType) {
    Swal.fire({
        title: 'Accept User',
        text: "Are you sure you want to accept this " + userType + "?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, accept!'
    }).then((result) => {
        if (result.isConfirmed) {
            processAccept(upId, userType);
        }
    });
}

function declineUser(upId, userType) {
    Swal.fire({
        title: 'Decline User',
        text: "Are you sure you want to decline this " + userType + "?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, decline!'
    }).then((result) => {
        if (result.isConfirmed) {
            processDecline(upId, userType);
        }
    });
}

function processAccept(upId, userType) {
    // AJAX request to process acceptance
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "controller/accept_user.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Show response message
            Swal.fire({
                icon: 'success',
                title: 'User Accepted',
                text: xhr.responseText
            }).then(() => {
                location.reload();
                // Update UI: Remove the row from the table upon successful acceptance
                if (xhr.responseText.includes("successfully")) {
                    var rowToRemove = document.querySelector('button[data-upid="' + upId + '"]').closest('tr');
                    if (rowToRemove) {
                        rowToRemove.remove();
                    }
                }
            });
        }
    };
    xhr.send("upId=" + upId + "&userType=" + userType);
}

function processDecline(upId, userType) {
    // AJAX request to process decline
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "controller/decline_user.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Show response message
            Swal.fire({
                icon: 'success',
                title: 'User Declined',
                text: xhr.responseText
            }).then(() => {
                location.reload();
                // Update UI: Remove the row from the table upon successful decline
                if (xhr.responseText.includes("successfully")) {
                    var rowToRemove = document.querySelector('button[data-upid="' + upId + '"]').closest('tr');
                    if (rowToRemove) {
                        rowToRemove.remove();
                    }
                }
            });
        }
    };
    xhr.send("upId=" + upId + "&userType=" + userType);
}
</script>

</script>

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
<!--  -->
<script>
function acceptUser(upId, userType) {
    console.log('acceptUser function called');
    Swal.fire({
        title: 'Accept User',
        text: "Are you sure you want to accept this " + userType + "?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, accept!'
    }).then((result) => {
        if (result.isConfirmed) {
            processAccept(upId, userType);
        }
    });
}

function declineUser(upId, userType) {
    console.log('declineUser function called');
    Swal.fire({
        title: 'Decline User',
        text: "Are you sure you want to decline this " + userType + "?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, decline!'
    }).then((result) => {
        if (result.isConfirmed) {
            processDecline(upId, userType);
        }
    });
}

function processAccept(upId, userType) {
    console.log('processAccept function called');
    // AJAX request to process acceptance
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "controller/accept_user.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Show response message
            Swal.fire({
                icon: 'success',
                title: 'User Accepted',
                text: xhr.responseText
            }).then(() => {
                location.reload();
                // Update UI: Remove the row from the table upon successful acceptance
                if (xhr.responseText.includes("successfully")) {
                    var rowToRemove = document.querySelector('button[data-upid="' + upId + '"]').closest('tr');
                    if (rowToRemove) {
                        rowToRemove.remove();
                    }
                }
            });
        }
    };
    xhr.send("upId=" + upId + "&userType=" + userType);
}

function processDecline(upId, userType) {
    console.log('processDecline function called');
    // AJAX request to process decline
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "controller/decline_user.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Show response message
            Swal.fire({
                icon: 'success',
                title: 'User Declined',
                text: xhr.responseText
            }).then(() => {
                location.reload();
                // Update UI: Remove the row from the table upon successful decline
                if (xhr.responseText.includes("successfully")) {
                    var rowToRemove = document.querySelector('button[data-upid="' + upId + '"]').closest('tr');
                    if (rowToRemove) {
                        rowToRemove.remove();
                    }
                }
            });
        }
    };
    xhr.send("upId=" + upId + "&userType=" + userType);
}
</script>
<script>
    function viewProfile(upId) {
        window.location.href = 'profile.php?upId=' + upId;
    }
</script>
<script>
function updateUserStatus(uid, newStatus) {
  // Send an AJAX request to update the user status
  $.ajax({
    type: 'POST',
    url: 'controller/update_user_status.php',
    data: { uid: uid, newStatus: newStatus },
    success: function(response) {
      // Update the UI to reflect the new status
      Swal.fire({
        icon: 'success',
        title: 'User status updated successfully!',
        text: 'The user status has been updated to ' + newStatus + '.',
        timer: 2000,
        showConfirmButton: false
    }).then(function() {
        location.reload();
      });
      
    },
    error: function(xhr, status, error) {
      Swal.fire({
        icon: 'error',
        title: 'Error updating user status!',
        text: 'An error occurred while updating the user status: ' + error,
        timer: 2000,
        showConfirmButton: false
    }).then(function() {
        location.reload();
      });
    }
  });
}
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
    var schoolYears = <?php echo json_encode($school_years); ?>;
    var scholarCounts = <?php echo json_encode($scholar_counts); ?>;
</script>
<script>
    // Extract only the 5 most recent school years and corresponding data
    var recentCount = 5;
    var schoolYears = <?php echo $school_years; ?>.slice(-recentCount); // Last 5 school years
    var scholarCounts = <?php echo $scholar_counts; ?>.slice(-recentCount);
    var droppedCounts = <?php echo $dropped_counts; ?>.slice(-recentCount);
    var graduatedCounts = <?php echo $graduated_counts; ?>.slice(-recentCount);
    var totalCounts = <?php echo $total_counts; ?>.slice(-recentCount);


    var ctx = document.getElementById('scholarsLineChart').getContext('2d');
    var scholarsBarChart = new Chart(ctx, {
        type: 'bar', // Changed from 'line' to 'bar'
        data: {
            labels: schoolYears, // X-axis: School Years
            datasets: [
                {
                    label: 'Number of Scholars',
                    data: scholarCounts, // Y-axis: Count of Scholars
                    backgroundColor: 'rgba(0, 123, 255, 0.6)', // Blue bars with 60% opacity
                    borderColor: 'rgba(0, 123, 255, 1)', // Darker blue borders
                    borderWidth: 1 // Bar border width
                },
                {
                    label: 'Number of Terminated Scholars',
                    data: droppedCounts, // Y-axis: Count of Dropped Students
                    backgroundColor: 'rgba(220, 53, 69, 0.6)', // Red bars with 60% opacity
                    borderColor: 'rgba(220, 53, 69, 1)', // Darker red borders
                    borderWidth: 1
                },
                {
                    label: 'Number of Graduated Scholars',
                    data: graduatedCounts, // Y-axis: Count of Dropped Students
                    backgroundColor: 'rgba(255, 193, 7, 0.6)',  // A yellow background
                    borderColor: 'rgba(255, 193, 7, 1)',      // A yellow border
                    borderWidth: 1
                },
                {
                    label: 'Total Count',
                    data: totalCounts, // Y-axis: Total Count (Scholars + Dropped)
                    backgroundColor: 'rgba(0, 255, 0, 0.6)', // Green bars with 60% opacity
                    borderColor: 'rgba(0, 255, 0, 1)', // Darker green borders
                    borderWidth: 1
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'School Year',
                        font: {
                            size: 16, // Larger font size for axis titles
                            weight: 'bold',
                            family: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif", // Font family
                        }
                    },
                    grid: {
                        display: false, // Remove vertical grid lines
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Scholars',
                        font: {
                            size: 16,
                            weight: 'bold',
                            family: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                        }
                    },
                    ticks: {
                        stepSize: 1,
                        maxTicksLimit: 5,
                        padding: 10,
                        callback: function(value, index, values) {
                            return value; // Customize as needed
                        }
                    },
                    grid: {
                        color: "rgba(200, 200, 200, 0.5)", // Light gray grid lines
                        drawBorder: false,
                        borderDash: [5, 5], // Dashed grid lines
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 15, // Smaller legend boxes
                        padding: 20, // Extra padding around labels
                        font: {
                            family: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif", // Font family for legend
                            size: 14 // Font size for legend labels
                        }
                    }
                },
                tooltip: {
                    backgroundColor: "rgba(255,255,255,0.9)", // Semi-transparent white tooltip background
                    bodyColor: "#000000", // Black text for tooltip
                    titleColor: '#333333', // Darker title color
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    borderColor: 'rgba(0, 0, 0, 0.1)', // Light border color for tooltip
                    borderWidth: 1,
                    padding: 10,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.dataset.label + ': ' + tooltipItem.raw; // Tooltip formatting
                        }
                    }
                }
            }
        }
    });
</script>


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
}
</script>

<script>
// Function to generate random colors (if needed for more scholars)
function getRandomColor() {
    return 'rgba(' + Math.floor(Math.random() * 255) + ',' +
           Math.floor(Math.random() * 255) + ',' +
           Math.floor(Math.random() * 255) + ', 0.6)';
}

// Doughnut Chart for Scholar Types with Proper Legend Wrapping
var scholarNames = <?php echo $scholarNames_json; ?>;
var scholarCounts = <?php echo $scholarCounts_json; ?>;

var colors = ['#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd', '#8c564b'];

// Add more colors dynamically if there are more than 6 scholars
while (colors.length < scholarNames.length) {
    colors.push(getRandomColor());
}

var ctx2 = document.getElementById('scholarsPieChart').getContext('2d');
var scholarsPieChart = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: scholarNames,
        datasets: [{
            data: scholarCounts,
            backgroundColor: colors,
            borderColor: '#ffffff',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '50%',
        onClick: function(evt, activeEls) {
            if (activeEls.length > 0) {
                var index = activeEls[0].index;
                var selectedProgram = scholarNames[index];
                fetchDrillDownData(selectedProgram); // Fetch drill-down data
            }
        },
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    boxWidth: 15,
                    padding: 5,
                    font: {
                        size: 18,
                        weight: 'normal'
                    },
                    generateLabels: function(chart) {
                        var data = chart.data;
                        return data.labels.map(function(label, i) {
                            return {
                                text: label,
                                fillStyle: data.datasets[0].backgroundColor[i],
                                hidden: isNaN(data.datasets[0].data[i]),
                                index: i
                            };
                        });
                    }
                },
                title:{
                display: true,
                position: 'left',
                text:'Scholarship Programs',
                color: 'black',
                font: {
                    size: 16,
                    weight: 'bold',
                },
            }
        },
            
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                bodyColor: '#ffffff',
                titleColor: '#ffffff',
                titleFont: {
                    size: 18,
                    weight: 'bold'
                },
                borderColor: 'rgba(255, 255, 255, 0.5)',
                borderWidth: 1,
                padding: 10,
                displayColors: false,
                callbacks: {
                    label: function(context) {
                        let label = context.label || '';
                        if (label) {
                            label += ': ' + context.raw;
                        }
                        return label;
                    }
                }
            },
            datalabels: {
                color: '#fff',
                font: {
                    size: 14,
                    weight: 'bold'
                },
                formatter: function(value) {
                    return value;
                },
                anchor: 'center',
                align: 'center'
            }
        }
    },
    plugins: [ChartDataLabels]
});

// Store the original data when the page loads
var originalLabels = scholarNames;  // Store original labels
var originalCounts = scholarCounts;  // Store original counts

// Function to refresh the chart with new data
function refreshChart(newLabels, newCounts) {
    scholarsPieChart.data.labels = newLabels;
    scholarsPieChart.data.datasets[0].data = newCounts;
    scholarsPieChart.update();
}

// Function to revert the chart to the original data
function revertChart() {
    refreshChart(originalLabels, originalCounts);
    scholarsPieChart.options.plugins.legend.title = {
        display: true,
                position: 'left',
                text:'Scholarship Programs',
                color: 'black',
                font:{
                    size: 16,
                    weight: 'bold'
                }
                    

    };
    scholarsPieChart.update();
    document.querySelector('.reset_btn').style.display = 'none';
}

// Function to fetch and display drill-down data
function fetchDrillDownData(selectedProgram) {
    $.ajax({
    url: 'controller/drilldown.php',
    method: 'POST',
    data: { program: selectedProgram },
    success: function(response) {
        // Now `response` is already a parsed object, so we can directly access it.
        if (response.error) {
            console.error("Error fetching drill-down data:", response.error);
            return;
        }

        updateChartForDrillDown(response.labels, response.counts, selectedProgram);
        document.querySelector('.reset_btn').style.display = 'inline-block'; // Or 'block' for block-level display
    },
    error: function(xhr, status, error) {
        console.error("Error fetching drill-down data:", error);
    }
});
}

// Function to update chart with drill-down data
function updateChartForDrillDown(labels, counts, programName) {
    scholarsPieChart.data.labels = labels;
    scholarsPieChart.data.datasets[0].data = counts;
    scholarsPieChart.options.plugins.legend.title = {
        display: true,
        display: true,
                position: 'left',
                text:'Scholars',
                color: 'black',
                font:{
                    size: 16,
                    weight: 'bold'
                }
                    

    };
    scholarsPieChart.update();
}


</script>
<script>
// Function to generate random colors (if needed for more scholars)
function getRandomColor() {
    return 'rgba(' + Math.floor(Math.random() * 255) + ',' + 
           Math.floor(Math.random() * 255) + ',' + 
           Math.floor(Math.random() * 255) + ', 0.6)';
}

// Variables for chart data from PHP
var scholarNames = <?php echo $dropNames_json; ?>;
var scholarCounts = <?php echo $dropCounts_json; ?>;

var colors = ['#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd', '#8c564b'];

// Add more colors dynamically if there are more than 6 scholars
while (colors.length < scholarNames.length) {
    colors.push(getRandomColor());
}

// Initialize the chart
var ctx2 = document.getElementById('scholarsPieChart').getContext('2d');
var scholarsPieChart = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: scholarNames,
        datasets: [{
            data: scholarCounts,
            backgroundColor: colors,
            borderColor: '#ffffff',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '50%',
        onClick: function(evt, activeEls) {
            console.log("Chart clicked"); // Log to confirm chart click
            if (activeEls.length > 0) {
                var index = activeEls[0].index;
                var selectedProgram = scholarNames[index];
                console.log("Clicked on program:", selectedProgram); // Log selected program
                fetchDrillDownData(selectedProgram); // Fetch drill-down data
            }
        },
        plugins: {
            legend: {
                position: 'right',
                labels: { /* styling */ }
            },
            tooltip: { /* tooltip styling */ },
            datalabels: { /* datalabels styling */ }
        }
    }
});

// Function to fetch and display drill-down data
function fetchDrillDownData(selectedProgram) {
    $.ajax({
        url: 'controller/drilldown.php',
        method: 'POST',
        data: { program: selectedProgram },
        success: function(response) {
            if (response.error) {
                console.error("Error fetching drill-down data:", response.error);
                return;
            }

            // The response is already parsed as a JavaScript object
            updateChartForDrillDown(response.labels, response.counts, selectedProgram);
        },
        error: function(xhr, status, error) {
            console.error("Error fetching drill-down data:", error);
        }
    });
}


// Function to update chart with drill-down data
function updateChartForDrillDown(labels, counts) {
    scholarsPieChart.data.labels = labels;
    scholarsPieChart.data.datasets[0].data = counts;
    scholarsPieChart.update();
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


</body>
</html>