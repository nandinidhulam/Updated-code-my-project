<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Student Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"  />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    
</head> 
<style>
.danger {
  color: red;
  font-weight: bold;
}
</style>
<body>
<section>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form id="studentformOperations" method="post">
                    <input type="hidden" id="UId" name="UId"/>
                    <div class="row">
                        <div class="col-6 p-4">
                            <label for="FirstName" class="form-label">Enter First Name <span class="danger">*</span></label>
                            <input type="text" id="FirstName" name="FirstName" class="form-control" placeholder="Enter Your First Name" required>
                        </div>
                        
                        <div class="col-6 p-4">
                            <label for="MiddleName" class="form-label">Enter Middle Name <span class="danger">*</span></label>
                            <input type="text" id="MiddleName" name="MiddleName" class="form-control" placeholder="Enter Your Middle Name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 p-4">
                            <label for="LastName" class="form-label">Enter Last Name <span class="danger">*</span></label>
                            <input type="text" id="LastName" name="LastName" class="form-control" placeholder="Enter Your Last Name" required>
                        </div>

                        <div class="col-6 p-4">
                            <label for="DateofBirth">Date of Birth<span class="danger">*</span></label>
                            <input type="date" id="DateofBirth" name="DateofBirth" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">  
                        <div class="col-6 p-4">
                                <label for="Age" class="form-label">Age<span class="danger">*</span></label>
                                <input type="number" id="Age" name="Age" class="form-control" placeholder="Enter Your Age" required>
                            </div>     
                        <div class="col-6 p-4">
                            <label for="">Gender:<span class="danger">*</span></label><br>
                            <input type="radio" name="gender" value="male" /> Male
                            <input type="radio" name="gender" value="female" /> Female
                        </div>
                    </div>
                    <div class="row">       
                    <div class="col-6 p-4">
                            <label for="MobileNumber" class="form-label">Enter Mobile Number<span class="danger">*</span></label>
                            <input type="text" id="MobileNumber" name="MobileNumber" class="form-control" placeholder="Enter Your Mobile Number"  minlength="10"
                            maxlength="10" required>
                        </div>

                    <div class="col-6 p-4">
                            <label for="AlternateMobileNumber" class="form-label">Enter Alternate Mobile Number<span class="danger">*</span></label>
                            <input type="text" id="AlternateMobileNumber" name="AlternateMobileNumber" class="form-control" placeholder="Enter Alternate Mobile Number"  minlength="10"
                            maxlength="10" required>
                        </div>
                    </div>
                    <div class="row">       
                        <div class="col-6 p-4">
                            <label for="Email" class="form-label">Enter Email<span class="danger">*<span></label>
                            <input type="text" id="Email" name="Email" class="form-control" placeholder="Enter Your Email" required>
                        </div>

                        <div class="col-6 p-4">
                            <label for="Address" class="form-label">Enter Address<span class="danger">*</span></label>
                            <input type="text" id="Address" name="Address" class="form-control" placeholder="Enter Your Address" required>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-8 col-lg-8 col-12">
                        <div class="d-md-flex justify-content-md-start Btninfo">
                            <input type="submit" id="submit" class="btn btn-info btn-lg " value="Save">      
                        </div>
                    </div>
                </form> 	 
            </div> 
        </div>   
	 <br>
        <div class="card">
            <div class="card-body">
                <div class="page-title-div">  
                    <h4>Show List</h4>
                </div>
                <div id="TableRecords"></div>
            </div>
        </div>
    </div> 
</section>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function() {
    Showrecord();
        submitHandler: function(form,e) {
            e.preventDefault();
            var formData = new FormData(form);
            formData.append("Flag", "Save");

            $.ajax({
                url: "studentformOperations.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data =="Add Successfully") {
                        alert('Added! Successfully');
                        ResetData();
                        Showrecord();
                        
                    } else if (data =="Update Successfully") {
                        alert('Updated! Successfully');
                        ResetData();
                        Showrecord();

                    } else {
                        alert('Operation failed: ' + data);
                        ResetData();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('An error occurred:' + textStatus + ' - ' + errorThrown);
                }
            });
        }
    });
}); 

function Showrecord(){
	$.post("studentformOperations.php",{
		Flag:"GetRecords"
	},function(data, success){
	  $("#TableRecords").html(data);
	  $("#tblstudent").DataTable();
	});
}

function Editrecord(UId){
	$.post("studentformOperations.php",{
		Flag:"editrecord",
		UId:UId
	},function(data){
		console.log(data);
        var json = JSON.parse(data);
        console.log(json);
		$("#UId").val(json.UId);
		$("#FirstName").val(json.FirstName);
        $("#MiddleName").val(json.MiddleName);
        $("#LastName").val(json.LastName);
        $("#DateofBirth").val(json.DateofBirth);
        $("#Age").val(json.Age);
        $("#Gender").val(json.Gender);
        $("#MobileNumber").val(json.MobileNumber);
        $("#AlternateMobileNumber").val(json.AlternateMobileNumber);
        $("#Email").val(json.Email);
        $("#Address").val(json.Address);
		$("#submit").val("Update");
        Showrecord();
	});		
}

function Deleterecord(UId) {
    // Confirm dialog
    var isConfirmed = confirm('Do you want to delete details?');

    if (isConfirmed) {
        $.post("studentformOperations.php", {
            Flag: "Delete",
            UId:UId
        }, function(data) {
            alert('Deleted! ' + data);
            ShowUId(); 
        }).fail(function(jqXHR, textStatus, errorThrown) {
            alert('Error: ' + textStatus + ' - ' + errorThrown);
        });
    }
}


function ResetData(){
	    $("#UId").val("");
	    $("#FirstName ").val("");
        $("#MiddleName").val("");
	    $("#LastName").val("");
        $("#DateofBirth").val("");
        $("#Age").val("");
        $("#Gender").val("");
        $("#MobileNumber").val("");
        $("#AlternateMobileNumber").val("");
        $("#Email").val("");
        $("#Address").val("");
}   
   
</script>

</body>
</html>