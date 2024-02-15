<?php
$host = "localhost";
$user = "postgres";
$pass = "9021";
$db = "form"; //Өгөгдлийн сан руу хандах параметрүүдэд зарлаж утга оноосон.

$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die("Unable to connect to PostgreSQL server"); 
//pg_connect ашиглан PostgreSQL мэдээллийн сантай холбогдоно, Холболт амжилтгүй болвол алдааны мессеж гаргаж код зогсоно. 

if (!$con) {
    echo "Error: Unable to connect to database."; // Холболт амжилтгүй бол алдааны мессеж харагдаж код зогсоно.
} else {
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
// Get ашиглаж sort параметр бүхий өгөгдлийг $sort хувьсагчид авна, амжилтгүй болвол $sort хувьсагчид '' утга онооно. 
    
if ($sort === 'star') {
    $query = "SELECT * FROM review ORDER BY star_number DESC";
    // Хэрэв $sort хувьсагч 'star' гэсэн өгөгдлийг агуулж байвал өгөгдлийн сангийн review хүснэгтээс
    // star_number хувьсагчийг буурах эрэмбээр select хийх бичиглэлийг $query хувьсагчид онооно.
} else {
    $query = "SELECT * FROM review";
    // Эсрэг тохиолдолд review өгөгдлийн сангийн review хүснэгтээс select үйлдэл хийх бичиглэлийг $query хувьсагчид онооно.
}


    $result = pg_query($con, $query); // pg_query функц ашиглан дээрх нөхцөлөөс хамаарсан 
    // $query-г гүйцэтгэж үр дүнг $result хувьсагчид онооно. 

    if ($result) { // хэрэв дээрх query амжилттай хэрэгжиж $result-д үр дүнг авсан бол.
        $totalStars = 0; // Сэтгэгдлүүдийн нийт одын тоо
        $totalComments = pg_num_rows($result); // result-д байгаа нийт мөрийн тоог $totalComments хувьсагчид оноосон.

        while ($row = pg_fetch_assoc($result)) { //pg_fetch_assoc хувсагчийг ашиглан result-н нийт мөрийг $row хувьсагчид онооно.
            $totalStars += $row['star_number']; // $totalStars хувьсагчид сэтгэгдэл тус бүрийн star_number-г нэмж оноосон.
        }

        $overallStarRating = ($totalComments > 0) ? round($totalStars / $totalComments, 1) : 0;
        // Хэрэв нийт сэтгэгдлийн тоо 0-с их тохиолдолд дээрх томъёогоор нийт одны дундаж утгыг олж overallStarRating хувьсагчид оноосон.
        // Эсрэг буюу 1 ч сэтгэгдэл байхгүй тохиолдолд overallStarRating-д 0 утга онооно.
     
        echo "<div class='overview'>";
        echo "<h2>Үнэлгээ</h2>";
        echo "<p><strong>Overall Ерөнхий од:</strong> $overallStarRating</p>";
        echo "<p><strong>Нийт коммент:</strong> $totalComments</p><br>";
        echo "</div>";
        //Нийт од болон сэтгэгдлийн тоог харуулна.

        pg_result_seek($result, 0); 
        // pg_result_seek функц ашиглан $result хувьсагчийг авсан өөрт агуулж буй өгөгдлийн хамгийн эхний мөрийг заана
        

        // Сэтгэгдэл тус бүрийг харуулах давталт нийт мөрийн тоогоор давталт гүйлгэсэн.
        while ($row = pg_fetch_assoc($result)) {
  
            $html = "<div class='review'>";
            $html .= "<div><strong>Хэрэглэгчийн нэр:</strong> " . $row['username'] . "</div>";
            $html .= "<div><strong>Од:</strong> ";
            
            // Од шар өнгөөр харагдах одны тоо хүртэл давталт гүйлгэсэн.
            for ($i = 0; $i < $row['star_number']; $i++) {
                $html .= "<span style='color: yellow;'>&#9733;</span>"; 
            }

            // Бичсэн сэтгэгдлүүдийг тухайн мөрийн тоотой харгалзуулж html бичсэн
            $html .= "</div>";
            $html .= "<div><strong>Сэтгэгдэл:</strong> " . $row['comment'] . "</div><br>";
            $html .= "</div>";

            // Дээрх бичсэн html хэсгийг output хийх.
            echo $html;
        }
        
    } else {
        echo "Error: Unable to fetch reviews.";
        // Өгөгдөл амжилтгүй авсан тохиолдолд алдааны мессеж харуулна.
    }
    
}

pg_close($con); // Өгөгдлийн сангийн холбоосыг хаасан.
?>
