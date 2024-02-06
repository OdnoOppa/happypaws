<?php
$host = "localhost";
$user = "postgres";
$pass = "9021";
$db = "form";

$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die("Unable to connect to PostgreSQL server");

if (!$con) {
    echo "error: no data\n";
} else {
    // Form data
    $username = pg_escape_string($_POST['username']);
    $star_number = intval($_POST['star_number']);
    $comment = pg_escape_string($_POST['comment']);

    // database ruu oruulah
    $query = "INSERT INTO review (username, star_number, comment) VALUES ('$username', $star_number, '$comment')";
    $result = pg_query($con, $query);

    if ($result) {
        echo "<h1>Review submitted successfully!</h1>";

        // Doh review haruulah
        $retrieve_query = "SELECT * FROM review ORDER BY id DESC";
        $retrieve_result = pg_query($con, $retrieve_query);

        if ($retrieve_result) {
            echo "<h2>Reviews</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Username</th><th>Star Rating</th><th>Comment</th></tr>";
            while ($row = pg_fetch_assoc($retrieve_result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['star_number'] . "</td>";
                echo "<td>" . $row['comment'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Error fetching data: " . pg_last_error($con) . "<br>";
        }
    } else {
        echo "Error submitting review: " . pg_last_error($con);
    }
}

pg_close($con);
?>
