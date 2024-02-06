<?php
// fetch_reviews.php

$host = "localhost";
$user = "postgres";
$pass = "9021";
$db = "form";

// Connect to PostgreSQL server
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die("Unable to connect to PostgreSQL server");

if (!$con) {
    echo "Error: Unable to connect to database.";
} else {
    if (isset($_GET['sort']) && $_GET['sort'] === 'sort_by_stars') {
        // Fetch reviews from the database sorted by star rating (descending order)
        $query = "SELECT * FROM review ORDER BY star_number DESC";
    } else {
        // Fetch reviews from the database (without sorting)
        $query = "SELECT * FROM review";
    }
    // Fetch reviews from the database
    $query = "SELECT * FROM review";
    $result = pg_query($con, $query);

    if ($result) {
        // Calculate overall star rating and total number of comments
        $totalStars = 0;
        $totalComments = pg_num_rows($result);

        while ($row = pg_fetch_assoc($result)) {
            $totalStars += $row['star_number'];
        }

        $overallStarRating = ($totalComments > 0) ? round($totalStars / $totalComments, 1) : 0;

        // Output overview section
        echo "<div class='overview'>";
        echo "<h2>Overview</h2>";
        echo "<p><strong>Overall Star Rating:</strong> $overallStarRating</p>";
        echo "<p><strong>Total Comments:</strong> $totalComments</p>";
        echo "</div>";

        // Reset the pointer of the result set to the beginning
        pg_result_seek($result, 0);
        

        // Loop through each review
        while ($row = pg_fetch_assoc($result)) {
            // Generate HTML block for each review
            $html = "<div class='review'>";
            $html .= "<div><strong>Username:</strong> " . $row['username'] . "</div>";
            $html .= "<div><strong>Stars:</strong> ";
            
            // Add star icons based on star_number with yellow color
            for ($i = 0; $i < $row['star_number']; $i++) {
                $html .= "<span style='color: yellow;'>&#9733;</span>"; // Star symbol HTML entity with yellow color
            }
            
            $html .= "</div>";
            $html .= "<div><strong>Comment:</strong> " . $row['comment'] . "</div>";
            $html .= "</div>";

            // Output HTML for this review
            echo $html;
        }
        
    } else {
        echo "Error: Unable to fetch reviews.";
    }
    
}

pg_close($con);
?>
