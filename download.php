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
            $imagePath = $row['ImagePath']; 
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
    $logoPath = $businessInfo['Logo'];  
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

    $black = imagecolorallocate($resizedBanner, 0, 0, 0); 
    $white = imagecolorallocate($resizedBanner, 255, 255, 255); 

    $fontPath = 'C:/xampp/htdocs/Nandini/my_project/font/arial.ttf';
    if (!file_exists($fontPath)) {
        die('Font file does not exist: ' . $fontPath);
    }

    $contactBackgroundHeight = 230; 
    imagefilledrectangle($resizedBanner, 10, $newHeight - $contactBackgroundHeight - 10, $newWidth - 10, $newHeight - 10, $white);

    $textX = 20; 
    $textY = $newHeight - $contactBackgroundHeight + 30; 
    $lineSpacing = 40; 

    imagettftext($resizedBanner, 20, 0, $textX, $textY, $black, $fontPath, "Business Name: " . $businessInfo['BusinessName']);

    imagettftext($resizedBanner, 20, 0, $textX, $textY + $lineSpacing, $black, $fontPath, "Contact Number: " . $businessInfo['ContactNumber']);
    imagettftext($resizedBanner, 20, 0, $textX, $textY + $lineSpacing * 2, $black, $fontPath, "Address: " . $businessInfo['Address']);
    imagettftext($resizedBanner, 20, 0, $textX, $textY + $lineSpacing * 3, $black, $fontPath, "Email: " . $businessInfo['Email']);
    imagettftext($resizedBanner, 20, 0, $textX, $textY + $lineSpacing * 4, $black, $fontPath, "Website: " . $businessInfo['Website']);

    if ($logoPath && file_exists($logoPath)) {
        $logoMime = mime_content_type($logoPath);
        switch ($logoMime) {
            case 'image/jpeg':
                $logo = imagecreatefromjpeg($logoPath);
                break;
            case 'image/png':
                $logo = imagecreatefrompng($logoPath);
                break;
            case 'image/gif':
                $logo = imagecreatefromgif($logoPath);
                break;
            default:
                die('Unsupported logo format: ' . $logoMime);
        }

        if ($logo) {
            $logoWidth = 400;   //increase the logo width
            $logoHeight = 200; //increase the logo height
            list($originalLogoWidth, $originalLogoHeight) = getimagesize($logoPath);

            $resizedLogo = imagecreatetruecolor($logoWidth, $logoHeight);

            imagealphablending($resizedLogo, false);
            imagesavealpha($resizedLogo, true);
            $transparent = imagecolorallocatealpha($resizedLogo, 0, 0, 0, 127);
            imagefilledrectangle($resizedLogo, 0, 0, $logoWidth, $logoHeight, $transparent);

            imagecopyresampled($resizedLogo, $logo, 0, 0, 0, 0, $logoWidth, $logoHeight, $originalLogoWidth, $originalLogoHeight);

            imagecopy($resizedBanner, $resizedLogo, 20, 20, 0, 0, $logoWidth, $logoHeight);

            imagedestroy($resizedLogo);
            imagedestroy($logo);
        } else {
            die('Failed to create image from the logo source.');
        }
    }

    header('Content-Type: image/jpeg');
    header('Content-Disposition: attachment; filename="banner.jpeg"');

    if (!imagejpeg($resizedBanner)) {
        die('Failed to generate the image.');
    }

    imagedestroy($resizedBanner);
    imagedestroy($banner);
} else {
    die('Image path is not set.');
}

$conn->close();
?>
