<?php
// Database connection parameters
$servername = "db"; // service name
$username = "root";
$password = "root";
$dbname = "student";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $id = $_POST['id'] ?? '';
    $cgpa = $_POST['cgpa'] ?? '';

    // Prepare and bind the insert statement
    $stmt = $conn->prepare("INSERT INTO stdtable (std_name, std_id, std_cgpa) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $id, $cgpa);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Retrieve existing records from the database
$table_name = "stdtable";
$query = "SELECT * FROM $table_name";
$response = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Cloud Project</title>
</head>
<body>
<main>
    <div class="container">
        <div class="left_section">
            <div class="table-parent">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>ID</th>
                        <th>CGPA</th>
                    </tr>
                    <?php
                    if ($response) {
                        // Loop through the result set and populate the table
                        while ($row = mysqli_fetch_assoc($response)) {
                            echo '<tr>';
                            echo '<td>' . (@htmlspecialchars($row['std_name']) ?? '') . '</td>'; // Suppress warnings
                            echo '<td>' . (@htmlspecialchars($row['std_id']) ?? '') . '</td>';
                            echo '<td>' . (@htmlspecialchars($row['std_cgpa']) ?? '') . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo "Error executing query: " . mysqli_error($conn);
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="right_section">
            <form method="post"> <!-- Form submits data to the same page (index.php) -->
                <div class="grid_1">
                    <label for="card_name">Student Name</label>
                    <input
                        type="text"
                        placeholder="e.g. Mrawan Elsayed"
                        id="card_name"
                        name="name" <!-- Add name attribute -->
                        
                </div>
                <div class="grid_2">
                    <label for="card_number">Student ID</label>
                    <input
                        type="number"
                        oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        minlength="16"
                        maxlength="16"
                        placeholder="e.g. 1234 5678 9123 0000"
                        id="card_number"
                        name="id" <!-- Add name attribute -->
                        
                </div>
                <div class="grid_4">
                    <label for="card_cvc">CGPA</label>
                    <input 
                        type="number" 
                        oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                        maxlength="9" 
                        placeholder="e.g. 1.23" 
                        type="number" 
                        step="0.00001" 
                        id="card_cvc" 
                        name="cgpa" <!-- Add name attribute --> 
                        
                </div>
                <button id="submit_btn" type="submit">Add Student</button>
            </form>
            <div class="thank hidden">
                <img src="./images/icon-complete.svg" alt="Completed" />
                <h1>Thank you!</h1>
                <p>We've added your details</p>
                <button>Continue</button>
            </div>
        </div>
    </div>
</main>

<!-- Completed state start -->
<script src="https://unpkg.com/imask"></script>
<!-- <script src="app.js"></script> -->
</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
