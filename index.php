<!DOCTYPE html>
<html lang="en">
<head>

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
        <form>
            <input placeholder="Username"/>
            <input type="password" placeholder="Password"/>
            <button type="submit">Submit</button>
        </form>
    </div>
    <p>
        <?php
            // Connect to MySQL database
            $conn = mysqli_connect("localhost", "root", "COSC4343", "cybersecurity_homework4");

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Query to fetch the first row from UserAccounts table
            $sql = "SELECT * FROM UserAccounts LIMIT 1";
            $result = mysqli_query($conn, $sql);

            // Check if any rows were returned
            if (mysqli_num_rows($result) > 0) {
                // Output data of the first row
                $row = mysqli_fetch_assoc($result);
                echo "Username: " . $row["username"]. "<br>";
                echo "Password: " . $row["password"]. "<br>";
                echo "Clearance: " . $row["clearance"]. "<br>";
            } else {
                echo "0 results";
            }

            // Close database connection
            mysqli_close($conn);
        ?>
    </p>
</body>
</html>