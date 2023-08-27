<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | DevMap</title>
    <link rel="icon" type="img/png" href="./img/logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4a15dd, #28A745);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }
        a.button {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
            transition: background-color 0.3s ease;
        }
        a.login-button {
            background-color: #007BFF;
        }
        a.signup-button {
            background-color: #28A745;
        }
        a.button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Developer Roadmaps</h2>
    <a href="login.php" class="button">Log in</a>
    <a href="signup.php" class="button">Sign up</a>
</body>
</html>
