<?php
$db = pg_connect("host=localhost port=5432 dbname=form user=postgres password=9021");

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = pg_query($db, $query);
$row = pg_fetch_assoc($result);

if ($row) {

    echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>";
    echo "<div style='text-align: center; font-family: \"Nunito\", sans-serif;'>";
    echo "<h1>Амжилттай</h1>";
    echo "<button style='font-family: \"Nunito\", sans-serif; padding: 10px 20px; background-color: #F1C439; color: white; border: none; border-radius: 8px; cursor: pointer;' onclick=\"window.location.href='ad-zar.html';\">Зар оруулах</button>";
    echo "</div>";
    echo "</div>";
} else {
    echo "Амжилтгүй. Дахиад оролдно уу.";
}

pg_close($db);
?>
