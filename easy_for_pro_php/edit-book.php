<?php
// Check for book_id in the URL
if (!isset($_GET['book_id'])) {
   die('Book ID not specified.');
}
$book_id = intval($_GET['book_id']);

// Database connection
require_once 'database.php';

// Fetch book details
$query = "SELECT * FROM books WHERE book_id = $book_id";
$result = mysqli_query($conn, $query);
$book = mysqli_fetch_assoc($result);


// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   $title = mysqli_real_escape_string($conn, $_POST['title']);
   $author = mysqli_real_escape_string($conn, $_POST['author']);
   $publication_date = mysqli_real_escape_string($conn, $_POST['publication_date']);
   $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
   $rating = mysqli_real_escape_string($conn, $_POST['rating']);

   // Update book in the database
   $update_query = "UPDATE books SET title='$title', author='$author', publication_date='$publication_date', isbn='$isbn' WHERE book_id=$book_id";
   $update_result = mysqli_query($conn, $update_query);

   // Add new review if provided
   if (!empty($_POST['review'])) {
      $review = mysqli_real_escape_string($conn, $_POST['review']);
      $reviewer_name = 'Anonymous'; // Use "Anonymous" if there is no name

      $add_review_query = "INSERT INTO book_reviews (book_id, reviewer_name, review,rating) VALUES ($book_id, '$reviewer_name', '$review','$rating')";
      mysqli_query($conn, $add_review_query);
   }

   // Redirect back to the book details page
   header('Location: books-details.php?book_id=' . urlencode($book['book_id']));
   exit();
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Modify Book</title>
   <link rel="stylesheet" href="styles/nav.css">
   <link rel="stylesheet" href="styles/edit.css">
</head>

<body>
   <nav id="main-navbar"></nav>
   <h1>Modify Book</h1>
   <!-- Form to modify book details and add new reviews -->
   <form method="POST">
      <div>
         <label for="title">Title:</label>
         <input type="text" id="title" name="title" value="<?= htmlspecialchars($book['title']); ?>" required>
      </div>
      <div>
         <label for="author">Author:</label>
         <input type="text" id="author" name="author" value="<?= htmlspecialchars($book['author']); ?>" required>
      </div>
      <div>
         <label for="publication_date">Publication Date:</label>
         <input type="date" id="publication_date" name="publication_date" value="<?= htmlspecialchars($book['publication_date']); ?>" required>
      </div>
      <div>
         <label for="isbn">ISBN:</label>
         <input type="text" id="isbn" name="isbn" value="<?= htmlspecialchars($book['isbn']); ?>" required>
      </div>

      <!-- Section to add a new review -->
      <h2>Add New Review and Rating</h2>
      <label>Rating:</label>
      <div class="rating-container">
         <!-- Rating -->

         <div>
            <input type="radio" id="rating1" name="rating" value="1">
            <label for="rating1">1</label>
         </div>
         <div>
            <input type="radio" id="rating2" name="rating" value="2">
            <label for="rating2">2</label>
         </div>
         <div>
            <input type="radio" id="rating3" name="rating" value="3">
            <label for="rating3">3</label>
         </div>
         <div>
            <input type="radio" id="rating4" name="rating" value="4">
            <label for="rating4">4</label>
         </div>
         <div>
            <input type="radio" id="rating5" name="rating" value="5">
            <label for="rating5">5</label>
         </div>
      </div>
      <div>
         <label for="review">Review:</label>
         <textarea id="review" name="review"></textarea>
      </div>

      <!-- Submit button to modify book and add review -->
      <button type="submit">Save Changes</button>
   </form>
   <script>
      //Include navbar 
      fetch('nav.php', {
            method: 'get',
         }).then(res => res.text())
         .then(function(result) {
            document.getElementById('main-navbar').innerHTML = result;
         });
   </script>
</body>

</html>