<?php
$host = "localhost";
$user = "postgres";
$pass = "9021";
$db = "form";


$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Unable to connect to PostgreSQL server");

if(!$con){
    echo "error: no data\n";    
} else{

    $gender = $_POST['gender'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $color = $_POST['color'];

    $query = "INSERT INTO form(gender, type, location, color) VALUES ('$gender','$type','$location','$color')";
    $result = pg_query($con, $query);
    
    if ($result) {
        echo "<h1> Амжилттай бүртгэгдлээ!</h1>";
        
    } else {
        echo "Бүртгэхэд алдаа гарлаа " . pg_last_error($con);
    }
}
 // List dursleh
 $retrieve_query = "SELECT * FROM form ORDER BY id DESC"; 
 $retrieve_result = pg_query($con, $retrieve_query);
 if ($retrieve_result) {

     echo "<h2>Бүртгэл</h2>";
     echo "<table>";
     echo "<tr><th>ID</th><th>Хүйс</th><th>Төрөл</th><th>Байршил</th><th>Өнгө</th></tr>";
     while ($row = pg_fetch_assoc($retrieve_result)) {
         echo "<tr>";
         echo "<td>" . $row['id'] . "</td>";
         echo "<td>" . $row['gender'] . "</td>";
         echo "<td>" . $row['type'] . "</td>";
         echo "<td>" . $row['location'] . "</td>";
         echo "<td>" . $row['color'] . "</td>";
         echo "</tr>";
     }
     echo "</table>";
 } 

 else {
     echo "Өгөгдлийн сангаас мэдээллийг авахад алдаа гарлаа: " . pg_last_error($con) . "<br>";
 }


echo '<br><button><a href="ad-zar.html">Буцах</a></button>';

pg_close($con);

?>
