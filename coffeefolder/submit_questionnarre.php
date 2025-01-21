<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission</title>
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
        margin:0;
        font-size: 16px;
        letter-spacing:0.9px;
      }
      nav {
            background-color:rgb(114,78,44);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav a{
            text-decoration: none;
            color:aliceblue;
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
    </style>
</head>
<body>
<div class="container">
        <div class="nav">
          <nav>
                  <h4><i>BREW HAVEN CAFE</i></h4>
                  <a href="coffeesite.html">Home  <i class="fa-solid fa-house"></i></a>
                  <a href="menu.html">Menu <i class="fa-solid fa-bars"></i> </a>
                  <a href="aboutus.html">About Us <i class="fa-solid fa-info"></i> </a>
                  <a href="contact.html">Contact <i class="fa-regular fa-address-card"></i> </a> 
          </nav>
        </div>
      </div>
      <div class="container2">
        <h4>You are Welcome to submit more Feedbacks!</h4>
        <a href="contact.html" class="button">Back to previous page</a>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$host = "localhost:3307";
$username = "root";
$password = "venessa33";
$dbname = "coffee";


try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Define the target directory for uploaded files
    $targetDir = "uploads/";

    // Create the uploads directory if it doesn't exist
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Initialize variables for form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];
    $fileName = basename($_FILES['fileUpload']['name']);
    $targetFilePath = $targetDir . $fileName;

    // Check if the file was uploaded without errors
    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == 0) {
        // Validate file type
        $allowedTypes = array('pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png');
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        if (in_array($fileType, $allowedTypes)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $targetFilePath)) {
                // File upload success, now insert data into the database
                $stmt = $pdo->prepare("INSERT INTO user_submissions (name, email, feedback, file_path) VALUES (:name, :email, :feedback, :file_path)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':feedback', $feedback);
                $stmt->bindParam(':file_path', $targetFilePath);

                if ($stmt->execute()) {
                    // Data inserted successfully
                    echo "Thank you, $name! Your feedback has been submitted successfully.";
                } else {
                    echo "Error saving your feedback. Please try again.";
                }
            } else {
                echo "Error uploading your file.";
            }
        } else {
            echo "Error: Only .pdf, .doc, .docx, .jpg, .jpeg, and .png files are allowed.";
        }
    } else {
        echo "Error: " . $_FILES['fileUpload']['error'];
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
}
