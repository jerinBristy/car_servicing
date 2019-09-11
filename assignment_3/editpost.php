<?php

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
                    <option value="Mechanic1">MechanicA</option>
                    <option value="Mechanic2">MechanicB</option>
                    <option value="Mechanic3">MechanicC</option>
                    <option value="Mechanic4">MechanicD</option>
                </select>
                    
            </div>
            
            <div class="">
                <input type="submit" name="submit" value="Submit" class="btn-form" >
            </div>
        </form>
</body>
</html>