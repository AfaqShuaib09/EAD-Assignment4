<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "assignment2";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
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
        <title>Admin Product View</title>

        <link rel="stylesheet" type ="text/css" href="./css/adminProView.css" >
        <script src="./jquery/jquery_min.js" type="text/javascript"></script>
        <script>
         var deleted_id = -1;
        </script>
    </head>
    
    <body>
        <?php 
            $query = "SELECT p.ProductId, p.PicURL ,p.name,t.TypeName, p.Price, p.Description , p.IsActive, a.Name , 
            DATE_FORMAT(p.UpdatedOn, '%d-%b-%Y') as updated_date FROM product p join type t on p.TypeId = t.TypeId join admin a on p.UpdatedBy = a.AdminId"; 
            $sql =mysqli_query($conn, $query);
            $i = 0;
            while($row = mysqli_fetch_array($sql))
            {
                if($row['IsActive']==1){
                    if($i%4==0){
                        if ($i==0){
                            echo '<div class="container">';
                        }
                        else {
                            echo('</div>');
                            echo'<div class="container">';
                        }
                        
                    }
                    echo ("<div class='item text_color_blue' id='p_{$row['ProductId']}'>");
                    echo "<img src='img/{$row['PicURL']}' class='item_img' width='150px' height='150px'/>";
                    echo "<p class='product_name'>{$row['name']}</p>";
                    echo "<p class= 'pro_type'>Type: {$row['TypeName']}</p>";
                    echo "<p class='price'>Price: {$row['Price']}</p>";
                    echo "<p class='desc'>Description: {$row['Description']}<p>";
                    echo "<p class='admin'>Updated by: {$row['Name']}<p>";
                    echo "<p class='updated_time'>Updated on: {$row['updated_date']} <p>";
                    echo "<button class='btnDelete green_color' id='delete_{$row['ProductId']}'> Delete</button>";
                    echo "<button class='orange_color btnEdit' id='edit_{$row['ProductId']}' style='margin-left:5px'>Edit</button>";
                    echo '</div>';
                    $i=$i+1;
                }
            }
            if($i%4!=1)
            {
                echo '</div>';
            }
        ?>
        <?php
            
            function delete_product($id) {
                $sql = "update product set isActive=0 where ProductId =$id";
                if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
                } else {
                echo "Error updating record: " . $conn->error;
                }
            }
        ?>
        <script>
            var button = document.getElementsByClassName("btnDelete");
            for(let i=0;i<button.length;i++)
            {
                button[i].onclick = function() {
                    var div =$(this).closest('div');
                    var id = parseInt(div.attr("id").slice(2));
                    var deleted_id = id;
                    console.log(id);
                };
            }
        </script>
    </body>
</html>