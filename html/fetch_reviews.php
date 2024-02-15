<?php
$host = "localhost";
$user = "postgres";
$pass = "9021";
$db = "form";

$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die("Unable to connect to PostgreSQL server");

if (!$con) {
    echo "Error: Unable to connect to database.";
} else {
    // sorting parametr set hiigdsn eseh
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

    // Fetch database display hiih
if ($sort === 'star') {
    $query = "SELECT * FROM review ORDER BY star_number DESC";
} else {
    $query = "SELECT * FROM review";
}


    $result = pg_query($con, $query);

    if ($result) {
        // buh comment, dundaj star rate hiih
        $totalStars = 0;
        $totalComments = pg_num_rows($result);

        while ($row = pg_fetch_assoc($result)) {
            $totalStars += $row['star_number'];
        }

        $overallStarRating = ($totalComments > 0) ? round($totalStars / $totalComments, 1) : 0;

     
        echo "<div class='overview'>";
        echo "<h2>Үнэлгээ</h2>";
        echo "<p><strong>Overall Ерөнхий од:</strong> $overallStarRating</p>";
        echo "<p><strong>Нийт коммент:</strong> $totalComments</p><br>";
        echo "</div>";

        // ur dungiin eheleliig reset hiih
        pg_result_seek($result, 0);
        

        // review neg bur dr loop
        while ($row = pg_fetch_assoc($result)) {
  
            $html = "<div class='review'>";
            $html .= "<div><strong>Хэрэглэгчийн нэр:</strong> " . $row['username'] . "</div>";
            $html .= "<div><strong>Од:</strong> ";
            
            // star shar ungutei gargaj ireh
            for ($i = 0; $i < $row['star_number']; $i++) {
                $html .= "<span style='color: yellow;'>&#9733;</span>"; 
            }
            
            $html .= "</div>";
            $html .= "<div><strong>Сэтгэгдэл:</strong> " . $row['comment'] . "</div><br>";
            $html .= "</div>";

            // html ee output hiih
            echo $html;
        }
        
    } else {
        echo "Error: Unable to fetch reviews.";
    }
    
}

pg_close($con);
?>
