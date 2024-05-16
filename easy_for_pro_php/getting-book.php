<?php
// Include database connection
require_once 'database.php';

// Sanitize the search input
$search = '';
if (isset($_POST['search'])) {
  $search = mysqli_real_escape_string($conn, $_POST['search']);
}

// Build the base query
$query = "SELECT b.book_id, b.title, b.author, b.publication_date, b.isbn, COALESCE(AVG(r.rating), 0) AS avg_rating
          FROM books b
          LEFT JOIN book_reviews r ON b.book_id = r.book_id";

// sql query for searching data in searchbar
if (!empty($search)) {
  $query .= " WHERE b.title LIKE '%$search%' OR b.author LIKE '%$search%'";
}

// Group and order the results
$query .= " GROUP BY b.book_id ORDER BY b.title ASC";

// Execute the query and check for errors
$result = mysqli_query($conn, $query);
if (!$result) {
  echo "Error querying the database.";
  exit;
}

// Fetch all results
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the database connection
mysqli_close($conn);

?>

<!-- Display books in a table format -->
<table class="books-table">
  <thead>
    <tr>
      <th>Book ID</th>
      <th>Title</th>
      <th>Author</th>
      <th>Publication Date</th>
      <th>ISBN</th>
      <th>Average Rating</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($books as $book) : ?>
      <tr>
        <td><?= htmlspecialchars($book['book_id']) ?></td>
        <td><?= htmlspecialchars($book['title']) ?></td>
        <td><?= htmlspecialchars($book['author']) ?></td>
        <td><?= htmlspecialchars($book['publication_date']) ?></td>
        <td><?= htmlspecialchars($book['isbn']) ?></td>
        <td><?= htmlspecialchars(number_format($book['avg_rating'], 1)) ?></td>
        <td><a href="./books-details.php?book_id=<?= $book['book_id']; ?>" class="button">More details</a> </td>
        <td><a href="edit-book.php?book_id=<?= $book['book_id']; ?>" class="button">Modify</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
//? start of query string