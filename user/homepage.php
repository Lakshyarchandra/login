<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Feedback Portal</title>
    <link rel="stylesheet" href="userstyles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Datepicker CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header-content">
        <?php
        session_start();
        include 'connect.php';

        $email = $_SESSION['email'];
        $query = "SELECT * FROM userinfo WHERE email='$email'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $logoPath = $row['filepath'];
        } else {
            $logoPath = 'pic.png';
        }
        ?>
        <img src="<?php echo $logoPath; ?>" alt="Company Logo" class="logo">
        <p>Hello 
            <?php 
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $query = "SELECT * FROM `users` WHERE `email`='$email'";
                $result = mysqli_query($conn, $query);

                if (!$result) {
                    die("Query failed: " . mysqli_error($conn));
                }

                if ($row = mysqli_fetch_assoc($result)) {
                    echo htmlspecialchars($row['firstName'], ENT_QUOTES, 'UTF-8');
                } else {
                    echo "User not found.";
                }
            } else {
                echo "No session email set.";
            }
            ?> 
            &#128512;
        </p>
        <a href="logout.php" id="logout-link">
            <button class="logout-button">Logout</button>
        </a>

        <!-- The Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <p>Are you sure you want to logout?</p>
                <button class="confirm">Yes</button>
                <button class="cancel">No</button>
            </div>
        </div>
        </div>
    </header>
    <div class="dashboard">
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="#complete-registration">Complete Your Registration</a></li>
                    <li><a href="#show-details">Show Your Details</a></li>
                    <li><a href="#share-feedback">Share Your Feedback</a></li>
                </ul>
            </nav>
        </aside>
        <main class="content">
        <section id="complete-registration" class="section active">
                <h2>Complete Your Registration</h2>
                <form method="post" action="completeInfo.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date Of Birth (dd-mm-yyyy)</label>
                        <input type="text" id="dob" name="dob" class="form-control datepicker" required>
                    </div>
                    <div class="form-group">
                        <label for="collegeName">College Name</label>
                        <input type="text" id="college" name="college" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="course">Course</label>
                        <input type="text" id="course" name="course" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="text" id="contact" name="contact" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="file">Select image to upload:</label>
                        <input type="file" name="image" id="image" class="form-label" required>
                    </div>
                    <input type="submit" class="submit-button" value="Submit" name="complete-registration">
                </form>
            </section>
            <section id="show-details" class="section">
                <h2>Your Details</h2>
                <?php 
                if (isset($_SESSION['email'])) {
                    $email = $_SESSION['email'];
                    $query = mysqli_query($conn, "SELECT * FROM `userinfo` WHERE `email`='$email'");

                    if (mysqli_num_rows($query) > 0) {
                        $row = mysqli_fetch_assoc($query);
                        $dob = date('d - m - Y', strtotime($row['dob']));
                        $details = [
                            'Name' => $row['name'],
                            'Email' => $row['email'],
                            'Date Of Birth' => $dob,
                            'College Name' => $row['college'],
                            'Course' => $row['course'],
                            'Contact' => $row['contact']
                        ];

                        foreach ($details as $label => $value) {
                            echo "<p><strong>$label: $value</strong></p>";
                        }
                    } else {
                        echo "<p>Please complete your registration.</p>";
                    }
                } 
                ?>
            </section>
            <section id="share-feedback" class="section">
                <h2>Share Your Feedback</h2>
                <form action="submit_feedback.php" method="post">
                    <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                    <div class="form-group">
                        <label for="feedback-type">Feedback Type</label>
                        <select id="feedback-type" name="feedback-type" required>
                            <option value="general">General</option>
                            <option value="technical">Technical</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comments">Comments</label>
                        <textarea id="comments" name="comments" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="submit-button">Submit</button>
                </form>
            </section>
            <div id="feedbackModal" class="modal">
                <div class="modal-content">
                    <p id="modal-message"><?php 
                        if (isset($_SESSION['feedback_message'])) {
                            echo $_SESSION['feedback_message'];
                            unset($_SESSION['feedback_message']); // Clear the message after displaying
                        }
                    ?></p>
                    <span class="close">&times;</span>
                </div>
            </div>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 SNTI Internship.</p>
    </footer>
    <script src="userpagescript.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Your custom script -->
    <script src="userpagescript.js"></script>

    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true
            });
        });
    </script>
</body>
</html>
