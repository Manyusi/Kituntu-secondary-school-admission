<?php
include 'config.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login.html");
    exit();
}

$student_id = $_SESSION['student_id'];

$sql = "SELECT status FROM students WHERE id='$student_id'";
$result = $conn->query($sql);
$status = "Unknown";

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $status = $row['status'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Dashboard - KITUNTU SECONDARY SCHOOL</title>
<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<div class="container">
  <h2>Welcome, <?php echo htmlspecialchars($_SESSION['student_name']); ?></h2>
  <p>Your application status is: <strong><?php echo htmlspecialchars($status); ?></strong></p>
  <a href="logout.php" class="btn">Logout</a>
</div>
</body>
</html>
