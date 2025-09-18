<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Doctor Form Submission</title>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f0f2f5;
      padding: 40px;
    }
    h1 {
      text-align: center;
      color: #2c3e50;
    }
    table {
      margin: 30px auto;
      width: 70%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 15px 20px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background: #4a90e2;
      color: white;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    tr:hover {
      background-color: #f1f1f1;
    }
    .back-link {
      text-align: center;
      margin-top: 20px;
    }
    .back-link a {
      color: #4a90e2;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize form inputs
    function clean($data) {
        return htmlspecialchars(trim($data));
    }

    $formData = [
        "ID" => clean($_POST['id'] ?? ''),
        "Full Name" => clean($_POST['fullname'] ?? ''),
        "Email" => clean($_POST['email'] ?? ''),
        "Username" => clean($_POST['username'] ?? ''),
        "City" => clean($_POST['city'] ?? ''),
        "Address" => clean($_POST['address'] ?? ''),
        "Location" => clean($_POST['location'] ?? ''),
        "Phone Number" => clean($_POST['phone'] ?? ''),
        "Specialization" => clean($_POST['specialization'] ?? ''),
        "Medical License" => clean($_POST['license'] ?? ''),
        "Password" => str_repeat('*', strlen($_POST['password'] ?? '')) // Hide actual password
    ];

    echo "<h1>Doctor Sign-Up Details</h1>";
    echo "<table>";
    echo "<tr><th>Field</th><th>Value</th></tr>";
    foreach ($formData as $key => $value) {
        echo "<tr><td>{$key}</td><td>{$value}</td></tr>";
    }
    echo "</table>";
    echo '<div class="back-link"><a href="signup.html">← Back to Sign-Up Form</a></div>';
} else {
    echo "<h1>No data submitted.</h1>";
    echo '<div class="back-link"><a href="signup.html">← Back to Sign-Up Form</a></div>';
}
?>

</body>
</html>
