<?php 
	session_start();
 if(isset($_POST['submit'])){
 logout();
 }
 
 function logout(){
 session_destroy();

	header('location:index.php');
	exit;
 }
	

	
?>

<!DOCTYPE html>
<html>
<body>
    <div>
        <h1>Quiz Welcome Page</h1>
       <?php if(isset($_SESSION['password']))
			{
				echo "<div>";
				echo "Password is ";
				echo $_SESSION['password'];
				echo "</div>";
			
echo '<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">';
                     echo "<div>";
                     echo '<button type="submit" name="submit">Logout</button>';
                       echo "</div>";
                       }
               ?>
	
    </div>
    
</body>
</html>
