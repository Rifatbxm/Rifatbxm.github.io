<?php
// Database connection details
$host = 'localhost';  // Database host
$dbname = 'postgres';  // Database name
$user = 'postgres';  // Database username
$password = 'root';  // Database password

// Connect to PostgreSQL
try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully.";
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['course_title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $instructor_id = $_POST['instructor_id'];
    $language = $_POST['language'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];

    // Insert data into the Course table
    $sql = "INSERT INTO Course (Title, Category, Description, instructor_id, Lang, Price, Rating)
            VALUES (:title, :category, :description, :instructor_id, :language, :price, :rating)";
    
    $stmt = $pdo->prepare($sql);

    // Bind values to the SQL statement
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':instructor_id', $instructor_id);
    $stmt->bindParam(':language', $language);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':rating', $rating);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Course added successfully!";
    } else {
        echo "Error adding course.";
    }
}
?>
