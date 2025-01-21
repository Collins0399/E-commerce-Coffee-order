<?php
session_start();

// Database configuration
$servername = "localhost:8080";
$username = "root";
$password = "venessa33";
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
    $mobilenumber=$_POST['mobilenumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    // Validate input
    if (empty($fullname) || empty($mobilenumber) || empty($email) || empty($password) || empty($confirmpassword)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    if ($password !== $confirmpassword) {
        die("Passwords do not match.");
    }

   
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO coffeeusersignup (fullname, mobilenumber, email, password, confirmpassword) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("sssss", $fullname, $mobilenumber, $email, $password,$password);
    // Execute the statement
    if ($stmt->execute()) {
        header("Location: coffeesite.html");
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
     body{
    align-items: center;
    justify-content: center;
    font-family: sans-serif;
    background-color:bisque;
    flex-direction: column;
    margin: 0;
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
            margin: top -45px;
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
            color: black;
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
<h1> <i>BREW HAVEN CAFE</i> </h1>
 </div>

 <div class="nav">
        <a href="coffeeadminlogin.php">ADMIN LOGIN
        </a>
        <a href="coffeeuserlogin.php">USER LOGIN
        </a> 
    </div>
<h4 class="usersignup" style="text-align:center">USER SIGNUP FORM</h4>
<?php if ($message): ?>
        <p style="color:Blue; text-align:center;"><?php echo $message; ?></p>
    <?php endif; ?>
<form action="coffeeusersignup.php" name="usersignup" method="post" >
<label>Enter Full Name</label>
<input class="form-control" type="text" name="fullname" autocomplete="off" required />
<label>Mobile Number :</label>
<input class="form-control" type="text" name="mobilenumber" maxlength="10" autocomplete="off" required />
<label>Enter Email</label>
<input class="form-control" type="email" name="email" id="emailid" onBlur="checkAvailability()"  autocomplete="off" required  />
   <span id="user-availability-status" style="font-size:12px;"></span> 
<label>Enter Password</label>
<input class="form-control" type="password" name="password" autocomplete="off" required  />
<label>Confirm Password </label>
<input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />                
<button type="submit" name="signup" class="btn btn-danger" id="submit">Register Now </button>
</form>
</body>
</html>