<?php 

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
    <title>Sign Up: Product Entry</title>
</head>
<body>
    <div class="container">
        <div class=head>
            <i class="uil uil-padlock"></i>
            <span>Add Product</span>
        </div>
        <div class="body">
            <form action="/action.php">
                <label for="name" id="name_label">Name </label><br>
                <input type="text" id="mame" name="name" placeholder="Name....."><br><br>
                <label for="price" id="price_label"> Price </label><br>
                <input type="text" id="price" name="price" placeholder="Price....."><br><br>
                <label for="type" id="type_label"> Type Select </label><br>
                <select name="dropdown" id='type_dd'>
                    <option value=-1 selected disabled hidden>Select Type</option>
                    <option value=1 >Electronics</option>
                </select>
                <label for="desc" id="desc_label"> Description </label><br>
                <textarea id="txtid" name="txtname" rows="2" cols="43" placeholder="Describe yourself here..."></textarea>
                <label for="pic" id="pic_label"> Picture </label><br>
                <input type="file" id="myfile" name="myfile"><br><br>
                <input type="submit" value="Edit Product">
            </form>
        </div>
    </div>
</body>
</html>