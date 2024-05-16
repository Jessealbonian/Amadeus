<?php
// Define database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PACCTEST";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get input data
    $student_number = $_POST['student_number'];

    // Insert data into database
    $sql = "INSERT INTO attendancetable (time_in, student_number) VALUES (NOW(), '$student_number')";

    if ($conn->query($sql) === TRUE) {
        // Use JavaScript to show the modal
        echo "<script>document.getElementById('successPopup').style.display = 'block';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

// Fetch last 4 entries from the database
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch data from database and display it in table
$sql = "SELECT time_in, student_number FROM attendancetable ORDER BY time_in DESC LIMIT 4";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login 04</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="popup" id="successPopup" style="display:none;">
        New record created successfully
    </div>

<div class= "area">
    <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
        </ul>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="img" style="background-image: url(images/LOGO-PACC.png);"></div>
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="container">
                                <div class="welcome-text">
                                    <img src="images/Logo1.png" style="width:100px" alt="Application Logo">
                                    <h3 class="mb-4">Welcome to PACC</h3>
                                </div>
                                <div class="w-100"></div>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form">
                                    <div class="form-group mb-3">
                                        <input type="text" name="student_number" class="form-control" placeholder="Student Number:" required>
                                    </div>
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Submit</button>
                                </form>
                                <table class="attendance-table">
                                    <tr>
                                        <th>Time</th>
                                        <th>Student Number</th>
                                        <th>Remarks</th> <!-- Leave this column empty for now -->
                                    </tr>
                                    <?php
                                    // Database connection
                                    $conn = new mysqli($servername, $username, $password, $dbname);
                                    // Check connection
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }
                                    // Fetch data from database and display it in table
                                    $sql = "SELECT time_in, student_number FROM attendancetable";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["time_in"] . "</td>";
                                            echo "<td>" . $row["student_number"] . "</td>";
                                            echo "<td></td>"; // Leave remarks column empty for now
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>No attendance records found</td></tr>";
                                    }
                                    $conn->close();
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>    

<!-- Modal -->
<script>
        
        // JavaScript to show popup
        window.onload = function() {
        console.log("Window loaded");
        var successPopup = document.getElementById('successPopup');
        <?php if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
            echo "successPopup.style.display = 'block';";
            echo "setTimeout(function() {
                successPopup.style.opacity = '0';
                setTimeout(function() {
                    successPopup.style.display = 'none';
                }, 1000); // 1 second for fading out animation
            }, 2000); // 2 seconds delay";
        }?>
    };
    </script>



</body>
</html>
