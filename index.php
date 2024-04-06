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

        input, button {
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            transition: transform 500ms;
            width: 70%;
        }

        input:hover, button:hover{
            transform: scale(1.03);
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>

</head>
<body>

    <h1>Log in</h1>
    <div class="form-container">
        <form action="validate.php" method="post">
            <input type="text" name="username" placeholder="Username"/>
            <input type="password" name="password" placeholder="Password"/>
            <div class="g-recaptcha" data-sitekey="6LcVYbEpAAAAAPlWzORSxpZ0RwuR1QJ9Gdui_vmw"></div>
            <br/>
            <input type="submit" value="Submit">
        </form>
    </div>
    <p>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['g-recaptcha-response'])) {
            // Get the reCAPTCHA response token
            $recaptchaResponse = $_POST['g-recaptcha-response'];

            // Verify the reCAPTCHA response
            $recaptchaSecretKey = "6LcVYbEpAAAAAPlWzORSxpZ0RwuR1QJ9Gdui_vmw";
            $remoteIp = $_SERVER['REMOTE_ADDR'];
            $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptchaData = array(
                'secret' => $recaptchaSecretKey,
                'response' => $recaptchaResponse,
                'remoteip' => $remoteIp
            );
            $recaptchaOptions = array(
                'http' => array(
                    'method' => 'POST',
                    'content' => http_build_query($recaptchaData)
                )
            );
            $recaptchaContext = stream_context_create($recaptchaOptions);
            $recaptchaResult = file_get_contents($recaptchaUrl, false, $recaptchaContext);
            $recaptchaResponseData = json_decode($recaptchaResult);

            // Check if reCAPTCHA verification was successful
            if ($recaptchaResponseData->success) {
                // Proceed with checking user existence in the database
                $username = $_POST["username"];
                $password = md5($_POST["password"]);

                // Connect to MySQL database
                $conn = mysqli_connect("localhost", "root", "COSC4343", "cybersecurity_homework4");

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM UserAccounts WHERE username = '$username' AND password = '$password'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "User exists: true";
                } else {
                    echo "User exists: false";
                }

                mysqli_close($conn);
            } else {
                // reCAPTCHA verification failed
                echo "reCAPTCHA verification failed.";
            }
        }
        ?>
    </p>
    <script>
        // Define the onSubmit function
        function onSubmit(token) {
            console.log(token)
        }
    </script>
</body>
</html>