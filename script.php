<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // File validation (optional):
    // Check for supported file types, size limits, etc.

    // Move uploaded file to a designated directory:
    $target_dir = "uploads/"; // Adjust this path as needed
    $target_file = $target_dir . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
      // File uploaded successfully, connect to PostgreSQL:
      $conn = pg_connect("host=localhost dbname=uploadFile user=postgres password=9629"); // Replace with your connection details
      if ($conn) {
        // Prepare SQL statement:
        $sql = "INSERT INTO files (filename, path) VALUES ($1, $2)";
        $result = pg_query_params($conn, $sql, array(basename($file["name"]), $target_file));

        if ($result) {
          echo "File uploaded and information stored in database.";
        } else {
          echo "Error inserting file information into database.";
        }
      } else {
        echo "Failed to connect to PostgreSQL database.";
      }
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  } else {
    echo "No file uploaded.";
  }
} else {
  echo "Invalid request method.";
}
pg_close($conn); // Close connection if opened
