<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM students WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['student_id'] = $user['id'];
        $_SESSION['student_name'] = $user['full_name'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid email or password'); window.location='login.html';</script>";
    }
}
?>
