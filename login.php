<?php
include('db.php'); // Include the database connection

session_start(); // Start the session to store user login status

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = base64_encode($_POST['password']); // Encrypt the password

    $sql = "SELECT * FROM usersAccounts WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username; // Store username in session
        header("Location: displayContent.php"); // Redirect to content page
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
?>

<form method="POST" action="login.php">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
</form>
