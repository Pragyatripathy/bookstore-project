<?php
/*
* 1: Database and Table Creation
Objective: Establish a foundational database schema for a book store.

Task:

Create a MySQL database named "BookStore".
Within this database, create three tables: "books", "book_reviews" and "book_formats".

The "books" table should have fields:
book_id (int, primary key, auto-increment)
title (varchar, not null)
author (varchar, not null)
publication_date (date, not null)
isbn (varchar, unique, not null)

The "book_reviews" table should have fields:
review_id (int, primary key, auto-increment)
book_id (int, foreign key references books(book_id))
reviewer_name (varchar, not null)
review (text, not null)
rating (int)

The "book_formats" table should have fields:
book_id (int, foreign key references books(book_id))
format (enum['paperback', 'ebook', 'audiobook'])

* 2: Book Entry Form
Objective: Implement a form to add books to the "books" table.

Task:

Design an HTML form to input data for the fields in the "books" table.
Add optional multiple-choice checkboxes to select if the book is available in additional formats (paperback, audiobook, ebook).
Use PHP for form handling:
Validate required fields and ensure the ISBN is unique.
Display error messages in red for validation failures.
On successful submission, save the book details to the database and show a success message.

* 3: Book Listing and Search Page
Objective: Display all books and enable dynamic searching.

Task:

Develop a PHP script that retrieves and lists all books from the "books" table plus an avarage rating.
Implement a JavaScript-based search feature using AJAX to filter books by title or author without reloading the page.
Each book listing should include a 'details' button that directs to a page with more detailed information about the book, including associated reviews.

* 4: Detailed Book Page and Updates
Objective: Allow detailed viewing and modification of book data.

Task:

Create a page that displays detailed information about a book, fetched by its book_id.
Show all reviews from the "book_reviews" table related to this book.
Include a 'modify' button:
Redirects to a form where book details can be updated, and new reviews can be added.
Handle form submissions in PHP to update book information and add new reviews to the "book_reviews" table.

*/
