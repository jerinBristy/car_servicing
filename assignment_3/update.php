<?php
    require_once('config/config.php');
    require_once('config/db.php');
    
    if(isset($_POST['submit'])){
		// Get form data
		$update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
		$date = mysqli_real_escape_string($conn, $_POST['appointmentDate']);
		$mechanic = mysqli_real_escape_string($conn, $_POST['mechanic']);
		//echo $update_id;
		$query1 = "UPDATE clientsinfo 
                SET appointmentDate='$date',
                    mechanic='$mechanic'
						WHERE id = '$update_id' ";
        //echo $query;
		if(mysqli_query($conn, $query1)){
			header('Location: adminlogin.php');
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
	}
    //get id
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = 'SELECT * FROM clientsinfo WHERE id = '.$id;
    // Get Result
    //echo $query;
	$result = mysqli_query($conn, $query);

	// Fetch Data
	$key = mysqli_fetch_assoc($result);
	//var_dump($posts);

	// Free Result
	mysqli_free_result($result);

	// Close Connection
	mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="container">
        
        <h2>Update!</h2> 
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" >
            <div class="form-group">
                <label>Name<span class="required">*</span></label><br>
                <input type="text" name="name" class="form-control" autocomplete="off" value="<?php echo $key['name']; ?>">
                
            </div>
            <div class="form-group">
                <label>Address<span class="required">*</span></label><br>
                <input type="text" name="address" class="form-control" value="<?php echo $key['address']; ?>">
                
            </div>
            <div class="form-group">
                <label>Phone<span class="required">*</span></label><br>
                <input type="text" name="phone" class="form-control" value="<?php echo $key['phone']; ?>">
                
            </div>
            <div class="form-group">
                <label>Car License Number <span class="required">*</span></label><br>
                <input type="text" name="licenseNumber" class="form-control" value="<?php echo $key['licenseNumber']; ?>">
            </div>
            <div class="form-group">
                <label>Car Engine Number<span class="required">*</span></label><br>
                <input type="text" name="engineNumber" class="form-control" value="<?php echo $key['engineNumber']; ?>">
            </div>
            <div class="form-group">
                <label>Appointment Date<span class="required">*</span></label><br>
                <input type="text" name="appointmentDate" class="form-control" value="<?php echo $key['appointmentDate']; ?>">
            </div>

            <div class="form-group">
                <label>Mechanic<span class="required">*</span></label><br>
                <input type="text" name="mechanic" class="form-control" value="<?php echo $key['mechanic']; ?>">
            </div>

            <input type="hidden" name="update_id" value="<?php echo $key['id']; ?>">
            <div class="">
                <input type="submit" name="submit" value="Submit" class="btn-form" >
            </div>
        </form>
       
    </div>
</body>
</html>