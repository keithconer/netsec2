<?php
include('db.php'); // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize user input
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = base64_encode($_POST['password']); // Password encrypted with base64
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    
    // Check if username already exists
    $checkUsername = "SELECT * FROM usersAccounts WHERE username='$username'";
    $result = $conn->query($checkUsername);
    
    if ($result->num_rows > 0) {
        echo "Username already exists.";
    } else {
        // Insert the data into the database
        $sql = "INSERT INTO usersAccounts (fname, lname, username, password, age, address) 
                VALUES ('$fname', '$lname', '$username', '$password', '$age', '$address')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful. You can now <a href='login.php'>login</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<br><br><br>
<form method="POST" action="register.php" align="center">
    First Name: <input type="text" name="fname" required><br><br>
    Last Name: <input type="text" name="lname" required><br><br>
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Age: <input type="text" name="age" required><br><br>
    Address: <input type="text" name="address" required><br><br>
    <input type="submit" value="Register">
</form>
