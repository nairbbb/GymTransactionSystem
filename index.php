<?php
    // Include the database connection file
    require('C:\xampp\htdocs\midtermwebdevelopment\db.php');

    // Check if the form is submitted
    if(isset($_POST['submit'])){
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $month = $_POST['month'];
        $day = $_POST['day'];
        $year = $_POST['year'];

        // SQL query to insert data into the "info" table
        $query = "INSERT INTO info (`First Name`, `Last Name`, `Email`, `Password`, `Month`, `Day`, `Year`) 
                  VALUES ('$firstName', '$lastName', '$email', '$password', '$month', '$day', '$year')";

        // Execute the SQL query
        if(mysqli_query($conn, $query)){
            // If insertion is successful, redirect to login.php
            header('Location: http://localhost/midtermwebdevelopment/login.php');
            exit(); // Ensure no further code execution after redirection
        } else {
            // If there's an error, output the error message
            echo 'ERROR: ' . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maiden+Orange&display=swap" rel="stylesheet">
    <script src="login.js"></script>
</head>
<body> 
    <div class= "full-screen-container">
        <div class= "login-container">
            <h1 class="login-title">Welcome to Brian's Gym</h1>
            <form method="POST" action="index.php" class="form">
                <div class="input-group"> 
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" id="firstnameinput">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" id="lastnameinput">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="emailinput">
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="passwordinput">
                    <label for="birthdate" id="birthdate">Birthdate</label>
                    <label for="month">Month</label>
                    <select name="month" id="month">
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
                    <input type="number" name="day" min="1" max="31" id="dayinput">
                    <label for="year">Year</label>
                    <input type="number" name="year" min="1950" max="2024" id="yearinput">
                </div>

                <button type="submit" name="submit" value="submit" class="login-button">Create my Account</button>

               
            </form>
        </div> 

    </div>
</body>
</html>
