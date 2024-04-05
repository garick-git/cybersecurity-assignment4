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
        <form id="login-form" method="post" action="">
            <input type="text" name="username" placeholder="Username"/>
            <input type="password" name="password" placeholder="Password"/>
            <!-- Add the reCAPTCHA v2 widget -->
            <div class="g-recaptcha" data-sitekey="6LeiJa4pAAAAAItNgcSC8GohwVbhQxA9Pc33Rmb2"></div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        // Add a check function to enable/disable the submit button based on CAPTCHA response
        function enableSubmit() {
            document.querySelector('button[type="submit"]').disabled = false;
        }

        function disableSubmit() {
            document.querySelector('button[type="submit"]').disabled = true;
        }

        // Disable submit button by default
        disableSubmit();

        // Add an event listener to check CAPTCHA response
        document.getElementById("login-form").addEventListener("submit", function(event) {
            var response = grecaptcha.getResponse();
            if(response.length == 0) {
                // CAPTCHA not solved, prevent form submission
                event.preventDefault();
                alert("Please solve the CAPTCHA.");
            }
        });
    </script>

</body>
</html>
