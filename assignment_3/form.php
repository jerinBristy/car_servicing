<?php
	require_once('config/config.php');
    require_once('config/db.php');
    
    $emptyerror="";
    $validError="";
    $mechanicerror="";
    $success="";
    $name="";
    $address="";
    $phone="";
    $licenseNumber="";
    $engineNumber="";
    $appointmentDate="";
    $query="";
    $mechanic="";
    $mechanicCount="";
    $mechanicCountResult="";
    $booked_mechanic1_result=0;
    $booked_mechanic2_result=0;
    $booked_mechanic3_result=0;
    $booked_mechanic4_result=0;

    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
       	// Check for empty field error
        $name =check_error($_POST['name']);
        $address =check_error($_POST['address']);
        $phone =check_error($_POST['phone']);
        $licenseNumber =check_error($_POST['licenseNumber']);
        $engineNumber =check_error($_POST['engineNumber']);
        $appointmentDate =check_error($_POST['appointmentDate']);

        //-----check for valid int
       
        if(!is_numeric($phone)){
            $validError="Invalid Number!";
        }
        if(!is_numeric($engineNumber)){
            $validError="Invalid Number!";
        }

        
        //for mechanic

        $mechanic = mysqli_real_escape_string($conn,$_POST['mechanic']);
        $mechanic_count_query="SELECT * FROM clientsinfo WHERE mechanic='$mechanic' AND appointmentDate='$appointmentDate'";
        $mechanicCountResult= mysqli_query($conn,$mechanic_count_query);
        $mechanicCount= mysqli_fetch_all($mechanicCountResult,MYSQLI_ASSOC);
        //var_dump($mechanicCount);
        if(mysqli_num_rows($mechanicCountResult)>=4){
            $mechanicerror="Selected Mechanic is not available";
        }

        //mechanic availability 

        $booked_mechanic1_query="SELECT * FROM clientsinfo WHERE mechanic='Mechanic1' AND appointmentDate='$appointmentDate'";
        $booked_mechanic1_result= mysqli_num_rows(mysqli_query($conn,$booked_mechanic1_query));

        $booked_mechanic2_query="SELECT * FROM clientsinfo WHERE mechanic='Mechanic2' AND appointmentDate='$appointmentDate'";
        $booked_mechanic2_result= mysqli_num_rows(mysqli_query($conn,$booked_mechanic2_query));

        $booked_mechanic3_query="SELECT * FROM clientsinfo WHERE mechanic='Mechanic3' AND appointmentDate='$appointmentDate'";
        $booked_mechanic3_result= mysqli_num_rows(mysqli_query($conn,$booked_mechanic3_query));

        $booked_mechanic4_query="SELECT * FROM clientsinfo WHERE mechanic='Mechanic4' AND appointmentDate='$appointmentDate'";
        $booked_mechanic4_result= mysqli_num_rows(mysqli_query($conn,$booked_mechanic4_query));
        

        // insert into db
        
        
        if(empty($emptyerror) && empty($validError) &&empty($mechanicerror))
        {
            $query = "INSERT INTO clientsinfo(name,address,phone,licenseNumber,engineNumber,appointmentDate,mechanic ) 
            VALUES('$name', '$address', '$phone', '$licenseNumber','$engineNumber','$appointmentDate','$mechanic')"; 
               if(mysqli_query($conn, $query)){
                    $success="success";
                    header('Location: successfullogin.php');
             } else {
                 echo 'ERROR: '. mysqli_error($conn);
             }    
        } 
         
    }


    
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function check_error($data) {
        if(empty($data)){
            global $emptyerror;
            $emptyerror="Please fill in the required fields!";
            $data="";
            return $data;
        }   
        else {
            $data =test_input($data);
            return $data;
        }
    }
    mysqli_close($conn);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Appointment</title>
</head>
<body>
    <div class="container">
        
        <h2>Get an appointment!</h2> 
        <p><?php echo $emptyerror; ?></p> 
        <p><?php echo $validError; ?></p> 
        
        
        <p><?php echo $mechanicerror; ?></p>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" >
            <div class="form-group">
                <label>Name<span class="required">*</span></label><br>
                <input type="text" name="name" class="form-control" autocomplete="off" value="<?php echo $name; ?>">
                
            </div>
            <div class="form-group">
                <label>Address<span class="required">*</span></label><br>
                <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                
            </div>
            <div class="form-group">
                <label>Phone<span class="required">*</span></label><br>
                <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                
            </div>
            <div class="form-group">
                <label>Car License Number <span class="required">*</span></label><br>
                <input type="text" name="licenseNumber" class="form-control" value="<?php echo $licenseNumber; ?>">
            </div>
            <div class="form-group">
                <label>Car Engine Number<span class="required">*</span></label><br>
                <input type="text" name="engineNumber" class="form-control" value="<?php echo $engineNumber; ?>">
            </div>
            <div class="form-group">
                <label>Appointment Date<span class="required">*</span></label><br>
                <input type="date" name="appointmentDate" class="form-control" value="<?php echo $appointmentDate; ?>">
            </div>
            <div class="form-group">
                <select name="mechanic" >
                    <option value="Mechanic1">Mechanic1 <?php echo 4-$booked_mechanic1_result ?></option>
                    <option value="Mechanic2">Mechanic2 <?php echo 4-$booked_mechanic2_result ?></option>
                    <option value="Mechanic3">Mechanic3 <?php echo 4-$booked_mechanic3_result ?></option>
                    <option value="Mechanic4">Mechanic4 <?php echo 4-$booked_mechanic4_result ?></option>
                </select>
                    
            </div>
            
            <div class="">
                <input type="submit" name="submit" value="Submit" class="btn-form" >
            </div>
        </form>
       
    </div>
    
</body>
</html>