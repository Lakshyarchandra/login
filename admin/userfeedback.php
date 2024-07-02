<?php
include 'connect.php'; // Include your database connection file

$sql = "SELECT email, feedback_type, comments FROM feedback";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["email"]. "</td>
                <td>" . $row["feedback_type"]. "</td>
                <td>" . $row["comments"]. "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No feedback found</td></tr>";
}
$conn->close();
?>
