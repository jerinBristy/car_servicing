<?php
	require_once('config/config.php');
    require_once('config/db.php');
 
 

    $query='SELECT * FROM clientsinfo ORDER BY id DESC';
    $result= mysqli_query($conn,$query);
    $keys= mysqli_fetch_all($result,MYSQLI_ASSOC);
    //var_dump($keys);

    //----------delete------------------
    if(isset($_POST['delete'])){
		// Get form data
		$delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

		$query = "DELETE FROM clientsinfo WHERE id = {$delete_id}";

		if(mysqli_query($conn, $query)){
			header('Location: adminlogin.php');
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
	}
    

    
    

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Documtent</title>
    </head>
    <body>
        <form action="<?php $_SERVER['PHP_SELF']; ?>"  method="POST">
            <div class="tableformat">
                <h2>Appointment Schedule</h2>
                
               <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Mechanic</th>
                            <th>Clients name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>license Number</th>
                            <th>engine Number</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <?php foreach ($keys as $key) : ?>
                    
                   
                        <tr>
                            <td><?php echo $key['appointmentDate']; ?></td>
                            <td><?php echo $key['mechanic']; ?></td>
                            <td><?php echo $key['name']; ?></td>
                            <td><?php echo $key['address']; ?></td>
                            <td><?php echo $key['phone']; ?></td>
                            <td><?php echo $key['licenseNumber']; ?></td>
                            <td><?php echo $key['engineNumber']; ?></td>
                            <td><a href="update.php?id=<?php echo $key['id'];?>"  class="update">Edit</a></td>
                            <td><form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="hidden" name="delete_id" value="<?php echo $key['id']; ?>">
                                <input type="submit" name="delete" value="Delete" class="btn-delete">
                            </form></td>
                        
                        
                        </tr>
                    <?php endforeach; ?> 
                </table>
                
            </div>
        </form>
    </body>
</html>