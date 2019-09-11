<?php
	require_once('config/config.php');
    require_once('config/db.php');
    //session_start();
   
    if(isset($_POST['submit'])){
        
        // Get form data
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        //fetching the value
        $query ='SELECT * FROM admin';
        $result= mysqli_query($conn,$query);
        $keys= mysqli_fetch_assoc($result);
        //var_dump($keys);
        if($keys['username']==$username && $keys['password']==$password )
        {
            
            session_start();
            header('Location: adminlogin.php');
            exit();
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
    <title>Document</title>
</head>
<body>
<div class="container">
        <h2>Please login!</h2>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" >
            <div class="form-group">
                <label>Username</label><br>
                <input type="text" name="username" class="form-control" >
                
            </div>
            <div class="form-group">
                <label>Password</label><br>
                <input type="password" name="password" class="form-control">
                

            <div class="">
                <input type="submit" name="submit" value="Submit" class="btn-form">
            </div>
        </form>
    </div>
</body>
</html>