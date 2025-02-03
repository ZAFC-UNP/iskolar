<?php
date_default_timezone_set('Asia/Kuala_Lumpur');

require './pdflib/logics-builder-pdf.php';
include('includes/dbcon.php'); // Include the database connection

// Get the selected scholarship program and college from the POST request
$scholarName = isset($_POST['scholarName']) ? $_POST['scholarName'] : '';
$college = isset($_POST['college']) ? $_POST['college'] : '';
$year = isset($_POST['year']) ? $_POST['year'] : '';
$schoolYear = isset($_POST['schoolYear']) ? $_POST['schoolYear'] : '';
$sem = isset($_POST['sem']) ? $_POST['sem'] : '';
$userType = isset($_POST['userType']) ? $_POST['userType'] : '';


// Get the current user's ID (assuming you store it in the session)
session_start();
$currentUserId = $_SESSION['uid'];

// Initialize the title variable
$title = '';

// Function to capitalize the first letter of each word in a string
function formatProperCase($string)
{
    return ucwords(strtolower($string)); // Lowercase and capitalize the first letter of each word
}

// Query to get the name and position of the current user
$userQuery = "SELECT CONCAT(
    UPPER(LEFT(up.firstname, 1)), LOWER(SUBSTRING(up.firstname, 2)), ' ',
    UPPER(LEFT(up.middlename, 1)), '.', ' ',  -- Middlename as initial with a period
    UPPER(LEFT(up.lastname, 1)), LOWER(SUBSTRING(up.lastname, 2)), ' ',
    up.suffix
) AS fullname
,
                     u.position
              FROM userprofile up
              INNER JOIN user u ON up.upId = u.upId
              WHERE u.uid = ?";
$stmtUser = $conn->prepare($userQuery);
$stmtUser->bind_param('i', $currentUserId);
$stmtUser->execute();
$stmtUser->store_result();
$stmtUser->bind_result($preparedByName, $preparedByPosition);
$stmtUser->fetch();
$stmtUser->close();

// Initialize the base query for the report
$query = "SELECT up.idNum, up.scholarName, up.college, up.course, up.year, up.schoolYear
          FROM archivedInformation up
          INNER JOIN user u ON up.upId = u.upId
          ";

// Initialize an array to hold the parameters 
$params = [];
$types = ''; // This will hold the types for the bind_param function
$subtitle = "";



// Apply filters based on user selection
if (!empty($scholarName)) {
    $query .= " AND up.scholarName = ? ";
    $params[] = $scholarName;
    $types .= 's'; // 's' denotes the type string for bind_param
    $title .= "for " . $scholarName . " ";
}

if (!empty($college)) {
    $query .= " AND up.college = ? ";
    $params[] = $college;
    $types .= 's';
    $title .=  "for ". $college ." ";
}

if (!empty($year)) {
    $query .= " AND up.year = ? ";
    $params[] = $year;
    $types .= 's';
    $title .= " " . $year . " ";
}
if (!empty($sem)) {
    $query .= " AND up.sem = ? ";
    $params[] = $sem;
    $types .= 's';
    $title .= " " . $sem . " ";
}
if (!empty($schoolYear)) {
    $query .= " AND up.schoolYear = ? ";
    $params[] = $schoolYear;
    $types .= 's';
    $title .= " " . $schoolYear . " ";
}
if (!empty($userType)) {
    $query .= " AND up.userType = ? ";
    $params[] = $userType;
    $types .= 's';
    if($userType!='dropped'){
    $subtitle .= $userType;
        }else{
        $subtitle .= 'Terminated';
    };
}
// Default title if no filters are applied
if (empty($title)) {
    $title = "All Past Registered Scholars";
}

// Finalize the query
$query .= " ORDER BY scholarName ASC, FIELD(year, '1st Year', '2nd Year', '3rd Year', '4th Year') ASC";
// Prepare the statement
$stmt = $conn->prepare($query);

// Bind the parameters if there are any
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

// Execute the query
$stmt->execute();
$stmt->store_result();

// Bind the columns selected in the query
$stmt->bind_result($idNum, $scholarName, $college, $course, $year, $schoolYear);

$formattedTitle = formatProperCase($title);
// Set the title for the PDF
$reportTitle =  $formattedTitle;
if(!empty($subtitle)){
    $subtitle = formatProperCase($subtitle) . ' Scholars';
};



$pdf = new LB_PDF('P', false, "Past Scholars Report");
$pdf->SetMargins(15, 10);
$pdf->SetAutoPageBreak(true, 15);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(8); // Add some space
$pdf->SetFont('Arial', '', 12); // Italic font
$pdf->Cell(0, 20, $reportTitle, 0, 0, 'C'); // Center-aligned message

if(!empty($subtitle)){
    $pdf->Ln(2);
    $pdf->Cell(0, 25, $subtitle, 0, 0, 'C');
}
// Set prepared by name and position
$pdf->setPreparedBy($preparedByName, $preparedByPosition);

// Check if there are any results
if ($stmt->num_rows === 0) {
    $pdf->Ln(10); // Add some space
    $pdf->SetFont('Arial', 'I', 12); // Italic font
    $pdf->Cell(0, 20, 'No student records found.', 0, 1, 'C'); // Center-aligned message
} else {

    // Set the table headers for the report
    $titlesArr = array('No', 'ID Number', 'Scholarship', 'College', 'Course', 'Year Level', 'School Year');
    $pdf->SetWidths(array(10, 30, 40, 30, 30, 20, 23));
    $pdf->SetAligns(array('L', 'L', 'L', 'L', 'L', 'L'));

    // Set initial Y-position based on page number
    if ($pdf->PageNo() === 1) {
        $pdf->Ln(20); // More space for first page
    } else {
        $pdf->SetY(50); // Adjust the starting Y-position on subsequent pages
    }

    // Add rows to the PDF with formatted data
    $i = 0;
    $currentScholarName = ''; // To keep track of the current scholar name

    while ($stmt->fetch()) {
        // Format scholarName and course with proper case
        $formattedScholarName = formatProperCase($scholarName);
        $formattedCourse = formatProperCase($course);
        $year = formatProperCase($year);

        // Check if the scholarName has changed
        if ($formattedScholarName !== $currentScholarName) {
            // If it's not the first group, add a page break
            if ($i > 0) {
                //$pdf->AddPage();
            }

            // Set the new scholar name as the current one
            $currentScholarName = $formattedScholarName;

            // Add the scholar name as a section header
            $pdf->SetFont('Arial', 'B', 14); // Bold font for the section header
            $pdf->Cell(0, 10, $currentScholarName, 0, 1, 'C'); // Center-aligned scholar name
            $pdf->Ln(5); // Add some space

            // Add the table header for this new section
            $pdf->AddTableHeader($titlesArr);
        }

        // Add the data to the PDF
        $i++;
        $data = array($i, $idNum, $formattedScholarName, $college, $formattedCourse, $year, $schoolYear);
        
        // Check if we're near the footer, and add a new page if needed
        if ($pdf->GetY() > 225) { // Adjust based on footer height
            $pdf->AddPage();
            $pdf->SetY(40); // Start the table a bit lower on new pages
            $pdf->AddTableHeader($titlesArr); // Re-add headers
        }
        
        $pdf->AddRow($data);
    }
    $pdf->ln(30);
}
$stmt->close();
$remainingSpace = $pdf->getPageHeight() - $pdf->GetY() - 130; // Footer height is 130
if ($remainingSpace < 0) { // If not enough space for the footer
    $pdf->AddPage(); // Add a new page to avoid overlap
}

// Footer logic for "Prepared by" section, displayed at the bottom of the last page

$pdf->SetX(-195);
$pdf->AddFont('Cambria', '', 'cambria.php');
$pdf->AddFont('Cambria', 'B', 'cambriab.php');
$pdf->SetFont('Cambria', '', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(21, 10, 'Prepared by: ' , 0, 0, 'L');
$pdf->SetFont('Cambria', 'B', 10);
$pdf->Cell(0, 10, $preparedByName, 0, 0, 'L'); 
$pdf->ln(5);
$pdf->SetFont('Cambria', '', 10);
$pdf->SetX(-195);
$pdf->Cell(0, 10, $preparedByPosition . ', Scholarships & Financial Assistance Services', 0, 0, 'L');

// Footer logic for "Prepared by" section, displayed at the bottom of the last page
$pdf->ln(30);  
$pdf->SetX(-195);
$pdf->SetFont('Cambria', '', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(15, 10, 'Noted by: ', 0, 0, 'L');
$pdf->SetFont('Cambria', 'B', 10);
$pdf->Cell(0, 10, 'Mariano Paterno F. Avila, Ed. D', 0, 0, 'L'); 
$pdf->ln(5);
$pdf->SetFont('Cambria', '', 10);
$pdf->SetX(-195);
$pdf->Cell(0, 10, 'Director, Office of Student Affairs and Services', 0, 0, 'L');

// Output the PDF to the browser
$pdf->Output('scholar_report_' . $title . '.pdf', 'I');

// Close the statement and connection
$conn->close();
?>
