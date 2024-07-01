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
    <link rel="stylesheet" href="adminstyles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
</head>
<body>
    <header>
        <div class="header-content">
            <img src="pic.png" alt="Company Logo" class="logo">
            <p>Hello Admin &#128512;</p>
            <a href="logout.php" id="logout-link">
                <button class="logout-button btn btn-primary">Logout</button>
            </a>

            <!-- The Modal -->
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
                    <li class="nav-item"><a class="nav-link" href="#reports">Reports</a></li>
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
                <h2>Reports</h2>
                <table id="userinfoTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date Of Birth</th>
                            <th>Collge</th>
                            <th>Contact</th>
                            <th>File Name</th>
                        </tr>
                    </thead>
                </table>
            </section>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 SNTI Internship.</p>
    </footer>
    <script src="adminscript.js"></script>
</body>
</html>
