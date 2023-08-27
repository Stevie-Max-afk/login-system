<!DOCTYPE html>
<html>
<head>
    <title>Join DevMap</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="icon" type="img/png" href="./img/logo.png">
</head>
<body>
    <div class="container">
    <h2>Sign Up</h2>
    
    <?php
    // Establish a database connection
    $conn = mysqli_connect("localhost", "root", "", "project-thesis");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat_password'];

        // Check if passwords match
        if ($password !== $repeat_password) {
            echo "<script>
            alert('Passwords do not match.');
            </script>";
        } elseif (strlen($password) < 8 || !preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password)) {
            echo "<script>
            alert('Password must be at least 8 characters long and contain special characters.');
            </script>";
        } else {
            // Check if the email is already registered
            $check_query = "SELECT id FROM users WHERE email = '$email'";
            $check_result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                echo "<script>
                alert('Email already registered.');
              </script>";
            } else {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert user data into the database
                $insert_query = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$hashed_password')";

                if (mysqli_query($conn, $insert_query)) {
                    echo "<script>
                    alert('Signup successful!');
                  </script>";
                } else {
                    echo "<p>Error: " . mysqli_error($conn) . "</p>";
                }
            }
        }
    }
    ?>

    <form action="" method="POST">
        First Name: <input type="text" placeholder="First Name" name="first_name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>"required><br>
        Last Name: <input type="text" placeholder="Last Name" name="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>"required><br>
        Email: <input type="email" placeholder="Email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"required><br>
        Password: <input type="password" placeholder="Password" name="password" required><br>
        Repeat Password: <input type="password" placeholder="Repeat Password" name="repeat_password" required><br>
        <input type="submit" value="Sign up">
    </form>
    
    <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
