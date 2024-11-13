<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "adbanao_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function fetchImages($conn) {
    $sql = "SELECT id, ImagePath FROM tblimages";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<a href="practice.php?imageId=' .($row['id']) . '">
                    <img src="' .($row['ImagePath']) . '" class="Img"></a>';
        }
    } else {
        echo "No images found.";
    }
}

fetchImages($conn);
?>
