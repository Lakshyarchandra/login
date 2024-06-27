<?php
session_start();
include 'connect.php';

$message = ""; // Initialize the message variable
$success = false; // Initialize the success variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; 
    $feedback_type = $_POST['feedback-type'];
    $comments = $_POST['comments'];

    $email = $conn->real_escape_string($email);
    $feedback_type = $conn->real_escape_string($feedback_type);
    $comments = $conn->real_escape_string($comments);

    // Insert feedback into the database
    $query = "INSERT INTO feedback (email, feedback_type, comments) VALUES ('$email', '$feedback_type', '$comments')";
    if ($conn->query($query) === TRUE) {
        $message = "Thank you for your feedback!";
        $success = true;
    } else {
        $message = "Error: " . $conn->error;
        $success = false;
    }

    // Store the message and success flag in session to display in the modal
    $_SESSION['feedback_message'] = $message;
    $_SESSION['feedback_success'] = $success;

    // Redirect back to the main page
    header("Location: homepage.php");
    exit();
}
?>
