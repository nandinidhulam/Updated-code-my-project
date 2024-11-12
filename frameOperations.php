<?php

function fetchSelectedImage($conn, $imageId) {
    $stmt = $conn->prepare("SELECT ImagePath FROM tblimages WHERE id = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $imageId);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $imageToShow = '';
    
    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $imageToShow = htmlspecialchars($row['ImagePath']); 
        }
    } else {
        echo "Error executing query: " . $stmt->error;
    }
    
    $stmt->close();
    return $imageToShow;
}

function fetchBusinessInfo($conn) {
    $sqlInfo = "SELECT * FROM tblinfo LIMIT 1"; 
    $infoResult = $conn->query($sqlInfo);
    
    $businessInfo = [];
    if ($infoResult) {
        if ($infoResult->num_rows > 0) {
            $businessInfo = $infoResult->fetch_assoc(); 
        }
    } else {
        echo "Error executing query: " . $conn->error;
    }
    
    return $businessInfo;
}
?>
