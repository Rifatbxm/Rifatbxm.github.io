<?php
// Database connection details
$host = "localhost";
$dbname = "postgres";  // Replace with your database name
$user = "postgres";          // Replace with your PostgreSQL username
$password = "root";      // Replace with your PostgreSQL password

// Connect to PostgreSQL
$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash password for security
    $location = $_POST['location'];
    $social_links = $_POST['social_links'];

    // Insert data into the database
    $query = "INSERT INTO student (f_name, l_name, email, password, location, social_links)
              VALUES ($1, $2, $3, $4, $5, $6)";
    $result = pg_query_params($conn, $query, array($f_name, $l_name, $email, $password, $location, $social_links));

    if ($result) {
        echo "Sign-up successful!";
    } else {
        echo "Error: " . pg_last_error($conn);
    }
}

pg_close($conn);
?>
