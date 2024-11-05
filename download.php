<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "adbanao_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$imagePath = ''; 
$businessInfo = []; 
$logoPath = '';

if (isset($_GET['imageId'])) {
    $imageId = intval($_GET['imageId']); 
    $stmt = $conn->prepare("SELECT ImagePath FROM tblimages WHERE id = ?");
    
    if ($stmt) {
        $stmt->bind_param("i", $imageId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $imagePath = htmlspecialchars($row['ImagePath']); 
        } else {
            die('No image found with that ID.');
        }

        $stmt->close();
    } else {
        die('Database query preparation failed.');
    }
}

$sqlInfo = "SELECT * FROM tblinfo LIMIT 1"; 
$infoResult = $conn->query($sqlInfo);

if ($infoResult && $infoResult->num_rows > 0) {
    $businessInfo = $infoResult->fetch_assoc(); 
    $logoPath = htmlspecialchars($businessInfo['Logo']);
}

if ($imagePath) {
    if (!file_exists($imagePath)) {
        die('Image file does not exist: ' . $imagePath);
    }

    ob_end_clean();
    $banner = imagecreatefromjpeg($imagePath); 

    if (!$banner) {
        die('Failed to create image from the source. Check if the file is a valid JPEG.');
    }

    $newWidth = 1200;  
    $newHeight = 800;  

    $resizedBanner = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($resizedBanner, $banner, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($banner), imagesy($banner));

    $white = imagecolorallocate($resizedBanner, 255, 255, 255); 
    $red = imagecolorallocate($resizedBanner, 255, 0, 0); // Red color for contact info
    $green = imagecolorallocate($resizedBanner, 79, 161, 47);  // Green color for the business name

    // Load font
    $fontPath = 'C:\xampp\htdocs\Nandini\my project\font\arial.ttf'; // Update this path as necessary
    if (!file_exists($fontPath)) {
        die('Font file does not exist: ' . $fontPath);
    }

    $businessNameX = intval(($newWidth - (strlen($businessInfo['BusinessName']) * 15)) / 2); // Center business name
    imagettftext($resizedBanner, 20, 0, $businessNameX, 70, $green, $fontPath, htmlspecialchars($businessInfo['BusinessName'])); // Business name at top center
    
    // Bottom left contact information (red color for contact info)
    $contactY = $newHeight - 90; // Starting Y position for contact info
    imagettftext($resizedBanner, 20, 0, 20, $contactY, $red, $fontPath, "Contact Number: " . htmlspecialchars($businessInfo['ContactNumber']));
    imagettftext($resizedBanner, 20, 0, 20, $contactY + 30, $red, $fontPath, "Address: " . htmlspecialchars($businessInfo['Address']));
    imagettftext($resizedBanner, 20, 0, 20, $contactY + 60, $red, $fontPath, "Email: " . htmlspecialchars($businessInfo['Email']));
    imagettftext($resizedBanner, 20, 0, 20, $contactY + 90, $red, $fontPath, "Website: " . htmlspecialchars($businessInfo['Website']));

    // Add the logo on the left side
    if ($logoPath && file_exists($logoPath)) {
        $logo = imagecreatefromjpeg($logoPath); // Assuming the logo is in JPEG format
        
        // Resize and place the logo
        $logoWidth = 150;  // Desired width for logo
        $logoHeight = 150; // Maintain aspect ratio if necessary
        
        // Get original logo dimensions
        list($originalLogoWidth, $originalLogoHeight) = getimagesize($logoPath);
        
        // Create a new true color image to copy the resized logo
        $resizedLogo = imagecreatetruecolor($logoWidth, $logoHeight);
        
        // Retain PNG transparency
        imagealphablending($resizedLogo, false);
        imagesavealpha($resizedLogo, true);
        $transparent = imagecolorallocatealpha($resizedLogo, 0, 0, 0, 127);
        imagefilledrectangle($resizedLogo, 0, 0, $logoWidth, $logoHeight, $transparent);

        // Resize the logo
        imagecopyresampled($resizedLogo, $logo, 0, 0, 0, 0, $logoWidth, $logoHeight, $originalLogoWidth, $originalLogoHeight);

        // Copy resized logo onto the banner
        imagecopy($resizedBanner, $resizedLogo, 20, 20, 0, 0, $logoWidth, $logoHeight);
        
        // Clean up
        imagedestroy($resizedLogo);
        imagedestroy($logo);
    }

    // Output the image as a downloadable file
    header('Content-Type: image/jpeg');
    header('Content-Disposition: attachment; filename="banner.jpeg"');

    if (!imagejpeg($resizedBanner)) {
        die('Failed to generate the image.');
    }

    // Clean up
    imagedestroy($resizedBanner);
    imagedestroy($banner);
} else {
    die('Image path is not set.');
}

$conn->close();
?>
