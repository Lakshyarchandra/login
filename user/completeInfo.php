<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $college = $_POST['college'];
    $course = $_POST['course'];
    $contact = $_POST['contact'];

    // Sanitize input
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $dob = $conn->real_escape_string($dob);
    $college = $conn->real_escape_string($college);
    $course = $conn->real_escape_string($course);
    $contact = $conn->real_escape_string($contact);

    // Check if the email is already registered
    $checkQuery = "SELECT * FROM userinfo WHERE email='$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "<script> 
                alert('Registration Status: Already Registered !! Check Your Details!!');
                window.location.href = 'homepage.php';
              </script>";
    } else {
        // Insert new user
        $query = "INSERT INTO userinfo (name, email, dob, college, course, contact)
                  VALUES ('$name', '$email', '$dob', '$college', '$course', '$contact')";
        if ($conn->query($query) === TRUE) {
            echo "<script> 
                    alert('Registration Status: Successfully Registered !! Check Your Details');
                    window.location.href = 'homepage.php';
                  </script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    exit();
}
?>