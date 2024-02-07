<?php
//submit_review.php
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
        
     
        echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>";
        echo "<div style='text-align: center; font-family: \"Nunito\", sans-serif;'>";
        echo "<h1>Сэтгэгдлээ үлдээсэнд баярлалаа!</h1>";
        echo "<button style='font-family: \"Nunito\", sans-serif; padding: 10px 20px; background-color: #F1C439; color: white; border: none; border-radius: 8px; cursor: pointer;' onclick=\"window.location.href='rating.html';\">Буцах</button>";
        echo "</div>";
        echo "</div>";

      
    } else {
        echo "Error submitting review: " . pg_last_error($con);
    }
}

pg_close($con);
?>
