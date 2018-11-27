# Relibrary

How to use:
- Install XAMPP (Windows/Mac) or LAMPP (Linux).
- Start PHP and MySQL from the XAMPP interface.
- Open the XAMPP directory in a terminal and navigate to the `htdocs` folder. This is where the web pages are stored.
- Download this repository using the command `git clone https://github.com/tipsypastels/relibrary.git`.
- Navigate to http://localhost/relibrary in your browser. If you did everything right, you should be on the site!

# ORM

Instead of writing raw SQL everywhere we need to display information, I'm making a simple PHP interface that lets us automatically generate SQL behind the scenes. For example, to get a list of all books, instead of:

```sql
SELECT * FROM books
```

we can use our new equivalent right in the PHP code:

```php
Book::all();
```

we will still need to write SQL by hand in some places, but for simple cases it's easy to just make the PHP generate it for us. Further examples:

## Finding a book by ID
SQL:
```sql
SELECT * FROM books WHERE id = 1 LIMIT 1
```

PHP:
```php
Book::find('id = 1');
```

## Finding multiple values
SQL:
```sql
SELECT *  FROM books WHERE author_id = 1
```

PHP:
```php
Book::where('author_id = 1');
# (there's also a better way to do this, see next section)
```

## Getting the value of a column for a particular book
SQL:
```sql
SELECT name FROM books WHERE id = 1 LIMIT 1
```

PHP:
```php
Book::find('id = 1')->name();
```

## Foreign Keys
It also can handle foreign keys automatically. This allows us to not need to manually write joins.

```php
$book = Book::find('id = 1');
$book->author();
```

Will look up an Author whose id matches the book's author_id. I call this a "belongs to" relationship.

The same can be done in reverse.

```php
$author = Author::find('id = 1');
$author->books();
```

This will find every book whose author_id matches the author's id. It returns an array of books. This is a "has many" relationship.