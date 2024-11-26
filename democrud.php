<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Crud Operation</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"  />
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.css" />
   <!-- <style>
        /* Add background image to the entire page */
        .card {
           
            background-image:url("images/rgba.jpg"); 
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style> -->
    
    
<body>
<section>
 <div class="container">

     <div class="card">
	    <div class="card-body">
	         <div class="page-title-div">  
				<h4><strong><mark><ins>Enter Your Details Here...</ins></mark></strong></h4>
			 </div>
			
			<form id="Frmcrudoperation" method="post">
				<div class="row">
				    <div class="col-md-4 col-lg-4 col-12">
					<input type="hidden" id="crudUId" name="crudUId"/>
						<div class="form-group">
							<label for="txtName" class="form-label">Enter Name*</label>
							<input type="text" id="txtName" name="txtName" class="form-control" placeholder="Enter Your Name" required>
					    </div>
                        <br>
                        <div class="form-group">
                            <label for="txtName" class="form-label">Email*</label>
						    <input type="email" id="txtEmail" name="txtEmail" class="form-control" placeholder="Enter Your Email" required>
						</div>
                        <br>
						<div class="form-
                        group">
							<label for="txtMobileNumber" class="form-label">Enter Mobile Number*</label>
							<input type="text" id="txtMobileNumber" name="txtMobileNumber" class="form-control" placeholder="Enter Your Mobile Number" minlength maxlength="10" required>
						</div>
                        <br> 
                        <div class="form-group">
                            <label for="dateofbirth">date of birth</label>
                            <input type="date" id="date" name="dateofbirth" class="form-control" required/>
                        </div>
                        <br>
                        <div class="form-check">
                            <label for="selectsubjects">
                            <label for="checkbox">select subjects</label><br>
                             <input type="checkbox" name="selectsubjects" value="C" class="selectsubjects-checkbox"> C
                            <br>
                             <input type="checkbox" name="selectsubjects" value="CPP" class="selectsubjects-checkbox"> CPP
                            <br>
                             <input type="checkbox" name="selectsubjects" value="Java" class="selectsubjects-checkbox"> Java
                            <br>
                             <input type="checkbox" name="selectsubjects" value="Python" class="selectsubjects-checkbox"> Python
                            <br>
                            <input type="checkbox" name="selectsubjects" value="PHP" class="selectsubjects-checkbox"> PHP
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="">Gender:</label> <br>
                            <input type="radio" name="gender" value="Male" /> Male
                            <input type="radio" name="gender" value="Female" /> Female
                        </div>
                        <br>
						<div class="form-group">
							<label for="txtAddress" class="form-label">Enter Address*</label>
							<input type="text" id="txtAddress" name="txtAddress" class="form-control" placeholder="Enter Your Address" required>
						</div>
                        <br>
                        <div class="col-md-8 col-lg-8 col-12">
						<div class="d-md-flex justify-content-md-start Btnsuccess">
							<input type="submit" id="submit" class="btn btn-success btn-lg " value="Save">      
						</div>
					</div>
				</div>
			</form> 	 
		</div> 
	</div>   
	 
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
    Showrecord();

    // Handle "selectsubjects" functionality
    $('#selectsubjects').change(function() {
        var isChecked = $(this).prop('checked');
        $('.selectsubjects-checkbox').prop('checked', isChecked);
    });

    // Handle individual checkbox changes (optional, for "Select None" functionality)
    $('.selectsubjects-checkbox').change(function() {
        var allChecked = $('.selectsubjects-checkbox').length === $('.selectsubjects-checkbox:checked').length;
        $('#selectsubjects').prop('checked', allChecked);
    });
});
$(document).ready(function() {
    Showrecord();
    // Initialize form validation
    $("#Frmcrudoperation").validate({
        rules: {
            txtName: "required",
            txtEmail: {
                required: true,
                email: true
            },
            txtMobileNumber: {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            dateofbirth: "required",
            selectsubjects:"required",
            txtAddress: "required",
            gender: "required"
        },
        messages: {
            txtName: "Please enter your name",
            txtEmail: "Please enter a valid email address",
            txtMobileNumber: {
                required: "Please enter your mobile number",
                minlength: "Mobile number must be 10 digits",
                maxlength: "Mobile number must be 10 digits"
            },
            dateofbirth: "Please enter your date of birth",
            selectsubjects: "Please enter your select subjects",
            txtAddress: "Please enter your address",
            gender: "Please select your gender"
        },
        submitHandler: function(form,e) {
            e.preventDefault();
            var formData = new FormData(form);
            formData.append("Flag", "Save");

            $.ajax({
                url: "democrudoperation.php",
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
                    alert('An error occurred: ' + textStatus + ' - ' + errorThrown);
                }
            });
        }
    });
})  

function Showrecord(){
	$.post("democrudoperation.php",{
		Flag:"GetRecords"
	},function(data, success){
	  $("#TableRecords").html(data);
	  $("#tbldemocrud").DataTable();
	});
}

function Editrecord(crudUId){
	$.post("democrudOperation.php",{
		Flag:"editrecord",
		crudUId:crudUId
	},function(data){
		console.log(data);
        var json = JSON.parse(data);
        console.log(json);
		$("#crudUId").val(json.crudUId);
		$("#txtName").val(json.Name);
        $("#txtEmail").val(json.Email);
        $("#txtMobileNumber").val(json.MobileNumber);
        $("#date").val(json.date);
        $("#selectsubjects").val(json.selectsubjects);
        $("#gender").val(json.gender);
        $("#txtAddress").val(json.Address);
		$("#submit").val("Update");
        Showrecord();
	});		
}

function Deleterecord(crudUId) {
    // Confirm dialog
    var isConfirmed = confirm('Do you want to delete details?');

    if (isConfirmed) {
        $.post("democrudoperation.php", {
            Flag: "Delete",
            crudUId: crudUId
        }, function(data) {
            alert('Deleted! ' + data);
            ShowcrudUId(); 
        }).fail(function(jqXHR, textStatus, errorThrown) {
            alert('Error: ' + textStatus + ' - ' + errorThrown);
        });
    }
}


function ResetData(){
	    $("#crudUId").val("");
	    $("#txtName").val("");
        $("#txtEmail").val("");
	    $("#txtMobileNumber").val("");
        $("#txtdate").val("");
        $("#txtselectthesubjects").val("");
        $("#txtgender").val("");
        $("#txtAddress").val("");
}   
   
</script>
</head>
</body>
</html>