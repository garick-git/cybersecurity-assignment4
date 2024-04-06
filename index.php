<!DOCTYPE html>
<html lang="en">
<head>
    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Security Homework 4</title>

    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .form-container{
            width: 25%;
        }
        
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            width: full;
        }

        input {
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            transition: transform 500ms;
            width: 70%;
        }

        .enabled-button{
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            transition: transform 500ms;
            width: 70%;
            cursor: pointer;
        }

        .enabled-button:hover{
            transform: scale(1.03);
            background-color: lightskyblue;
            color: black;
        }

        .disabled-button{
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            width: 70%;
            background-color: lightgray;
            color: black;
        }

        input:hover{
            transform: scale(1.03);
        }
    </style>

</head>
<body>

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
                    echo "true";
                } else {
                    // User doesn't exist
                    echo "false";
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