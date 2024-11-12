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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Banner Generator</title> 
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
                    <a href="download.php?imageId=<?php echo intval($_GET['imageId']); ?>" class="download-button">Download Banner</a>
                    <a href="frame.php?imageId=<?php echo intval($_GET['imageId']); ?>" class="edit-button btn btn-danger">Edit</a>
                <?php else: ?>
                    <p>No image selected.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
</body>
</html>
