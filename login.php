<?php
    // Start a PHP session
    session_start();

    // Include the database connection
    require('C:\xampp\htdocs\midtermwebdevelopment\db.php');

    // Check if form is submitted
    if(isset($_POST['submit'])) {
        // Retrieve user input from the login form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query to select user from the database with the provided email and password
        $query = "SELECT * FROM info WHERE Email='$email' AND Password='$password'";

        // Execute the query
        $result = mysqli_query($conn, $query);

        // Check if a row with matching email and password is found
        if(mysqli_num_rows($result) == 1) {
            // User authenticated successfully, store user data in session variables
            $_SESSION['email'] = $email;

            // Redirect the user to the dashboard or any other authorized page
            header('Location: http://localhost/midtermwebdevelopment/dashboard.php');
            exit();
        } else {
            // Invalid login credentials, redirect back to the login page with an error message
            $_SESSION['login_error'] = "Invalid email or password";
            header('Location: http://localhost/midtermwebdevelopment/login.php');
            exit();
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maiden+Orange&display=swap" rel="stylesheet">
</head>
<body>
    <div class="full-screen-container">
        <div class="login-container">
            <h1 class="login-title">Welcome to Brian's Gym</h1>
            <form method="POST" action="login.php" class="form">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="emailinput">
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="passwordinput">
                </div>

                <button type="submit" name="submit" class="login-button">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
