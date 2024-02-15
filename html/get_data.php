<?php
$host = "localhost";
$user = "postgres";
$pass = "9021";
$db = "form";

$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die("Unable to connect to PostgreSQL server");

$query = "SELECT * FROM form"; // form хүснэгтээс бүх баганыг select хийж буй үйлдлийг $query хувьсагчид оноосон
$result = pg_query($con, $query); // $result хувьсагчид дээрх query үйлдлийнн үр дүнг оноосон

$data = array(); // $data хоосон хүснэгтэн хувьсагч үүсгэсэн
while ($row = pg_fetch_assoc($result)) {
    $data[] = $row; // $data хүснэгтэд $result хувьсагчийн утгыг мөр мөрөөр нь оноосон 
}

echo json_encode($data); // $data хувьсагч дахь өгөгдлийг json_encode функц ашиглан json формат руу хөрвүүлсэн, дараагаар нь output хийсэн.

pg_close($con);
?>
