<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once("db.php");
 
$Flag = $_POST["Flag"];
 
if($Flag == "Save"){
	$crudUId = $_POST["crudUId"];
	$Name = $_POST["txtName"]; 
    $Email = $_POST["txtEmail"]; 
    $MobileNumber = $_POST["txtMobileNumber"]; 
    $date = date("Y-m-d", strtotime($_POST["dateofbirth"]));
    $selectsubjects = $_POST["selectsubjects"];
    $gender  = $_POST["gender"];
    $Address = $_POST["txtAddress"]; 


	if ($Flag == "Save") {
        if (empty($crudUId)) {
            // Insert new record
            $query = "INSERT INTO tbldemocrud (crudUId, Name, Email, MobileNumber, date, selectsubjects, gender, Address, Status) VALUES (UUID(),'$Name', '$Email', '$MobileNumber', '$date', '$selectsubjects', '$gender', '$Address', 'Active')";
            
            if ($conn->query($query) === TRUE) {
                echo "Add Successfully";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            // Update existing record
            $query = "UPDATE tbldemocrud SET Name = '$Name', Email = '$Email', MobileNumber = '$MobileNumber', date = '$date', selectsubjects ='$selectsubjects', gender = '$gender', Address = '$Address' WHERE crudUId = '$crudUId'";
            
            if ($conn->query($query) === TRUE) {
                echo "Update Successfully";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
    

}
    if($Flag == "GetRecords"){
		$sql = "SELECT * FROM tbldemocrud WHERE Status='Active' ";
		$rstTableQuery = mysqli_query($conn, $sql);
		
		echo "<div class='table table-responsive'> <table class='table' id='tbldemocrud'><thead>";
		echo "<tr>
               
				 <th>Name</th>
                 <th>Email</th>
                 <th>MobileNumber</th>
                 <th>DateofBirth</th>
                 <th>selectsubjects</th>
                 <th>Gender</th>
                 <th>Address</th>
				 <th>Action</th>

			</tr></thead><tbody>";
			$srNo = 0;
			while($rwTableQuery = mysqli_fetch_assoc($rstTableQuery)){
				 $srNo++;			 
				 $crudUId = $rwTableQuery["crudUId"];
				 $Name = $rwTableQuery["Name"];
                 $Email = $rwTableQuery["Email"];
                 $MobileNumber = $rwTableQuery["MobileNumber"];
                 $date = $rwTableQuery["date"];
                 $selectsubjects = $rwTableQuery["selectsubjects"];
                 $gender = $rwTableQuery["gender"];
                 $Address = $rwTableQuery["Address"];
			 
			echo "<tr>
                   
				<td>$Name</td>
                <td>$Email</td>
                <td>$MobileNumber</td>
                <td>$date</td>
                <td>$selectsubjects</td>
                <td>$gender</td>
                <td>$Address</td>
                
				<td>                    
					<button type='button' class='btn btn-outline-warning btn-sm btnEdit' onclick='Editrecord(\"$crudUId\")'>Edit</i></button>
					<button type='button' class='btn btn-outline-danger btn-sm btnDelete' onclick='Deleterecord(\"$crudUId\")'>Delete</button>
				</td>
				   </tr>";
			 }
		echo "</tbody></table></div>";
        
	}

    if($Flag == "editrecord"){
        $crudUId=$_POST["crudUId"];
        $sql = "SELECT * FROM tbldemocrud WHERE crudUId='$crudUId' ";
        $rstEdit = mysqli_query($conn, $sql);
        $rwEdit = mysqli_fetch_array($rstEdit, MYSQLI_ASSOC);
        echo json_encode($rwEdit);
    
    }
     if($Flag =="Delete"){
        $crudUId=$_POST["crudUId"];
        $sql = "UPDATE tbldemocrud SET Status='Deleted' WHERE crudUId='$crudUId' ";
        if(mysqli_query($conn, $sql))
        {
            echo "Deleted Successfully";
        }
        else
        {
            echo "Failed To Delete - " . mysqli_error($conn);
        }
    }

?>