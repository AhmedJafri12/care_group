<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate input fields
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $specialization = filter_input(INPUT_POST, 'specialization', FILTER_SANITIZE_STRING);
    $license = filter_input(INPUT_POST, 'license', FILTER_SANITIZE_STRING);
    $password = $_POST['password'] ?? '';

    $errors = [];

    // Basic validations
    if (!$id) $errors[] = "ID is required.";
    if (!$fullname) $errors[] = "Full Name is required.";
    if (!$email) $errors[] = "A valid Email is required.";
    if (!$username) $errors[] = "Username is required.";
    if (!$city) $errors[] = "City is required.";
    if (!$address) $errors[] = "Address is required.";
    if (!$location) $errors[] = "Location is required.";
    if (!$phone) $errors[] = "Phone number is required.";
    if (!$specialization) $errors[] = "Specialization is required.";
    if (!$license) $errors[] = "Medical License Number is required.";
    if (!$password) $errors[] = "Password is required.";

    // If no errors, process the form
    if (empty($errors)) {
        // Hash the password for security
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Normally here you would save the data to a database
        // For now, just display a success message

        echo "<h1>Doctor Sign-Up Successful</h1>";
        echo "<p>Thank you, <strong>" . htmlspecialchars($fullname) . "</strong>, for signing up!</p>";
        echo "<ul>";
        echo "<li>ID: " . htmlspecialchars($id) . "</li>";
        echo "<li>Email: " . htmlspecialchars($email) . "</li>";
        echo "<li>Username: " . htmlspecialchars($username) . "</li>";
        echo "<li>City: " . htmlspecialchars($city) . "</li>";
        echo "<li>Address: " . htmlspecialchars($address) . "</li>";
        echo "<li>Location: " . htmlspecialchars($location) . "</li>";
        echo "<li>Phone: " . htmlspecialchars($phone) . "</li>";
        echo "<li>Specialization: " . htmlspecialchars($specialization) . "</li>";
        echo "<li>Medical License: " . htmlspecialchars($license) . "</li>";
        echo "</ul>";
        // Do NOT display password or hash publicly
    } else {
        // Show errors
        echo "<h2>Errors in form submission:</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo '<p><a href="signup.html">Go back to the form</a></p>';
    }
} else {
    // Redirect to form if accessed directly
    header("Location: signup.html");
    exit();
}
?>
