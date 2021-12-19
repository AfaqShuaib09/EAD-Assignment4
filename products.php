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
    <title>Product Items</title>

    <link rel="stylesheet" type ="text/css" href="./css/style.css" >
    <script src="./jquery/jquery_min.js" type="text/javascript"></script>
</head>
<body>
    <?php 
        $query = "SELECT p.PicURL ,p.name,t.TypeName, p.Price, p.Description, p.isActive FROM product p join type t on p.TypeId = t.TypeId"; 
        $sql =mysqli_query($conn, $query);
        $i = 0;
        while($row = mysqli_fetch_array($sql))
        {
            if($row['isActive']==1){
                if($i%4==0){
                    if ($i==0){
                        echo ('<div class="item-box container">'); 
                    }
                    else {
                        echo('</div>');
                        echo ('<div class="item-box container">');
                    }
                
                    
                }
                echo ('<div class="item text_color_red">');
                echo "<img src='img/{$row['PicURL']}' class='item_img' width='150px' height='150px'/>";
                echo "<p class='product_name'>{$row['name']}</p>";
                echo "<p class= 'pro_type'>Type: {$row['TypeName']}</p>";
                echo "<p class='price'>Price: {$row['Price']}</p>";
                echo "<p class='desc'>Description: {$row['Description']}<p>";
                echo '</div>';
                $i=$i+1;
            }
        }
        if($i%4!=1)
        {
            echo '</div>';
        }
    ?>
</body>
</html>