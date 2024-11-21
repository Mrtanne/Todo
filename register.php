<?php
include("db.php");
session_start();

// Check database connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {   
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $Gender = $_POST['gender'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (!empty($firstname) && !empty($hashed_password)) {
        // Prepare the SQL statement
        $stmt = $con->prepare("INSERT INTO tbltodo (fname, lname, gender, tel, address, email, pass) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        // Check if prepare was successful
        if (!$stmt) {
            die("Prepare failed: (" . $con->errno . ") " . $con->error);
        }

        $stmt->bind_param("sssssss", $firstname, $lastname, $Gender, $tel, $address, $email, $hashed_password);
        
        // Execute the statement and check for success
        if ($stmt->execute()) {
            echo "<script type='text/javascript'> alert('Registration Successful');</script>";
        } else {
            echo "<script type='text/javascript'> alert('Error: " . $stmt->error . "');</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script type='text/javascript'> alert('Please enter some valid information');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styleshit.css">
</head>
<body>
<div class="signup">
    <h1>Sign Up</h1>
    <form method="POST">
        <label for="First Name">First Name:</label>
        <input type="text" name="fname" required>
        <label for="Last Name">Last Name:</label>
        <input type="text" name="lname" required>
        <label for="Gender">Gender:</label>
        <input type="text" name="gender" required>
        <label for="Contact">Contact:</label>
        <input type="tel" name="tel" required>
        <label for="Address">Address:</label>
        <input type="text" name="address" required>
        <label for="Email">Email:</label>
        <input type="email" name="email" required>
        <label for="Password">Password:</label>
        <input type="password" name="pass" required>
        <input type="submit" value="Submit">
        <p>Already have an account?<a href="login.php">click here</a> to login</p>
    </form>
</div>
</body>
</html>