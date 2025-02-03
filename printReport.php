<?php
date_default_timezone_set('Asia/Kuala_Lumpur');

require './pdflib/logics-builder-pdf.php';
include('includes/dbcon.php'); // Include the database connection

// Start session and get the current user's ID
session_start();
$currentUserId = $_SESSION['uid'];

// Get the selected scholarship program and college from the POST request
$scholarName = $_POST['scholarName'] ?? '';
$college = $_POST['college'] ?? '';
$sem = $_POST['sem'] ?? '';
$year = $_POST['year'] ?? '';
$schoolYear = $_POST['schoolYear'] ?? '';

// Function to capitalize the first letter of each word in a string
function formatProperCase($string) {
    return ucwords(strtolower($string)); // Lowercase and capitalize the first letter of each word
}

// Query to get the name and position of the current user
$userQuery = "SELECT CONCAT(
    UPPER(LEFT(up.firstname, 1)), LOWER(SUBSTRING(up.firstname, 2)), ' ',
    UPPER(LEFT(up.middlename, 1)), '.', ' ',
    UPPER(LEFT(up.lastname, 1)), LOWER(SUBSTRING(up.lastname, 2)), ' ',
    up.suffix
) AS fullname, u.position
FROM userprofile up
INNER JOIN user u ON up.upId = u.upId
WHERE u.uid = ?";
$stmtUser  = $conn->prepare($userQuery);
$stmtUser ->bind_param('i', $currentUserId);
$stmtUser ->execute();
$stmtUser ->store_result();
$stmtUser ->bind_result($preparedByName, $preparedByPosition);
$stmtUser ->fetch();
$stmtUser ->close();

// Query to get the latest schoolYear and sem
$latestQuery = "SELECT schoolYear, sem FROM userprofile ORDER BY schoolYear DESC, sem DESC LIMIT 1";
$stmtLatest = $conn->prepare($latestQuery);
$stmtLatest->execute();
$stmtLatest->store_result();
$stmtLatest->bind_result($latestSchoolYear, $latestSem);
$stmtLatest->fetch();
$stmtLatest->close();

// Initialize the base query for the report
$query = "SELECT up.firstname, up.middlename, up.lastname, up.suffix, up.scholarName, up.college, up.course, up.year
          FROM userprofile up
          INNER JOIN user u ON up.upId = u.upId
          WHERE u.userType = 'iskolar'";

// Initialize an array to hold the parameters 
$params = [];
$types = ''; // This will hold the types for the bind_param function
$title = '';

// Apply filters based on user selection
if (!empty($scholarName)) {
    $query .= " AND up.scholarName = ? ";
    $params[] = $scholarName;
    $types .= 's';
    $title .= "for " . $scholarName . " ";
}

if (!empty($college)) {
    $query .= " AND up.college = ? ";
    $params[] = $college;
    $types .= 's';
    $title .= "in " . $college . " ";
}

if (!empty($year)) {
    $query .= " AND up.year = ? ";
    $params[] = $year;
    $types .= 's';
    $title .= " " . $year . " ";
}

if (!empty($schoolYear)) {
    $query .= " AND up.schoolYear = ? ";
    $params[] = $schoolYear;
    $types .= 's';
    $title .= " " . $schoolYear . " ";
}

if (!empty($sem)) {
    $query .= " AND up.sem = ? ";
    $params[] = $sem;
    $types .= 's';
    $title .= " " . $sem . " ";
}

$title.= " ". $latestSchoolYear . " " . $latestSem;
// Default title if no filters are applied
if (empty($title)) {
    $title = "All Registered Scholars for " . $latestSchoolYear . " " . $latestSem;
}

// Finalize the query
$query .= " ORDER BY scholarName ASC";

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
$stmt->bind_result($firstname, $middlename, $lastname, $suffix, $scholarName, $college, $course, $year);
$formattedTitle = formatProperCase($title);
$reportTitle = $formattedTitle;

$pdf = new LB_PDF('P', false, "Registered Scholar Report");
$pdf->SetMargins(15, 10);
$pdf->SetAutoPageBreak(true, 15);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(8); // Add some space
$pdf->SetFont('Arial', '', 12); // Regular font
$pdf->Cell(0, 20, $reportTitle, 0, 0, 'C'); // Center-aligned message

// Set prepared by name and position
$pdf->setPreparedBy($preparedByName, $preparedByPosition);

// Check if there are any results
if ($stmt->num_rows === 0) {
    // No student records found
    $pdf->Ln(10); // Add some space
    $pdf->SetFont('Arial', 'I', 12); // Italic font
    $pdf->Cell(0, 20, 'No student records found.', 0, 1, 'C'); // Center-aligned message
} else {
    // Set the table headers for the report
    $titlesArr = array('No', 'Name', 'Scholarship', 'College', 'Course', 'Year Level');
    $pdf->SetWidths(array(10, 40, 40, 30, 30, 30));
    $pdf->SetAligns(array('L', 'L', 'L', 'L', 'L'));
    $pdf->Ln(20);

    $pdf->AddTableCaption("Scholar Profile");
    //$pdf->AddTableHeader($titlesArr);

    // Add rows to the PDF with formatted data
    $i = 0;
    $currentScholarName = '';

    while ($stmt->fetch()) {
        // Concatenate name components with spaces and remove empty parts
        $fullname = trim(formatProperCase($firstname) . ' ' . formatProperCase($middlename) . ' ' . formatProperCase($lastname) . ' ' . strtoupper($suffix));

        // Format scholarName and course with proper case
        $formattedScholarName = formatProperCase($scholarName);
        $formattedCourse = formatProperCase($course);
        $year = formatProperCase($year);

        if ($formattedScholarName !== $currentScholarName) {
            // If it's not the first group, add a page break
            if ($i > 0) {
                $pdf->ln(5);
                $i = 0;
            }
    
            // Set the new scholar name as the current one
            $currentScholarName = $formattedScholarName;
    
            // Add the scholar name as a section header
            $pdf->SetFont('Arial', 'B', 12); // Bold font for the section header
            $pdf->Cell(0, 10, $currentScholarName, 0, 1, 'L'); // Left-aligned scholar name
            $pdf->Ln(5); // Add some space
    
            $pdf->SetFont('Arial', '', 10);
            // Add the table header for this new section
            $pdf->AddTableHeader($titlesArr);
        }

        // Check if we're near the footer, and add a new page if needed
        if ($pdf->GetY() > 225) { // Adjust based on footer height
            $pdf->AddPage();
            $pdf->SetY(40); // Start the table a bit lower on new pages
            $pdf->AddTableHeader($titlesArr); // Re-add headers
        }

        // Add the data to the PDF
        $i++;
        $data = array($i, $fullname, $formattedScholarName, $college, $formattedCourse, $year);
        $pdf->AddRow($data);
    }
    $pdf->ln(20);
}

$remainingSpace = $pdf->getPageHeight() - $pdf->GetY() - 90;
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
$stmt->close();
$conn->close();
?>
