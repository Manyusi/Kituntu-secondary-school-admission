<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $exam = $conn->real_escape_string($_POST['exam_number']);
    $password = md5($_POST['password']);

    // Check if email already exists
    $check = $conn->query("SELECT * FROM students WHERE email='$email'");
    if ($check->num_rows > 0) {
        echo "<script>alert('Email already registered'); window.location='register.html';</script>";
        exit();
    }

    $sql = "INSERT INTO students (full_name, email, phone, exam_number, password, status) 
            VALUES ('$name', '$email', '$phone', '$exam', '$password', 'Pending')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful! Please login'); window.location='login.html';</script>";
    } else {
        echo "<script>alert('Registration failed! Try again'); window.location='register.html';</script>";
    }
}
?>
