<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Admin Page</title>
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

        h2,h1 { 
            text-align: center;

         }
        table { width: 100%;
              margin-bottom: 20px;
              box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
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

        form { 
            margin-bottom: 20px; 
        }
        .section { 
            margin: 20px; 
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
</head>
<body>
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

<h1>Admin Response Submission</h1>

<div class="section">
    <h2>Submit Responses to User Submissions</h2>
    <table align="center" border="1" class="menu-table">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Submission Date</th>
            <th>View Submission</th>
            <th>Submit Response</th>
        </tr>
        <?php
        // Connect to database
        $conn = new mysqli("localhost:3307", "root", "venessa33", "coffee");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch submissions
        $result = $conn->query("SELECT * FROM user_submissions ORDER BY submission_date DESC");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['submission_date']}</td>
                        <td><a href='{$row['file_path']} target='_blank'>View Submission</a></td>
                        <td>
                            <form action='process_response.php' method='post' enctype='multipart/form-data'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <textarea name='response_text' rows='3' cols='30' placeholder='Enter response...'></textarea><br>
                                <label>Or Upload Response:</label>
                                <input type='file' name='response_file'><br>
                                <button type='submit' class='btn'>Submit Response</button>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No submissions found.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</div>

</body>
</html>
