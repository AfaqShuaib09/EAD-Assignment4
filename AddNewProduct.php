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
    <link rel="stylesheet" href="./css/addProduct.css">
    <title>Add Product: Product Entry</title>
    <script src="./jquery/jquery_min.js"> </script>
    <script type="text/javascript">
		
		$(document).ready(function(){
			
			$("#btnSignUp").click(function(){
				var pro_name = $("#name").val();
				var price = $('price').val();
                var type = $("#myselect option:selected" ).val();
                var desc = $("txtid").val();
                var file_name = $('input[type=file]').val();
				var flag = true;
				
				if(pro_name == ""|| price== "" || type== "" || desc=="" || file_name==""){
					flag = false;
					alert("Necessary fields empty 😔");
				}
				return flag;
			});
		});

        function goToSignIn(){
            $_SESSION['user'] = null;
            $_SESSION["userid"] = null;
            window.location.href = "./SignIn.php";
       }
	</script>
</head>
<body>

<?php 
    if(isset($_REQUEST['btnAdd']))
    {    
        // Here 'userpic' is name of your 'file control'
        // explore will break the name by using '.' delimeter.
        $temp = explode(".", $_FILES["myfile"]["name"]);
        
        //Create a unique name by using time and append the actual extension
        $new_name = round(microtime(true)) . '.' . end($temp);
        
        //save file into "img" folder with the name stored '$new_name' variable
        move_uploaded_file($_FILES["myfile"]["tmp_name"], "img//".$new_name);

    }

?>
    <div class="container">
        <div class=head>
            <i class="uil uil-padlock"></i>
            <span>Add Product</span>
        </div>

        <?php 
            $msg = "";
            if(isset($_REQUEST["btnAdd"])){
                        
                $product_name = $_REQUEST["name"];
                $price = $_REQUEST["price"];
                $type = $_REQUEST["type_dd"];	
                $desc = $_REQUEST["txtname"];
                $img = $_FILES["myfile"];
                $AdminId = $_SESSION["userid"];
                $sql = "INSERT INTO product (Name, TypeId, Price, Description, PicURL, UpdatedOn, UpdatedBy) VALUES ('$product_name',$type,$price,'$desc','$new_name',SYSDATE(),$AdminId)";
                if ($conn->query($sql) === TRUE) {
                    $msg = "Product Added Successfully.";
                } else {
                    $msg = "Some Problem occured"; 
                }
            }
        ?>
        <div class="body">
            <form action="AddNewProduct.php" method="POST" enctype="multipart/form-data">
                <label for="name" id="name_label">Name </label><br>
                <input type="text" id="name" name="name" placeholder="Name....."><br><br>
                <label for="price" id="price_label"> Price </label><br>
                <input type="text" id="price" name="price" placeholder="Price....."><br><br>
                <label for="type" id="type_label"> Type Select </label><br>
                <select id='type_dd' name="type_dd">
                    <option value=-1 selected disabled hidden>Select Type</option>
                    <?php 
				
                        $sql = "SELECT TypeId, TypeName from type";
                        $result = mysqli_query($conn, $sql);
                        $recordsFound = mysqli_num_rows($result);			
                        if ($recordsFound > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                            
                                $id = $row["TypeId"];
                                $name = $row["TypeName"];
                                echo "<option value='$id'>$name</option>";
                            }
				        }				
				    ?>
                </select>
                <label for="desc" id="desc_label"> Description </label><br>
                <textarea id="txtid" name="txtname" rows="2" cols="43" placeholder="Describe yourself here..."></textarea>
                <label for="pic" id="pic_label"> Picture </label><br>
                <input type="file" id="myfile" name="myfile" accept=".png, .jpg, .jpeg"/><br><br>
                <input type="submit" value="Add Product" id="btnAdd" name="btnAdd">
            </form>
        </div>
        <div class="footer">
            <footer id="footer">
                <a href="#" class="right" id="logout" onclick="goToSignIn()"> <pre class="bg-orange">| </pre>Logout</a>
            </footer>
        </div>
        <br><br>
        <?php echo'<div class="error" style="color:red;" >' .$msg. '</div>' ; ?>
    </div>
</body>
</html>