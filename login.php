<!DOCTYPE html>
<html>
<head>
    <title>Login | DevMap</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="icon" type="img/png" href="./img/logo.png">
</head>
<body>
    <div class="container">
    <h2>Login</h2>
    <?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "project-thesis");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Fetch user data from the database
        $query = "SELECT id, password FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['logged_in'] = true;
                header("Location: ../project-thesis/home/index.php");
                exit();
            } else {
                echo "<script>
                alert('Incorrect password.');
              </script>";
            }
        } else {
            echo "<script>
            alert('User not found.');
          </script>";
        }
    }
    ?>

    <form action="" method="POST">
        Email: <input type="email" placeholder="Email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"required><br>
        Password: <input type="password" placeholder="Password" name="password" required><br>
        <input type="submit" value="Login">
        <a href="forgot-password.php">Forgot password?</a>
    </form>
    
    <p>Don't have an account? <a href="signup.php">Create one</a></p>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
