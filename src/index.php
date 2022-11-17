<?php

session_start();
    if(isset($_POST['submit'])){
    
        if((isset($_POST['password']) && $_POST['password'] != '')){
            // User Input
           $password = $_POST['password'];
            
            $errorMsg = checkPassword($password);
        }
    }
    
    function checkPassword($password){
    $filename = "top-1000.txt";
   
$lines = explode("\n", file_get_contents($filename));

foreach ($lines as $value) {
  if (str_contains($password, $value)) { 
	header("location: index.php");
  }
}

 if(strlen($password) <= 10){
   
     header("location: index.php");
     die();

 }else{
  $_SESSION['password'] = $password;
  header("location: welcome.php");
  }
}

?>

<!DOCTYPE html>
<html>
<body>
    <div>
        <h1>Quiz Login Page</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                       
                        <div>
                                <label>Enter a password</label>
                                <input type="text" name="password">
                        </div>
                       
                        <div>
                                <button type="submit" name="submit">Submit</button>
                        </div>
                </form>
                
                <div>
                  <?php echo $errorMsg; ?>
                </div>
                
                
    </div>
    
</body>
</html>

