<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.0/sweetalert2.css"/>
	<link rel="stylesheet" href="css/style.css">
	<title>Upload Images</title>
</head>
<body>
    <section>
	    <div class="container">
			<div class="card">
				<div class="card-body">
					<h3>Upload Images</h3>
					<form action="ChooseImageOperations.php" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-6 p-4">
							<label for="file" class="form-label">Select Image</label><br>
							<input type="file" id ="file" name="file" class="form-control" required>
						</div>
					</div>
					<!--<div class="row">
						<div class="col-6 p-4">
							<label for="width" class="form-label">Width</label><br>
							<input type="text" id ="Width" name="Width" class="form-control"  >
						</div>
						<div class="col-6 p-4">
							<label for="Height" class="form-label">Height</label><br>
							<input type="text" id ="Height" name="Height" class="form-control"  >
						</div>
					</div>-->
						<br><br>
						<button type="submit" class="btn btn-primary">Upload Images</button>
					</form>
				</div>	
		    </div>
		</div>
    </section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.0/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!--<script>
$(document).ready(function() {
	 submitHandler: function(form,e) {
            e.preventDefault();
            var formData = new FormData(form);
            formData.append("Flag", "Save");

            $.ajax({
                url: "ChooseImageOperations.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
					if (data =="Inserted Successfully") {
                        ShowPopupMessage("Inserted Successfully","success");
                        ResetData();
		});
	});
});

    Swal.fire({
        icon: 'error',
        title: 'Invalid File Type',
        text: 'Sorry, only JPG, JPEG, and PNG images are allowed.',
        confirmButtonText: 'OK'
	});
	function ShowPopupMessage(title,icon){
		Swal.fire(title,"",icon);
	} 
    
</script>-->
</body>
</html>