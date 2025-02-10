function LoginFunction() {
    window.location.href = 'login.php';        
}

function DashboardFunction() {
    window.location.href = 'dashboard.php';        
}
function handleInvalidCredentials() {
    // Retrieve email and password values
    var email = document.getElementById('emailinput').value;
    var password = document.getElementById('passwordinput').value;

    // Check if email or password is empty
    if (email === "" || password === "") {
        alert("Please enter both email and password.");
        return false; // Prevent form submission
    }

    // Display alert for invalid credentials
    alert("Invalid email or password.");
    return false; // Prevent form submission
}


