(updated code for 12/11/)


<?php 
include 'practiceOperations.php';
$imageToShow = '';
$businessInfo = [];

if (isset($_GET['imageId'])) {
    $imageId = intval($_GET['imageId']); 
    $imageToShow = fetchSelectedImage($conn, $imageId);
    $businessInfo = fetchBusinessInfo($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Banner Generator</title> 
    <script>
        function changeBannerImage(frameSrc) {
            // Change the src of the banner image
            document.getElementById('bannerImage').src = frameSrc;
        }
    </script>
</head>
<body>
<section>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <?php if ($imageToShow): ?>
                    <div class="image-container">
                        <img id="bannerImage" src="<?php echo $imageToShow; ?>" alt="Selected Image">
						<!-- Logo with Blinking Effect -->
                        <img class="blink" src="<?php echo htmlspecialchars($businessInfo['Logo']); ?>" alt="Logo" id="Logo" class="Logo" style="max-width:250px; height: auto;">
                        <div class="overlay">
                            <h2><?php echo htmlspecialchars($businessInfo['BusinessName']); ?></h2>
                        </div>
                        <div class="contact-info">
                            <p>Contact Number: <?php echo htmlspecialchars($businessInfo['ContactNumber']); ?></p>
                            <p>Address: <?php echo htmlspecialchars($businessInfo['Address']); ?></p>
                            <p>Email: <?php echo htmlspecialchars($businessInfo['Email']); ?></p>
                            <p>Website: <a href="<?php echo htmlspecialchars($businessInfo['Website']); ?>" style="color: #007bff;"><?php echo htmlspecialchars($businessInfo['Website']); ?></a></p>
                        </div>
                    </div>

                    <?php
                        $sql = "SELECT id, Frame FROM tblframes";
                        $result = $conn->query($sql);

                        if ($result) {
							
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<img src="' . htmlspecialchars($row['Frame']) . '" class="Frame" style="max-width: 25%; height: auto; cursor: pointer;" onclick="changeBannerImage(\'' . htmlspecialchars($row['Frame']) . '\')">';
                                }
                            } else {
                                echo "No images found.";
                            }
                        } else {
                            echo "Error: " . $conn->error;  
                        }
                    ?>
                               
                    <a href="download.php?imageId=<?php echo intval($_GET['imageId']); ?>" class="download-button">Download Banner</a>
                <?php else: ?>
                    <p>No image selected.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
</body>
</html>

<frame.php old code>
<?php
include('frameOperations.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adbanao_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$imageToShow = '';
if (isset($_GET['imageId'])) {
    $imageToShow = fetchSelectedImage($conn, intval($_GET['imageId']));
}

$businessInfo = fetchBusinessInfo($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Banner Generator</title>
    <script>
        function changeBannerImage(frameSrc) {
            document.getElementById('bannerImage').src = frameSrc;
        }
    </script>
</head>
<body>
<section>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <?php if ($imageToShow): ?>
                    <div class="image-container">
                        <img id="bannerImage" src="<?php echo $imageToShow; ?>" alt="Selected Image">
                        <img class="blink" src="<?php echo htmlspecialchars($businessInfo['Logo']); ?>" alt="Logo" id="Logo" style="max-width:250px; height: auto;">
                        <div class="overlay">
                            <h2><?php echo htmlspecialchars($businessInfo['BusinessName']); ?></h2>
                        </div>
                        <div class="contact-info">
                            <p>Contact Number: <?php echo htmlspecialchars($businessInfo['ContactNumber']); ?></p>
                            <p>Address: <?php echo htmlspecialchars($businessInfo['Address']); ?></p>
                            <p>Email: <?php echo htmlspecialchars($businessInfo['Email']); ?></p>
                            <p>Website: <a href="<?php echo htmlspecialchars($businessInfo['Website']); ?>" style="color: #007bff;"><?php echo htmlspecialchars($businessInfo['Website']); ?></a></p>
                        </div>
                    </div>

                    <?php
                    $sql = "SELECT id, Frame FROM tblframes";
                    $result = $conn->query($sql);

                    if ($result) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<img src="' . htmlspecialchars($row['Frame']) . '" class="Frame" style="max-width: 25%; height: auto; cursor: pointer;" onclick="changeBannerImage(\'' . htmlspecialchars($row['Frame']) . '\')">';
                            }
                        } else {
                            echo "No frames found.";
                        }
                    } else {
                        echo "Error: " . $conn->error;
                    }
                    ?>
                    <br>
                    <a href="download.php?imageId=<?php echo intval($_GET['imageId']); ?>" class="btn btn-primary">Download Banner</a>
                <?php else: ?>
                    <p>No image selected.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>

<frame13/11.php>
<?php
include('frameOperations.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adbanao_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$imageToShow = '';
if (isset($_GET['imageId'])) {
    $imageToShow = fetchSelectedImage($conn, intval($_GET['imageId']));
}

$businessInfo = fetchBusinessInfo($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Banner Generator</title>
    <script>
        function changeBannerImage(frameSrc) {
            document.getElementById('bannerImage').src = frameSrc;
        }

        function showFrames() {
            document.getElementById('framesModal').style.display = 'block';
        }

        function hideFrames() {
            document.getElementById('framesModal').style.display = 'none';
        }
    </script>
</head>
<body>
<section>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <?php if ($imageToShow): ?>
                    <div class="image-container">
                        <img id="bannerImage" src="<?php echo $imageToShow; ?>" alt="Selected Image">
                        <img class="blink" src="<?php echo htmlspecialchars($businessInfo['Logo']); ?>" alt="Logo" id="Logo" style="max-width:250px; height: auto;">
                        <div class="overlay">
                            <h2><?php echo htmlspecialchars($businessInfo['BusinessName']); ?></h2>
                        </div>
                        <div class="contact-info">
                            <p>Contact Number: <?php echo htmlspecialchars($businessInfo['ContactNumber']); ?></p>
                            <p>Address: <?php echo htmlspecialchars($businessInfo['Address']); ?></p>
                            <p>Email: <?php echo htmlspecialchars($businessInfo['Email']); ?></p>
                            <p>Website: <a href="<?php echo htmlspecialchars($businessInfo['Website']); ?>" style="color: #007bff;"><?php echo htmlspecialchars($businessInfo['Website']); ?></a></p>
                        </div>
                    </div>

                    <button class="btn btn-danger" onclick="showFrames()">Edit Text</button>
					
                    <button class="btn btn-dark" onclick="showFrames()">Select Frame</button>
                    <br><br>
                    <a href="download.php?imageId=<?php echo intval($_GET['imageId']); ?>" class="btn btn-primary">Download Banner</a>
                <?php else: ?>
                    <p>No image selected.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="framesModal" class="modal">
        <div class="modal-content">
            <span onclick="hideFrames()" style="cursor: pointer; float: right; font-size: 24px; color: red;">&times;</span>
			
            <div class="frame-container">
                <?php
                $sql = "SELECT id, Frame FROM tblframes";
                $result = $conn->query($sql);

                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<img src="' . htmlspecialchars($row['Frame']) . '" class="Frame" style="max-width: 25%; height: auto; cursor: pointer;" onclick="changeBannerImage(\'' . htmlspecialchars($row['Frame']) . '\'); hideFrames();">';
                        }
                    } else {
                        echo "No frames found.";
                    }
                } else {
                    echo "Error: " . $conn->error;
                }
                ?>
            </div>
        </div>
    </div>
	 <div id="framesModal" class="modal">
        <div class="modal-content">
            <span onclick="hideFrames()" style="cursor: pointer; float: right; font-size: 24px; color: red;">&times;</span>
			
            <div class="frame-container">
                <?php
                $sql = "SELECT id, Frame FROM tblframes";
                $result = $conn->query($sql);

                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<img src="' . htmlspecialchars($row['Frame']) . '" class="Frame" style="max-width: 25%; height: auto; cursor: pointer;" onclick="changeBannerImage(\'' . htmlspecialchars($row['Frame']) . '\'); hideFrames();">';
                        }
                    } else {
                        echo "No frames found.";
                    }
                } else {
                    echo "Error: " . $conn->error;
                }
                ?>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>

<download13/11.php>
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
	
    $blue = imagecolorallocate($resizedBanner, 0, 123, 255);
    $white = imagecolorallocate($resizedBanner, 255, 255, 255); 
    $red = imagecolorallocate($resizedBanner, 255, 0, 0);
    $green = imagecolorallocate($resizedBanner, 79, 161, 47);  
   
    $fontPath = 'C:/xampp/htdocs/Nandini/my_project/font/arial.ttf';
    if (!file_exists($fontPath)) {
        die('Font file does not exist: ' . $fontPath);
    }

    $businessNameX = intval(($newWidth - (strlen($businessInfo['BusinessName']) * 15)) / 2); 
    imagettftext($resizedBanner, 20, 0, $businessNameX, 70, $green, $fontPath, htmlspecialchars($businessInfo['BusinessName'])); 
    
    $contactY = $newHeight - 90; 
    imagettftext($resizedBanner, 20, 0, 20, $contactY, $red, $fontPath, "Contact Number: " . htmlspecialchars($businessInfo['ContactNumber']));
    imagettftext($resizedBanner, 20, 0, 20, $contactY + 30, $red, $fontPath, "Address: " . htmlspecialchars($businessInfo['Address']));
    imagettftext($resizedBanner, 20, 0, 20, $contactY + 60, $red, $fontPath, "Email: " . htmlspecialchars($businessInfo['Email']));
    imagettftext($resizedBanner, 20, 0, 20, $contactY + 90, $blue, $fontPath, "Website: " . htmlspecialchars($businessInfo['Website']));

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
            $logoWidth = 150;
            $logoHeight = 150;
            list($originalLogoWidth, $originalLogoHeight) = getimagesize($logoPath);

            $resizedLogo = imagecreatetruecolor($logoWidth, $logoHeight);

            // Preserve transparency for PNG and GIF
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

