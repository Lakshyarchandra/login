<?php
header('Content-Type: text/html');
require 'connect.php';

// Query to get the user info and feedback details
$sql = "
    SELECT u.name, u.email, u.dob, u.college, u.contact, u.filename, f.feedback_type, f.comments, f.submission_date
    FROM userinfo u 
    LEFT JOIN feedback f ON u.email = f.email
";
$result = $conn->query($sql);

// Array to hold grouped data
$userData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $email = $row['email'];
        if (!isset($userData[$email])) {
            $userData[$email] = [
                'name' => $row['name'],
                'dob' => $row['dob'],
                'college' => $row['college'],
                'contact' => $row['contact'],
                'filename' => $row['filename'],
                'feedbacks' => []
            ];
        }
        $userData[$email]['feedbacks'][] = [
            'feedback_type' => $row['feedback_type'],
            'comments' => $row['comments'],
            'submission_date' => $row['submission_date']
        ];
    }
}

// Generate HTML table rows
foreach ($userData as $email => $data) {
    $rowspan = count($data['feedbacks']);
    echo "
    <tr>
        <td rowspan='{$rowspan}'>{$data['name']}</td>
        <td rowspan='{$rowspan}'>{$email}</td>
        <td rowspan='{$rowspan}'>{$data['dob']}</td>
        <td rowspan='{$rowspan}'>{$data['college']}</td>
        <td rowspan='{$rowspan}'>{$data['contact']}</td>
        <td rowspan='{$rowspan}'>{$data['filename']}</td>
        <td>{$data['feedbacks'][0]['feedback_type']}</td>
        <td>{$data['feedbacks'][0]['comments']}</td>
        <td>{$data['feedbacks'][0]['submission_date']}</td>
    </tr>";

    for ($i = 1; $i < $rowspan; $i++) {
        echo "
        <tr>
            <td>{$data['feedbacks'][$i]['feedback_type']}</td>
            <td>{$data['feedbacks'][$i]['comments']}</td>
            <td>{$data['feedbacks'][$i]['submission_date']}</td>
        </tr>";
    }
}

$conn->close();
?>
