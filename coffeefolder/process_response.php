<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responses</title>
    <style>
        
        *,
      *::before,
      *::after {
        box-sizing: inherit;
      }

      html {
        box-sizing: border-box;
        background-color:rgb(59,47,47);
        height: 100%;
        color:aliceblue
      }

      body {
        display: grid;
        grid-template-rows: auto auto 1fr auto;
        grid-template-columns: 100%;
        min-height: 100%;
        margin: 0;
        font-size: 16px;
        letter-spacing:0.9px;
      }
      .header{
        background-color:rgb(114,78,44);
        text-align: center;
        font-style:italic;
        margin-top:-30px;
        height:80px;
        padding-top:30px;
        font-size: 23px;
      }
      nav {
            background-color:rgb(114,78,44);
            padding-top:20px;
        }
        .nav a{
            text-decoration: none;
            color:aliceblue;
            padding: 30px 180px;
            display:inline-block; 
        }
        .nav a:hover{
            text-decoration: underline;
            color:peru;
        }
        .container2 {
            text-align: center;
            background:rgb(59,47,47);
            padding: 40px;
        }

        .container2 h4 {
            margin: 0 0 20px;
            color: aliceblue;
        }

        .container2 p {
            margin: 0 0 20px;
            color: #666;
        }

        .container2 .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: brown;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .container2 .button:hover {
            background-color: peru;
        }
        button{
            background-color:brown;
            border: none;
            color:white;
            text-align: center;
            font-size:16px;
            border-radius:20px;
            padding:10px;
            display:inline-block;
        }
        button:hover{
            background-color:peru;
        }
    </style>

</style>
</head>
<body>
<div class="container">
        <div class="header">
        <h2><i>BREW HAVEN CAFE-ADMIN</i></h2>
        </div>
      <div class="nav">
        <nav>
                <a href="coffeeadminpage.php">User Submissions <i class="fa-solid fa-house"></i> </a>
                <a href="admin_response.php">Responses to Submissions<i class="fa-solid fa-bars"></i> </a>
                <button>Log Out</button>
        </a>   
        </nav>
      </div>
    </div>
    <div class="container2">
        <h4>You are Welcome to submit more Feedbacks!</h4>
        <a href="admin_response.php" class="button">Back to previous page</a>
    </div>
</body>
</html>

<?php
// Database connection
$conn = new mysqli("localhost:3307", "root", "venessa33", "coffee");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$id=$_POST['id'];
$responseText = $_POST['response_text'];
$responseFile = $_FILES['response_file'];

// Check if a file was uploaded
if ($responseFile['name']) {
    $targetDir = "responses/";
    $fileName = basename($responseFile["name"]);
    $targetFile = $targetDir . $fileName;

    // Move file to the server
    if (move_uploaded_file($responseFile["tmp_name"], $targetFile)) {
        // Save file path in database
        $stmt = $conn->prepare("UPDATE user_submissions SET response_file = ?, response_text = NULL WHERE id = ?");
        $stmt->bind_param("si", $fileName, $id);
        $stmt->execute();
        echo "Response file uploaded successfully.";
    } else {
        echo "Failed to upload response file.";
    }
} elseif ($responseText) {
    // Save text response in database if no file is uploaded
    $stmt = $conn->prepare("UPDATE user_submissions SET response_text = ?, response_file = NULL WHERE id = ?");
    $stmt->bind_param("si", $responseText, $id);
    $stmt->execute();
    echo "Text response saved successfully.";
} else {
    echo "No response provided.";
}

$stmt->close();
$conn->close();
?>