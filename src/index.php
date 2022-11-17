<?php
    if(isset($_POST['submit'])){
        if((isset($_POST['input_a']) && $_POST['input_a'] != '') && (isset($_POST['input_b']) && $_POST['input_b'] != '')){
            // User Input
            
            $input_a = $_POST['input_a'];
            $input_b = $_POST['input_b'];
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
                                <label>Input A</label>
                                <input type="text" name="input_a">
                        </div>
                        <div>
                                <label>Input B</label>
                                <input type="text" name="input_b">
                        </div>
                        <div>
                                <button type="submit" name="submit">Submit</button>
                        </div>
                </form>
    </div>
    <div>
        <h1>USER OUTPUT FORM</h1>
        <p>Input A Output: <?php echo $input_a; ?></p>
        <p>Input B Output: <?php echo $input_b; ?></p>
    </div>
</body>
</html>

