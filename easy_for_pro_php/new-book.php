<?php
// Include database connection
require_once 'database.php';

// Initialize error messages and success flag
$errors = [];
$success = false;

// Retrieve form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = htmlspecialchars(trim($_POST['title']));
  $author = htmlspecialchars(trim($_POST['author']));
  $publication_date = htmlspecialchars(trim($_POST['publication_date']));
  $isbn = htmlspecialchars(trim($_POST['isbn']));
  $formats = $_POST['formats'] ?? [];

  // Validate required fields
  if (empty($title)) {
    $errors['title'] = 'Title is mandatory.';
  }
  if (empty($author)) {
    $errors['author'] = 'Author is mandatory.';
  }
  if (empty($publication_date)) {
    $errors['publication_date'] = 'Publication date is mandatory.';
  }
  if (empty($isbn)) {
    $errors['isbn'] = 'ISBN is mandatory.';
  }

  // Check if ISBN is unique
  if (empty($errors)) {
    $query = "SELECT COUNT(*) FROM books WHERE isbn = '$isbn'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_fetch_array($result)[0];

    if ($count > 0) {
      $errors['isbn'] = 'ISBN already exists. Please enter a unique ISBN.';
    }
  }

  // If there are no errors, insert the data into the "books" table
  if (empty($errors)) {
    $query = "INSERT INTO books (title, author, publication_date, isbn) VALUES ('$title', '$author', '$publication_date', '$isbn')";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $book_id = mysqli_insert_id($conn);

      // Insert selected formats into the "book_formats" table
      if (!empty($formats)) {
        foreach ($formats as $format) {
          $query = "INSERT INTO book_formats (book_id, format) VALUES ('$book_id', '$format')";
          mysqli_query($conn, $query);
        }
      }
      $success = true;
    } else {
      $errors['database'] = 'Problem inserting data into the database.';
    }
  }
}

// Display success message or errors 
if ($success) {
  echo '<p class="success">Book added successfully!</p>';
} else {
  // Display error messages in red
  if (!empty($errors)) {
    echo '<ul class="error">';
    foreach ($errors as $key => $msg) {
      echo '<li>' . htmlspecialchars($msg) . '</li>';
    }
    echo '</ul>';
  }
}

// Close the database connection
mysqli_close($conn);
