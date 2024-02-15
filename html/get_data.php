<?php
$host = "localhost";
$user = "postgres";
$pass = "9021";
$db = "form";

$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die("Unable to connect to PostgreSQL server");

$query = "SELECT * FROM form";
$result = pg_query($con, $query);

$data = array();
while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);

pg_close($con);
?>
