<?php
include('db.php');
session_start(); // Start the session to check if the user is logged in

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

$username = $_SESSION['username']; // Get the logged-in username
$sql = "SELECT * FROM usersAccounts"; // Retrieve all user accounts
$result = $conn->query($sql);

echo "<h1>Welcome back, " . htmlspecialchars($username) . "!</h1>";
?>

<table border="1">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Age</th>
        <th>Address</th>
    </tr>

    <?php
    // Loop through the results and display each user account in a table row
    while ($user = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($user['fname']) . "</td>";
        echo "<td>" . htmlspecialchars($user['lname']) . "</td>";
        echo "<td>" . htmlspecialchars($user['username']) . "</td>";
        echo "<td>" . htmlspecialchars($user['age']) . "</td>";
        echo "<td>" . htmlspecialchars($user['address']) . "</td>";
        echo "</tr>";
    }
    ?>

</table>

<a href="logout.php">Logout</a>
