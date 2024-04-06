<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Security Homework 4</title>
</head>
<body class="index-body">

    <h1>Log in</h1>
    <div class="form-container">
        <form method="post">
            <input type="text" name="username" placeholder="Username"/>
            <input type="password" name="password" placeholder="Password"/>
            <div class="g-recaptcha" data-sitekey="6LcVYbEpAAAAAPlWzORSxpZ0RwuR1QJ9Gdui_vmw" data-callback="displaySubmitButton"></div>
            <br/>
            <button value="Log In" id="login-button" class="disabled-button" disabled>Log In</button>
        </form>
    </div>
    <p>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
                // Get the username and password from the form submission
                $username = $_POST["username"];
                $password = md5($_POST["password"]); // Hash the password using md5

                // Connect to MySQL database
                $conn = mysqli_connect("localhost", "root", "COSC4343", "cybersecurity_homework4");

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Query to check if the user exists in the database
                $sql = "SELECT * FROM UserAccounts WHERE username = '$username' AND password = '$password'";
                $result = mysqli_query($conn, $sql);

                // Check if any rows were returned
                if (mysqli_num_rows($result) > 0) {
                    // User exists
                    $row = mysqli_fetch_assoc($result);
                    $clearance = $row['clearance'];

                    // Route user based on clearance level
                    switch ($clearance) {
                        case 'C':
                            header("Location: routes/confidential.html");
                            break;
                        case 'S':
                            header("Location: routes/secret.html");
                            break;
                        case 'T':
                            header("Location: routes/top-secret.html");
                            break;
                        case 'U':
                            header("Location: routes/unclassified.html");
                            break;
                        default:
                            // Redirect to a default page if clearance level is not recognized
                            header("Location: routes/default.html");
                    }
                } else {
                    // User doesn't exist
                    header("Location: routes/nonexistent.html");
                }

                // Close database connection
                mysqli_close($conn);
            }
        ?>
    </p>
    <script>
        // Allow user to submit form
        function displaySubmitButton(token) {
            console.log('reCAPTCHA completed!')
            document.getElementById("login-button").disabled = false;
            document.getElementById("login-button").classList.remove("disabled-button")
            document.getElementById("login-button").classList.add("enabled-button")
        }
    </script>
</body>
</html>