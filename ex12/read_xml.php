<!DOCTYPE html>
<html>
<head>
    <title>Ex 12 - Books Library</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h2 {
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 60%;
        }
        th, td {
            border: 1px solid #999;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<h2>Book Details from XML</h2>

<?php
$xml = simplexml_load_file("books.xml") or die("Error: Cannot load XML file.");

echo "<table>";
echo "<tr><th>Title</th><th>Author</th><th>Year</th><th>Price</th></tr>";

foreach ($xml->book as $book) {
    echo "<tr>";
    echo "<td>" . $book->title . "</td>";
    echo "<td>" . $book->author . "</td>";
    echo "<td>" . $book->year . "</td>";
    echo "<td>" . $book->price . "</td>";
    echo "</tr>";
}

echo "</table>";
?>

</body>
</html>