<?php 
    require('conn.php'); 
?>
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
    <link rel="stylesheet" href="./css/signUp_style.css">
    <title>Sign Up: Product Entry</title>
    <script src="./jquery/jquery_min.js"> </script>
    <script type="text/javascript">
		
		$(document).ready(function(){
			
			$("#btnSignUp").click(function(){
				var name = $("#name").val();
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
                if(name == "") {
                    flag = false;
					alert("Name is mandatory!");
                }
				return flag;
			});
		});
	</script>
</head>
<body>
    <?php 
        $msg = "";
        if(isset($_REQUEST["btnSignUp"])){
            
            $name = $_REQUEST["name"];
            $login = $_REQUEST["login"];
            $password = $_REQUEST["password"];	
            
            $sql = "Insert into admin (Name, Login,Password) VALUES ('$name','$login','$password')";

            if (mysqli_query($conn, $sql) === TRUE) {
                $last_id = mysqli_insert_id($conn);
                $msg = "You are registered successfully.";
                header('Location: SignIn.php');
            } else {
                $msg = "Some Problem has occurred";
            }

        }
    ?>
    <div class="container">
        <div class=head>
            <i class="uil uil-padlock"></i>
            <span>Sign Up</span>
        </div>
        <div class="body">
            <form action="SignUp.php" method="POST">
                <label for="login" id="name_label">Name </label><br>
                <input type="text" id="name" name="name" placeholder="Name....."><br><br>
                <label for="pswd" id="pswd_label">Password </label><br>
                <input type="password" id="pswd" name="password" placeholder="Password....."><br><br>
                <label for="login" id="login_label"> Login </label><br>
                <input type="text" id="login" name="login" placeholder="Login....."><br><br>
                <input type="submit" value="Sign Up" id="btnSignUp" name="btnSignUp">
                
            </form>
        </div>
        <br><br>
        <?php echo'<div class="error" style="color:red;" >' .$msg. '</div>' ; ?>
    </div>
</body>
</html>