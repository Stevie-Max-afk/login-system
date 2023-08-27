<?php
// Prevent browser caching
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../login.php");
    exit();
}

// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "project-thesis");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$query = "SELECT first_name FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $first_name = $user['first_name'];
} else {
    $first_name = "User"; // Default value if the first name is not found
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="icon" type="img/png" href="../img/logo.png">
    <script>
        window.onload = function() {
            var firstName = "<?php echo $first_name; ?>";
            alert("Welcome, " + firstName + "!");
        }
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "logout.php";
            }
        }
    </script>
</head>
<body>
    <h2>Welcome to the Landing Page</h2>
    <p>This is the main content of your application.</p>
    <p>Welcome, <?php echo $first_name; ?>!</p>
    <p><a href="#" onclick="confirmLogout();">Logout</a></p>
</body>
</html>