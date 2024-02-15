<?php
$db = pg_connect("host=localhost port=5432 dbname=form user=postgres password=9021");

$username = $_POST['username'];
$password = $_POST['password']; // HTML-с авсан username password-н утгыг $username $password утгуудад онооно.

$query = "INSERT INTO users (username, password) VALUES ('$username', '$password')"; // Шинээр бүртгүүлж байгаа учраас insert үйлдэд хийнэ.
$result = pg_query($db, $query);

if ($result) {
    
    echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>";
    echo "<div style='text-align: center; font-family: \"Nunito\", sans-serif;'>";
    echo "<h1>Бүртгэл амжилттай</h1>";
    echo "<button style='font-family: \"Nunito\", sans-serif; padding: 10px 20px; background-color: #F1C439; color: white; border: none; border-radius: 8px; cursor: pointer;' onclick=\"window.location.href='login.html';\">Нэвтрэх</button>";
    echo "</div>";
    echo "</div>";
    // Бүртгэл амжилттай бол амжилттай мессеж харуулна
} else {
    echo "Error: " . pg_last_error($db);
    // Бүртгэл амжилтгүй бол амжилтгүй мессеж харуулна.
}

pg_close($db);
?>
