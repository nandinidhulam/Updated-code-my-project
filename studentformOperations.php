<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once("db_student.php");
 
$Flag = $_POST["Flag"];
 
if($Flag == "Save"){
	$UId = $_POST["UId"];
	$FirstName = $_POST["FirstName"]; 
    $MiddleName = $_POST["MiddleName"]; 
    $LastName = $_POST["LastName"]; 
    $date = date("Y-m-d", strtotime($_POST["DateofBirth"]));
    $Age = $_POST["Age"];
    $Gender  = $_POST["Gender"];
    $MobileNumber = $_POST["MobileNumber"]; 
    $AlternateMobileNumber = $_POST["AlternateMobileNumber"]; 
    $Email = $_POST["Email"]; 
    $Address = $_POST["Address"]; 


	if ($Flag == "Save") {
        if (empty($UId)) {
            $query = "INSERT INTO tblstudent (UId, FirstName, MiddleName, LastName, DateofBirth, Age, Gender, MobileNumber, AlternateMobileNumber,  Email, Address, Status) VALUES (UID(),'$FirstName', '$MiddleName', '$LastName', '$DateofBirth', '$Age', '$Gender', '$MobileNumber', '$AlternateMobileNumber', '$Email', '$Address', 'Active')";
            
            if ($conn->query($query) === TRUE) {
                echo "Add Successfully";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            $query = "UPDATE tblstudent SET FirstName = '$FirstName', MiddleName = '$MiddleName', LastName = '$LastName', DateofBirth = '$DateofBirth', Age ='$Age', Gender = '$Gender', MobileNumber = '$MobileNumber', AlternateMobileNumber = '$AlternateMobileNumber', Email = '$Email', Address = '$Address' WHERE UId = '$UId'";
            
            if ($conn->query($query) === TRUE) {
                echo "Update Successfully";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
    

}
    if($Flag == "GetRecords"){
		$sql = "SELECT * FROM tblstudent WHERE Status ='Active' ";
		$rstTableQuery = mysqli_query($conn, $sql);
		
		echo "<div class='table table-responsive'> <table class='table' id='tblstudent'><thead>";
		echo "<tr>
               
				<th>FirstName</th>
                <th>MiddleName</th>
                <th>LastName</th>
                <th>DateofBirth</th>
                <th>Age</th>
                <th>Gender</th>
                <th>MobileNumber</th>
                <th>AlternateMobileNumber</th>
                <th>Email</th>
                <th>Address</th>
				<th>Action</th>

			</tr></thead><tbody>";
			$srNo = 0;
			while($rwTableQuery = mysqli_fetch_assoc($rstTableQuery)){
                $srNo++;			 
                $UId = $rwTableQuery["UId"];
                $FirstName = $rwTableQuery["FirstName"];
                $MiddleName = $rwTableQuery["MiddleName"];
                $LastName = $rwTableQuery["LastName"];
                $DateofBirth = $rwTableQuery["DateofBirth"];
                $Age = $rwTableQuery["Age"];
                $Gender = $rwTableQuery["Gender"];
                $MobileNumber = $rwTableQuery["MobileNumber"];
                $AlternateMobileNumber = $rwTableQuery["AlternateMobileNumber"];
                $Email = $rwTableQuery["Email"];
                $Address = $rwTableQuery["Address"];
                 
			 
			echo "<tr>
                   
				<td>$FirstName</td>
                <td>$MiddleName</td>
                <td>$LastName</td>
                <td>$DateofBirth</td>
                <td>$Age</td>
                <td>$Gender</td>
                <td>$MobileNumber</td>
                <td>$AlternateMobileNumber</td>
                <td>$Email</td>
                <td>$Address</td>
                
				<td>                    
					<button type='button' class='btn btn-outline-warning btn-sm btnEdit' onclick='Editrecord(\"$UId\")'>Edit</i></button>
					<button type='button' class='btn btn-outline-danger btn-sm btnDelete' onclick='Deleterecord(\"$UId\")'>Delete</button>
				</td>
				   </tr>";
			 }
		echo "</tbody></table></div>";
        
	}

    if($Flag == "editrecord"){
        $UId=$_POST["UId"];
        $sql = "SELECT * FROM tblstudent WHERE UId='$UId' ";
        $rstEdit = mysqli_query($conn, $sql);
        $rwEdit = mysqli_fetch_array($rstEdit, MYSQLI_ASSOC);
        echo json_encode($rwEdit);
    
    }
     if($Flag =="Delete"){
        $UId=$_POST["UId"];
        $sql = "UPDATE tblstudent SET Status='Deleted' WHERE UId='$UId' ";
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