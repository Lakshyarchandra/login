<?php
session_start();
require 'connect.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminEmail = $_POST['adminEmail'];
    $adminPassword = $_POST['adminPassword'];

    // Ensure the correct table and column names are used
    $sql = "SELECT * FROM admin WHERE email='$adminEmail' AND pass='$adminPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['admin'] = true;
        $_SESSION['adminEmail'] = $row['email'];
        header("Location: admindashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid Credentials!'); window.location.href = '../login/index.php';</script>";
    }
}
?>
