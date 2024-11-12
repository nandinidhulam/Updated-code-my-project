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

                    <button class="btn btn-secondary" onclick="showFrames()">Select Frame</button>

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
            <h4>Select a Frame</h4>
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
