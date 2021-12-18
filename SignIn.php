<?php require('conn.php'); ?>

<?php 
    session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.3/css/unicons.css">
    <link rel="stylesheet" href="./css/signIn_style.css">
    <title>Sign In: Product Entry</title>
    <script src="./jquery/jquery_min.js"> </script>
    <script type="text/javascript">
		
		$(document).ready(function(){
			
			$("#btnSubmit").click(function(){
				
				var user = $("#login").val();
				var password = $("#pswd").val();
				var flag = true;
				
				if(user == ""){
					flag = false;
					alert("User Name is mandatory!");
				}
				if(password == ""){
					flag = false;
					alert("Password is mandatory!");
				}
				return flag;
			});
		});
	</script>
</head>
<body>
    
    <div class="container">
        <div class=head>
            <i class="uil uil-padlock"></i>
            <span>Sign In</span>
        </div>

    <?php
        $error = "";
        $uname = "";

        if(isset($_REQUEST["btnSubmit"])){
            
            $uname = $_REQUEST["login"];
            $pswd = $_REQUEST["pswd"];
            
            $sql = "Select * from admin where Login='$uname' and Password='$pswd'";
            
        $result = mysqli_query($conn, $sql);
        
        $recordsFound = mysqli_num_rows($result);
        if($recordsFound == 1)
        {
            $row = mysqli_fetch_assoc($result); 
            $_SESSION['user']=$uname;
            $_SESSION["userid"] = $row["AdminId"];
            header('Location: AdminProductView.php');
        }
        else {
            $error =  "Invalid User Name or Password";
            
        }
    }
    ?>
      <div class="body">
            <form action="SignIn.php" method="GET">
                <label for="login" id="login_label">Login </label><br>
                <input type="text" id="login" name="login" placeholder="Login....."><br><br>
                <label for="pswd" id="pswd_label">Password:</label><br>
                <input type="password" id="pswd" name="pswd" placeholder="Password....."><br><br>
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Sign In" align="center">
            </form>
        </div>
        <br><br>
        <?php echo'<div class="error" style="color:red;" >' .$error. '</div>' ?>
       
    </div>
</body>
</html>