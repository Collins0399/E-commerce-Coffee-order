<?php
session_start();
// Database configuration
$servername = "localhost:8080";
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
$message = "";
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Validate input

    if (empty($email) || empty($password)) {
        $message = "All fields are required.";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("SELECT password FROM coffeeusersignup WHERE email = ?");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $_SESSION['email'] = $email; // Store email in session
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($stored_password);
            $stmt->fetch();
            
            // Verify password
            if ($password === $stored_password) {
                // Insert login details into userlogin table
                $login_stmt = $conn->prepare("INSERT INTO coffeeuserlogin (fullname , email, password) VALUES (? , ?, ?)");
                if ($login_stmt === false) {
                    die("Prepare failed: " . htmlspecialchars($conn->error));
                }
                $login_stmt->bind_param("sss",$fullname, $email, $password);
                if ($login_stmt->execute()) {
                    header("Location: coffeesite.html");
                    exit();
                } else {
                    $message = "Error: " . htmlspecialchars($login_stmt->error);
                }
                $login_stmt->close();
            } else {
                $message = "Incorrect password.";
            }
        } else {
            $message = "No account found with that email.";
        }
        
        // Close the statement
        $stmt->close();
    }
    
    // Close the connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<style>
     body{
    align-items: center;
    justify-content: center;
    font-family: sans-serif;
    background-color:bisque;
    flex-direction: column;
    margin: 0;
    font-style: italic;
        }
        .header{
            text-transform: uppercase;
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
            color:black;
            font-style:italic;
            background-color:rgb(114,78,44);
            margin-top:-45px;
            height:80px;
            padding-top:30px
        }
        .nav{
            background-color:rgb(114,78,44);
            margin-top: auto;
        }
        .nav a{
            color:black;
            display:inline-block;
            text-align:center;
            padding: 25px;
           padding-left: 310px;
        }
        .nav a:hover{
            text-decoration: underline;
            color:blue;
        }
        hr{
    margin:0px;
}
        form{
            width: 600px;
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
            color:black;
            font-weight: bold;
        }
        input {
       display: block;
    width: 100%;
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
</style>
</head>
<body>
<div class="header">
<h1><i>BREW HAVEN CAFE</h1>
 </div>

 <div class="nav">
        <a href="coffeeadminlogin.php">ADMIN LOGIN
        </a>
        <a href="coffeeusersignup.php">USER SIGNUP
        </a> 
    </div>
<h4 class="adminlgn" style="text-align:center">USER LOGIN FORM</h4>
<?php if ($message): ?>
    <p style="color:red; text-align:center;"><?php echo $message; ?></p>
<?php endif; ?>
<form role="form" method="post" action="coffeeuserlogin.php">
<label>Enter Full Name </label>
<input class="form-control" type="text" name="fullname" required autocomplete="off" />
<label>Enter Email </label>
<input class="form-control" type="text" name="email" required autocomplete="off" />
<label>Password</label>
<input class="form-control" type="password" name="password" required autocomplete="off"  />
<p class="help-block"><a href="" style="text-decoration:none">Forgot Password</a></p>
 <button type="submit" name="login" class="btn btn-info">LOGIN </button> | 
 <a href="coffeeusersignup.php" style="text-decoration:none">Not Registered Yet</a>
</form>
</body>
</html>