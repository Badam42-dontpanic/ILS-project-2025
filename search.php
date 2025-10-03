<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
</style>
</head>
<body>

    <h1>Search Results</h1>

    <?php
    // Load MySQL credentials
    require_once '/var/www/login.php';

    // Enable MySQL error reporting
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Establish connection
    $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search = trim($_POST['search']);
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM books 
                                WHERE (author LIKE ? OR title LIKE ? OR publisher LIKE ?) 
                                AND copyright BETWEEN ? AND ?");

        // Use wildcard search
        $search_param = "%$search%";
        $stmt->bind_param("sssss", $search_param, $search_param, $search_param, $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Author</th><th>Title</th><th>Publisher</th><th>Copyright</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["author"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["publisher"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["copyright"]) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No results found.</p>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>

    <p><a href="mylibrary.html">Return to search page</a></p>

</body>
</html>
