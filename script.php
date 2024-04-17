<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
      $conn = pg_connect("host=localhost dbname=uploadFile user=postgres password=9629");
      if ($conn) {

        $sql = "INSERT INTO files (filename, path) VALUES ($1, $2)";
        $result = pg_query_params($conn, $sql, array(basename($file["name"]), $target_file));

        if ($result) {
          echo "File uploaded and information stored in database.";
        } else {
          echo "Error inserting file information into database.";
        }
      }
    }
  } else {
    echo "No file uploaded.";
  }
} else {
  echo "Invalid request method.";
}
pg_close($conn); // Close connection if opened
