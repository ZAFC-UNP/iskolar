<?php 
include('includes/dbcon.php');

$sql = "SELECT * FROM logs" ;
$result = $conn->query($sql);

$logContent = "";
// $user = $row['username'];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $logContent .= "Log ID: " . $row['id'] . "\n";
        $logContent .= "Actor: " . $row['username'] . "\n";
        $logContent .= "Action: " . $row['event_type'] . ": " . $row['event_details'] . "\n";
        $logContent .= "Log Date: " . $row['created_at'] . "\n";
        $logContent .= "\n";
    }
} else {
    $logContent = "No logs found.";
}
$conn->close();

$date = date("m-d-y");
header('Content-Type:text/plain');
header('Content-Disposition:attachment; filename="logs"'.$date .'".txt"');
header('Content-Length: '.strlen($logContent));

echo $logContent ;
?>