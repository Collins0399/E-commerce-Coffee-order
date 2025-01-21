<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
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
        h2,h1{
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-style: italic;
        }
        footer{
            text-align: center;
            font-size:14px;
            background-color:rgb(114,78,44);
        }
        .email-link {
    color:burlywood; 
             }
      @media screen and (min-width: 750px) {
        body {
          font-size:18px;
        }
      }
      .menu-table {
            width:100%;
            margin: 20px 0;
            font-size: 18px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .menu-table th {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        .menu-table  tr {
            background-color: #fff;
            color: rgb(59, 47, 47);
        }

        .menu-table  tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .menu-table tr:hover {
            background-color: #f5bca9;
            color: #000;
            transition: background-color 0.3s ease;
        }

        </style>
          <script src="https://kit.fontawesome.com/99c1c50972.js" crossorigin="anonymous"></script>
          <script>
            function validateForm() {
                const name = document.getElementById("name").value;
                const email = document.getElementById("email").value;
                const feedback = document.getElementById("feedback").value;
                const fileInput = document.getElementById("fileUpload").value;
    
                if (!name || !email || !feedback || !fileInput) {
                    alert("Please fill out all fields and upload a file.");
                    return false;
                }
                alert("Thank you for your feedback and file submission!");
                return true;
            }
        </script>
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
      <h1>Admin Response to My Submission</h1>

<table align="center" border="1" class="menu-table">
    <tr>
        <th>Submission Date</th>
        <th>My Submission</th>
        <th>Admin Response</th>
    </tr>
    <?php
    session_start();
    $userEmail = $_SESSION['email'];

    // Database connection
    $conn = new mysqli("localhost:3307", "root", "venessa33", "coffee");


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch user submissions and responses
    $stmt = $conn->prepare("SELECT submission_date, file_path, response_text, response_file FROM user_submissions WHERE email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['submission_date']}</td>
                    <td><a href='{$row['file_path']}' target='_blank'>View Submission</a></td>";
            
            // Display admin response if available
            if ($row['response_file']) {
                echo "<td><a href='responses/{$row['response_file']}' target='_blank'>View File Response</a></td>";
            } elseif ($row['response_text']) {
                echo "<td>{$row['response_text']}</td>";
            } else {
                echo "<td>No Response Yet</td>";
            }
            
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No submissions found.</td></tr>";
    }

    $stmt->close();
    $conn->close();
    ?>
</table>

</body>
</html>