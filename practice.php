<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include 'PracticeOperations.php';

$imageToShow = '';
$businessInfo = [];

if (isset($_GET['imageId'])) {
    $imageId = intval($_GET['imageId']); 
    $imageToShow = fetchSelectedImage($conn, $imageId);
    $businessInfo = fetchBusinessInfo($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Banner Generator</title>
    <script>
        let selectedFrame = '';

        function selectFrame(framePath) {
            selectedFrame = framePath;
            const bannerImage = document.getElementById('bannerImage');
            if (bannerImage) {
                bannerImage.src = selectedFrame;
            }
        }

        function downloadBanner() {
            if (selectedFrame) {
                const link = document.createElement('a');
                link.href = selectedFrame; 
                link.download = 'banner.png'; 
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } else {
                alert('Please select a frame before downloading.');
            }
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
                        <img src="<?php echo htmlspecialchars($businessInfo['Logo']); ?>" alt="Logo" id="Logo" class="Logo" style="max-width: 120px; height: auto;">
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

                    <section>
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                        $frames = fetchFrames($conn);
                                        if ($frames) {
                                            foreach ($frames as $row) {
                                                echo '<img src="' . htmlspecialchars($row['Frame']) . '" class="Frame" style="max-width: 50%; height: auto; cursor: pointer;" onclick="selectFrame(\'' . htmlspecialchars($row['Frame']) . '\')">';
                                            }
                                        } else {
                                            echo "No frames found.";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <button onclick="downloadBanner()" class="download-button">Download Banner</button>
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
