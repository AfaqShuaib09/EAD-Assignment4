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
    <link rel="stylesheet" href="./css/editProduct.css">
    <script src="./jquery/jquery_min.js" type="text/javascript"></script>
    <title>Edit Product: Product Entry</title>

    <script type="text/javascript">
		
		$(document).ready(function(){
			
			$("#btnEdit").click(function(){
				var pro_name = $("#name").val();
				var price = $('price').val();
                var type = $("#myselect option:selected" ).val();
                var desc = $("txtid").val();
                var file_name = $('input[type=file]').val();
				var flag = true;
				
				if(pro_name == ""|| price== "" || type== "" || desc==""){
					flag = false;
					alert("Necessary fields empty 😔");
				}
				return flag;
			});
		});        
	</script>
</head>
<body>

<?php 
    if(isset($_REQUEST['btnEdit']))
    {    
        $new_name="";
        if(isset($_FILES["myfile"]) && !empty($_FILES["myfile"]["name"]))
        {
            // Here 'userpic' is name of your 'file control'
            // explore will break the name by using '.' delimeter.
            $temp = explode(".", $_FILES["myfile"]["name"]);
            
            //Create a unique name by using time and append the actual extension
            $new_name = round(microtime(true)) . '.' . end($temp);
            
            //save file into "img" folder with the name stored '$new_name' variable
            move_uploaded_file($_FILES["myfile"]["tmp_name"], "img//".$new_name);  
        }

    }
?>
<?php 
    $msg = "";
    if(isset($_REQUEST["btnEdit"])){
        
        $product_name = $_REQUEST["name"];
        $pid =$_REQUEST['id'];
        $price = $_REQUEST["price"];
        $type = $_REQUEST["type_dd"];	
        $desc = $_REQUEST["txtname"];
        
        $img = $_FILES["myfile"];
        $AdminId = $_SESSION["userid"];
        if(isset($_FILES["myfile"]) && !empty($_FILES["myfile"]["name"]))
        {
            $sql ="update product set name= '$product_name', TypeId=$type, Price=$price, Description= '$desc', PicURL= '$new_name', UpdatedOn = SYSDATE(), UpdatedBy =$AdminId where ProductId=$pid";
        }
        else
        {
            $sql ="update product set name= '$product_name', TypeId=$type, Price=$price, Description= '$desc', UpdatedOn = SYSDATE(), UpdatedBy =$AdminId where ProductId=$pid";
        }
        
        if ($conn->query($sql) === TRUE) {
            $msg = "Product Added Successfully.";
        } else {
            $msg = "Some Problem occured"; 
        }
    }
?>

<?php
    if(isset($_REQUEST["pid"]) && $_REQUEST['pid']> 0){
        $pro_id = $_REQUEST["pid"];
        $query = "Select * from product where ProductId=$pro_id and isActive=1";
        $sql =mysqli_query($conn, $query);
        if ($row = mysqli_fetch_array($sql)){
            $pic = $row['PicURL'];
            $pName = $row['Name'];
            $TypeId = $row['TypeId'];
            $price = $row['Price'];
            $desc = $row['Description'];
        }
    }
    else{
        header("location: AdminHome.php");
    }
   

?>
    <div class="container">
        <div class=head>
            <i class="uil uil-padlock"></i>
            <span>Edit Product</span>
        </div>
        <div class="body">
            <form action="EditProduct.php" method="POST" enctype="multipart/form-data">
            <input type="text" id="id" name="id" value="<?php echo $pro_id ?>" hidden>
                <label for="name" id="name_label" >Name </label><br>
                <input type="text" id="mame" name="name"  placeholder="Name....." value="<?php echo $pName ?>"><br><br>
                <label for="price" id="price_label"> Price </label><br>
                <input type="text" id="price" name="price" placeholder="Price....." value="<?php echo $price ?>"><br><br>
                <label for="type" id="type_label"> Type Select </label><br>
                <select name="type_dd" id='type_dd' >
                    <option value=-1 disabled hidden>Select Type</option>
                    <?php 
				
                        $sql = "SELECT TypeId, TypeName from type";
                        $result = mysqli_query($conn, $sql);
                        $recordsFound = mysqli_num_rows($result);			
                        if ($recordsFound > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                            
                                $id = $row["TypeId"];
                                $name = $row["TypeName"];
                                if($id==$TypeId)
                                    echo "<option value='$id' selected>$name</option>";
                                else
                                    echo "<option value='$id'>$name</option>";
                            }
				        }				
				    ?>
                </select>
                <label for="desc" id="desc_label"> Description </label><br>
                <textarea id="txtid" name="txtname" rows="2" cols="43" placeholder="Description..." ><?php echo $desc ?> </textarea>
                <img src="img/<?php echo $pic; ?>" style="width:100px; height:100px"/><br>
                <label for="pic" id="pic_label"> Picture </label><br>
                <input type="file" id="myfile" name="myfile"><br><br>
                <input type="submit" value="Edit Product" name="btnEdit" id="btnEdit">
            </form>
        </div>
        <div class="footer">
            <footer id="footer">
                <a href="signout.php" class="right" id="logout"> <pre class="bg-orange">| </pre>Logout</a>
            </footer>
        </div>
    </div>
</body>
</html>