<?php
session_start();
require 'connect.php'; // Include your database connection file

if (!isset($_SESSION['adminEmail'])) {
    header("Location: ../login/index.php");
    exit();
}

$email = $_SESSION['adminEmail'];
$query = mysqli_query($conn, "SELECT * FROM `admin` WHERE `email`='$email'");

$details = [];
if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $details = [
        'Name' => $row['name'],
        'Email' => $row['email'],
        'Date Of Birth' => $row['dob'],
        'Department' => $row['department'],
        'Contact' => $row['contact']
    ];
} else {
    $details['Error'] = "No Info Found !! Contact Helpdesk";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="adminstyle.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html-docx-js/0.3.1/html-docx.min.js"></script>
</head>
<body>
    <header>
        <div class="header-content">
            <img src="pic.png" alt="Company Logo" class="logo">
            <p>Hello Admin &#128512;</p>
            <a href="logout.php" id="logout-link">
                <button class="logout-button btn btn-primary">Logout</button>
            </a>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <p>Are you sure you want to logout?</p>
                    <button class="confirm btn btn-danger">Yes</button>
                    <button class="cancel btn btn-secondary">No</button>
                </div>
            </div>
        </div>
    </header>
    <div class="dashboard">
        <aside class="sidebar">
            <nav>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="#personal-information">Personal Information</a></li>
                    <li class="nav-item"><a class="nav-link" href="#reports">Registered User Details</a></li>
                </ul>
            </nav>
        </aside>
        <main class="content">
            <section id="personal-information" class="section active">
                <h2>Personal Information</h2>
                <?php
                if (!empty($details['Error'])) {
                    echo "<p>{$details['Error']}</p>";
                } else {
                    foreach ($details as $label => $value) {
                        echo "<p><strong>$label: $value</strong></p>";
                    }
                }
                ?>
            </section>
            <section id="reports" class="section">
                <h2>Registered User Details</h2>
                <table id="userinfoTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date Of Birth</th>
                            <th>College</th>
                            <th>Contact</th>
                            <th>File Name</th>
                            <th>Feedback Type</th>
                            <th>Comments</th>
                            <th>Submission Date </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated here by JavaScript -->
                    </tbody>
                </table>
                <button class="export-word">Export Word</button>
                <button class="export-csv">Export CSV</button>
                
            </section>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 SNTI Internship.</p>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="adminscripts.js"></script>
</body>
</html>
