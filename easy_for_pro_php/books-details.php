<?php
// Check for book_id in the URL
if (!isset($_GET['book_id'])) {
  die('You should not access this page');
} else if (!is_numeric($_GET['book_id'])) {
  die('Trying to access something forbidden');
}

// Database connection
require_once 'database.php';

// Fetch book details using sql query
$book_id = intval($_GET['book_id']);
$query_book = "SELECT title, author, publication_date, isbn, COALESCE(AVG(r.rating), 0) AS avg_rating
FROM books b
LEFT JOIN book_reviews r ON b.book_id = r.book_id
WHERE b.book_id = $book_id";

$result_book = mysqli_query($conn, $query_book);
$book = mysqli_fetch_assoc($result_book);

// Fetch reviews for the book
$query_reviews = "SELECT review,rating FROM book_reviews WHERE book_id = $book_id";
$result_reviews = mysqli_query($conn, $query_reviews);
$reviews = mysqli_fetch_all($result_reviews, MYSQLI_ASSOC);

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Book Details</title>
  <link rel="stylesheet" href="styles/nav.css">
  <link rel="stylesheet" href="styles/details.css">
</head>

<body>
  <nav id="main-navbar"></nav>
  <h1 class="detail-heading">Book Details </h1>
  <div class="container">
    <!-- Main content -->
    <div class="book-details-section">
      <h1 class="book-title"><?= htmlspecialchars($book['title']); ?></h1>

      <div class="book-card">
        <p><strong>Author:</strong> <?= htmlspecialchars($book['author']); ?></p>
        <p><strong>Publication Date:</strong> <?= htmlspecialchars($book['publication_date']); ?></p>
        <p><strong>ISBN:</strong> <?= htmlspecialchars($book['isbn']); ?></p>
        <p><strong>Average Rating:</strong> <?= htmlspecialchars($book['avg_rating']); ?></p>
      </div>
      <!-- showing the review of users by using foreach  -->
      <div class="reviews-section">
        <h2>Reviews and Ratings:</h2>
        <?php if ($reviews) : ?>
          <?php foreach ($reviews as $review) : ?>
            <p class="review-text"><?= htmlspecialchars($review['review']); ?></p>

            <p class="rating-text">
              <span class="stars"><?= $review['rating']; ?></span>
            </p>

          <?php endforeach; ?>
        <?php else : ?>
          <p>No reviews available for this book.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
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