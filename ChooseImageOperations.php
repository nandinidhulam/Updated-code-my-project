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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        
        
        $targetDir = "images/";
        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true); 
        }
        
        
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        
        $allowedTypes = array("jpg", "jpeg", "png");

        if (in_array($fileType, $allowedTypes)) {
           
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                
               
                $sql = "INSERT INTO tblimages (ImagePath) VALUES ('$targetFilePath')";
                
                if ($conn->query($sql) === TRUE) {
                    header("Location: Index.php");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                
            } else {
                echo "There was an error uploading your file.";
            }
        } else {
            echo  "<script>alert('Sorry, only JPG, JPEG, and PNG images are allowed.');</script>";
        }
    } else {
        echo "Please select a file to upload.";
    }
}

$conn->close();
?>
