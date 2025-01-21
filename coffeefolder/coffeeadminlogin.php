<?php
session_start();

// Database configuration
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "coffee";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Variable to store any message to be displayed
$message = "Sucessfully Logged In";
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Validate input
    if (empty($username) || empty($password)) {
        die("All fields are required.");
    }

    $stmt = $conn->prepare("INSERT INTO coffeeadminlogin(username,password) VALUES (?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("ss", $username, $password,);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: coffeeadminpage.php");
        exit();
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }
    // Close the statement
    $stmt->close();
// Close the connection
  $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<style>
      
      *,
      *::before,
      *::after {
        box-sizing: inherit;
      }

      html {
        box-sizing: border-box;
        background-color:bisque;
        height: 100%;
        color:aliceblue
      }
      body{
    align-items: center;
    justify-content: center;
    font-family: sans-serif;
    background-color:bisque;
    flex-direction: column;
    margin: 0;
        }
        .header{
            text-align: center;
            font-style:italic;
            background-color:rgb(114,78,44);
            margin-top:-35px;
            height:80px;
            padding-top:30px;
            font-size:20px;
            color: black;
        }
        .nav{
            background-color:rgb(114,78,44);
            margin-bottom:20px;
        }
        .nav a{
            color: black;
            display:inline-block;
            text-align:center;
            padding: 25px;
           padding-left: 310px;
           margin-top:20px ;
        }
        .nav a:hover{
            text-decoration: underline;
            color:blue;
        }
       
        form{
            width: 800px;
            display: block;
            margin: auto;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 5px 10px;
            transition: transform 0.2s;
        }
        label {
            display: block;
            width: 100%;
            margin-top:3px;
            margin-bottom:3px;
            text-align: left;
            color: black;
            font-weight: bold;
        }
        input {
       display: block;
    width: 100%;
    height:50px;
    margin-bottom:5px;
    padding: 10px;
    box-sizing: border-box;
    border: 2px solid #ddd;
    border-radius: 5px;
}
button{
    padding: 15px;
    border-radius: 10px;
    margin-top: 15px;
    margin-bottom: 15px;
    border: none;
    color: white;
    cursor: pointer;
    background-color:brown;
    width: 100%;
    font-size: 16px;
}
h2{
   font-style: italic;
}
     
</style>
</head>
<body>

<div class="header">
        <h2>BREW HAVEN CAFE-ADMIN</h2>
</div>
 <div class="nav">
        <a href="coffeeuserlogin.php">USER LOGIN
        </a>
        <a href="coffeeusersignup.php">USER SIGNUP
        </a> 
    </div>
<h4 class="adminlgn" style="text-align:center; color:black;">ADMIN LOGIN </h4>
<form role="form" method="post" action="coffeeadminlogin.php">
<label>Enter Username:</label>
<input class="form-control" type="text" name="username" autocomplete="off" required />
<label>Password:</label>
<input class="form-control" type="password" name="password" autocomplete="off" required />
 <button type="submit" name="login" class="btn btn-info">LOGIN </button>
</form>

</body>
</html>