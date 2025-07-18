<?php
include 'config.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.html");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin-login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = intval($_POST['student_id']);
    $status = $conn->real_escape_string($_POST['status']);
    $conn->query("UPDATE students SET status='$status' WHERE id=$student_id");
}

$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Panel - KITUNTU SECONDARY SCHOOL</title>
<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<div class="container">
  <h2>Admin Panel</h2>
  <a href="?logout=true" class="btn" style="background:#dc3545;">Logout</a>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Exam Number</th>
        <th>Status</th>
        <th>Update Status</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td><?php echo htmlspecialchars($row['phone']); ?></td>
        <td><?php echo htmlspecialchars($row['exam_number']); ?></td>
        <td><?php echo $row['status']; ?></td>
        <td>
          <form method="POST" action="">
            <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>" />
            <select name="status" required>
              <option value="">--Select--</option>
              <option value="Pending" <?php if($row['status']=='Pending') echo 'selected'; ?>>Pending</option>
              <option value="Approved" <?php if($row['status']=='Approved') echo 'selected'; ?>>Approved</option>
              <option value="Rejected" <?php if($row['status']=='Rejected') echo 'selected'; ?>>Rejected</option>
            </select>
            <button type="submit" class="btn">Update</button>
          </form>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
