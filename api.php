<?php require('conn.php'); ?>

<?php
  if (isset($_REQUEST["action"]) && !empty($_REQUEST["action"])) 
  { 
    $action = $_REQUEST["action"];

	if($action == "updateActiveStatus")
	{
		$id = $_REQUEST["id"];
        
		$sql = "Update product set isActive=0 where ProductId=$id";
		
		$flag = false;
		if (mysqli_query($conn, $sql) === TRUE) {			
			$flag = true;
		} else {
			//$msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
			$flag = false;
		}
		$output["data"] = $flag;
		echo json_encode($output);
	}
	
  }//end of if
  


?>