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
    <link rel="stylesheet" href="./css/adminHome_style.css">
    <title>Admin Home</title>
    <script type="text/javascript">
        function logout(){
            $_SESSION['user'] = null;
            $_SESSION["userid"] = null;
            window.location.href = "./SignIn.php";
       }

        function openAddProductPage(){
            window.location.href = "./AddNewProduct.php";
        }
        function openAdminViewPage(){
            window.location.href = "./AdminProductView.php";
        }
    </script>
</head>
<body>
    <div class="main">
        <div class="head">
            WELCOME ADMIN NAME
        </div>
        <div class="body">
            <button id="add_product" onclick="openAddProductPage()">
                ADD NEW PRODUCT
            </button>
            <br>
            <button id="view_product" onclick="openAdminViewPage()">
                VIEW PRODUCTS
            </button>
        </div>
    </div>
    <div class="footer">
        <footer id="footer">
           <a href="SignIn.php" class="right" id="logout"> <pre class="bg-orange">| </pre>Logout</a>

        </footer>
    </div>
</body>
</html>