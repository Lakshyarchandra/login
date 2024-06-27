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
        // Handle file upload
        $target_dir = "image/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $filename = basename($_FILES["image"]["name"]);
                $filepath = $target_file;

                // Insert new user with file info
                $query = "INSERT INTO userinfo (name, email, dob, college, course, contact, filename, filepath)
                          VALUES ('$name', '$email', '$dob', '$college', '$course', '$contact', '$filename', '$filepath')";
                if ($conn->query($query) === TRUE) {
                    echo "<script> 
                            alert('Registration Status: Successfully Registered !! Check Your Details');
                            window.location.href = 'homepage.php';
                          </script>";
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    exit();
}
?>
