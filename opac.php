<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL Server Example</title>
</head>
<body>

    <h1>A Basic OPAC</h1>
    <p>We can retrieve all the data from our database and book table using a couple of different queries.</p>

    <?php
    // Load MySQL credentials securely
    require_once '/var/www/login.php';

    // Enable detailed MySQL error reporting
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Establish database connection
    $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "<h2>Query 1: Retrieving Publisher and Author Data</h2>";

    // Query using prepared statement
    $stmt = $conn->prepare("SELECT publisher, author FROM books");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<p>Publisher " . htmlspecialchars($row["publisher"]) .
             " published a book by " . htmlspecialchars($row["author"]) . ".</p>";
    }

    $stmt->close();

    echo "<h2>Query 2: Retrieving Author, Title, and Date Published Data</h2>";

    $stmt2 = $conn->prepare("SELECT author, title, copyright FROM books");
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    while ($row = $result2->fetch_assoc()) {
        echo "<p>A book by " . htmlspecialchars($row["author"]) .
             " titled <em>" . htmlspecialchars($row["title"]) .
             "</em> was released in " . htmlspecialchars($row["copyright"]) . ".</p>";
    }

    $stmt2->close();
    $conn->close();
    ?>

</body>
</html>


