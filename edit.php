<?php
    // Start a PHP session
    session_start();

    // Include the database connection file
    require('C:\xampp\htdocs\midtermwebdevelopment\db.php');

    // Check if the user is logged in
    if(isset($_SESSION['email'])) {
        // Retrieve user's email from the session
        $email = $_SESSION['email'];

        // Query to select user's data from the database
        $query = "SELECT * FROM info WHERE Email='$email'";

        // Execute the query
        $result = mysqli_query($conn, $query);

        // Fetch the user's data
        $userInfo = mysqli_fetch_assoc($result);

        // Free the result set
        mysqli_free_result($result);

        // Check if form is submitted
        if(isset($_POST['submit'])) {
            // Retrieve updated user input from the form
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $month = $_POST['month'];
            $day = $_POST['day'];
            $year = $_POST['year'];

            // SQL query to update user data in the database
            $updateQuery = "UPDATE info 
                            SET `First Name`='$firstName', `Last Name`='$lastName', Email='$email', 
                                Password='$password', Month='$month', Day='$day', Year='$year' 
                            WHERE Email='$email'";

            // Execute the update query
            if(mysqli_query($conn, $updateQuery)) {
                // Redirect to dashboard.php after successful update
                header('Location: http://localhost/midtermwebdevelopment/dashboard.php');
                exit();
            } else {
                // Handle the case where update fails
                echo 'Error updating record: ' . mysqli_error($conn);
            }
        }
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
    <title>Edit Profile</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maiden+Orange&display=swap" rel="stylesheet">
    <script src="login.js"></script>
</head>
<body>
    <div class="full-screen-container">
        <div class="login-container">
            <h1 class="login-title">Edit Profile</h1>
            <form method="POST" action="edit.php" class="form">
                <div class="input-group">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" id="firstnameinput" value="<?php echo htmlspecialchars($userInfo['First Name']); ?>">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" id="lastnameinput" value="<?php echo htmlspecialchars($userInfo['Last Name']); ?>">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="emailinput" value="<?php echo htmlspecialchars($userInfo['Email']); ?>">
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="passwordinput" value="<?php echo htmlspecialchars($userInfo['Password']); ?>">
                    <label for="birthdate" id="birthdate">Birthdate</label>
                    <label for="month">Month</label>
                    <select name="month" id="month">
                        <option value="<?php echo htmlspecialchars($userInfo['Month']); ?>" selected disabled><?php echo htmlspecialchars($userInfo['Month']); ?></option>
                        <option value="" selected="" disabled="">Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <label for="day">Day</label>
                    <input type="number" name="day" min="1" max="31" id="dayinput" value="<?php echo htmlspecialchars($userInfo['Day']); ?>">
                    <label for="year">Year</label>
                    <input type="number" name="year" min="1950" max="2024" id="yearinput" value="<?php echo htmlspecialchars($userInfo['Year']); ?>">
                </div>

                <button type="submit" name="submit" value="submit" class="login-button">Update Profile</button>
            </form>
        </div>
    </div>
</body>
</html>