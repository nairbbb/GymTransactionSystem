<?php
// Start a PHP session
session_start();

// Include the database connection
require('C:\xampp\htdocs\midtermwebdevelopment\db.php');

// Check if the user is logged in
if(isset($_SESSION['email'])) {
    // Retrieve user's email from the session
    $email = $_SESSION['email'];

    // Query to select user's data from the database excluding the password
    $query = "SELECT id, `First Name`, `Last Name`, Email, Month, Day, Year FROM info WHERE Email='$email'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Fetch the user's data
    $userInfo = mysqli_fetch_assoc($result);

    // Free the result set
    mysqli_free_result($result);

    // Check if the delete form is submitted
    if(isset($_POST['delete'])) {
        // SQL query to delete user's account from the database
        $deleteQuery = "DELETE FROM info WHERE Email='$email'";

        // Execute the delete query
        if(mysqli_query($conn, $deleteQuery)) {
            // If deletion is successful, destroy the session and redirect to index.php
            session_destroy();
            header('Location: http://localhost/midtermwebdevelopment/index.php');
            exit();
        } else {
            // If there's an error, output the error message
            echo 'ERROR: ' . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If the user is not logged in, redirect back to the login page
    header('Location: http://localhost/midtermwebdevelopment/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maiden+Orange&display=swap" rel="stylesheet">
    <script src="login.js"></script>
</head>
<body>
    <div class="full-screen-container">
        <div class="login-container">
            <h1 class="login-title">Are you sure you want to delete your account?</h1>
            <div class="profile-info">
                <div class="profile-item">
                    <p>ID: <?php echo htmlspecialchars($userInfo['id']); ?></p>
                    <p>First Name: <?php echo htmlspecialchars($userInfo['First Name']); ?></p>
                    <p>Last Name: <?php echo htmlspecialchars($userInfo['Last Name']); ?></p>
                    <p>Email: <?php echo htmlspecialchars($userInfo['Email']); ?></p>
                    <p>Month: <?php echo htmlspecialchars($userInfo['Month']); ?></p>
                    <p>Day: <?php echo htmlspecialchars($userInfo['Day']); ?></p>
                    <p>Year: <?php echo htmlspecialchars($userInfo['Year']); ?></p>
                </div>

                <form method="POST" action="delete.php" class="form">
                    <button type="submit" name="delete" value="delete" class="login-button">Yes, delete my account</button>
                </form>
                <form method="POST" action="login.php" class="form">
                    <button type="submit" name="delete" value="delete" class="login-button">No</button>
                </form>
            </div>
        </div> 
    </div>
</body>
</html>
