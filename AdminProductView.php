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
                    echo "<button class='orange_color btnEdit' id='edit_{$row['ProductId']}' style='margin-left:5px'>
                    <a href='EditProduct.php?pid={$row['ProductId']}' style='text-decoration: none; color: white;'>Edit</a></button>";
                    echo '</div>';
                    $i=$i+1;
                }
            }
            if($i%4!=1)
            {
                echo '</div>';
            }
        ?>
        <script>
            var button = document.getElementsByClassName("btnDelete");
            for(let i=0;i<button.length;i++)
            {
                button[i].onclick = function() {
                    var div =$(this).closest("div");
                    var id = parseInt(div.attr("id").slice(2));
                    var deleted_id = id;
                    console.log(id);
                
                    //object to pass as parameter
                    var data = {"action": "updateActiveStatus","id":id};
                    
                    //object pass to $.ajax function to make an AJAX call.
                    var settings= {
                        type: "POST",
                        dataType: "json",
                        url: "api.php",
                        data: data,
                        success: function(response) {
                            //response.data contains whatever is sent from server
                            if(response.data == true){
                                alert("Record is updated");
                                window.location.href = "AdminProductView.php";
                            }
                            else {
                                alert("unable to update");
                            }
                        },
                        error: function (err, type, httpStatus) {
                            alert('error has occured');
                        }
                    };
                    
                    $.ajax(settings);
                    console.log('request sent');
                    return false;			
                };//end of change
            }
        </script>
        <!-- <script>
            var button = document.getElementsByClassName("btnEdit");
            console.log(button);
            for(let i=0;i<button.length;i++)
            {
                button[i].onclick = function() {
                    var div =$(this).closest("div");
                    var id = parseInt(div.attr("id").slice(2));
                    console.log(id);
                    var data = {"action": "editProduct","id": id};

                    var settings= {
                        type: "POST",
                        dataType: "json",
                        url: "api.php",
                        data: data,
                        success: function(response) {
                            if(response.data == true){
                                alert("Record is updated");
                                window.location.href = "EditProduct.php";
                            }
                            else {
                                alert("unable to Edit");
                            }
                        },
                        error: function (err, type, httpStatus) {
                            alert('error has occured');
                        }
                    };
                    $.ajax(settings);
                    console.log('request sent');
                    return false;		
                }
            }          
        </script> -->
        
    </body>
</html>