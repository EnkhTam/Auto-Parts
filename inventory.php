<html>
    <head></head>
        <title>Best Auto Part</title>
            <body>
		    <h1>Warehouse Inventory Receiving Desk</h1>
		    <h2>Enter the part number or description, then enter the quantity of products</h2>
		    <form action="http://students.cs.niu.edu/~z1861817/inventory.php" method="POST">                
		    <h3>(If you forget the part_number, you can choose to enter description)</h3>
		    <label for = part_number>Part_number:</label><input type = "number" name = "part_number"><br>
		    <h5>(<label for = description>Description:</label><input type = "text" name = "description">)</h5>
		    <label for = quantityAvailable>Quantity:</label><input type = "number" name = "quantity"><br>

<?php
$username1 = "student";
$password1 = "student";
$username2 = "z1861817";
$password2 = "2000Jun02";

try{
	$dsn1 = "mysql:host=blitz.cs.niu.edu;dbname=csci467";
	$dsn2 = "mysql:host=courses;dbname=z1861817";
	$pdo1 = new PDO($dsn1, $username1, $password1);
	$pdo2 = new PDO($dsn2, $username2, $password2);


	if( (!empty($_POST["part_number"]) || !empty($_POST["description"])) && !empty($_POST["quantity"]))
	{
        
        	if(!empty($_POST["part_number"]))
            	{
			 $count = "SELECT COUNT(*) FROM parts WHERE number = " .($_POST["part_number"]);
		   	 $res = $pdo1->query($count);
		    	 if($res->rowCount() > 0)
	 		 {
				 echo "Part is found in Warehouse Inventory";
				 echo "<br>";
				 $q = $pdo1->prepare("select description from parts where number = ?");
			         $q->execute([$_POST["part_number"]]);
				 $name = $q->fetchColumn();
				 $sql = "update inventory set quantityAvailable = quantityAvailable + ? where itemid = ?";
		                 $stmt2 = $pdo2->prepare($sql);
				 $stmt2->execute([$_POST["quantity"], $_POST["part_number"]]);
				 $rows = $stmt2->rowCount();
				 if($rows > 0)
				 {
					 echo "Inventory Updated, ".$_POST["quantity"]." ".$name." are added to the Warehouse Inventory";
					 echo "<br>";
				 }
				 else
				 {
					 echo "Fail to Update the Inventory";
					 echo "<br>";
				 }
		         }
		         else
		         {
			 	echo "Part is not found in Warehouse Inventory";
			 }	    
		}
		if(!empty($_POST["description"]) && empty($_POST["part_number"]))
		{
			$count = "SELECT COUNT(*) FROM parts WHERE description = ".'"'.$_POST["description"].'"';
			$res = $pdo1->query($count);
			$rows = $res->rowCount();
			if($rows > 0)
			{
				echo "Part is found in Warehouse Inventory";
				echo "<br>";
				$q = $pdo1->prepare("select number from parts where description = ?");
				$q->execute([$_POST["description"]]);
				$id = $q->fetchColumn();
				$sql = "update inventory set quantityAvailable = quantityAvailable + ? where itemid = ?";
				$stmt2 = $pdo2->prepare($sql);
				$stmt2->execute([$_POST["quantity"], $id]);
				$rows = $stmt2->rowCount();
				if($rows > 0)
				{
					echo "Inventory Updated, ".$_POST["quantity"]." ".$_POST["description"]." are added to the Warehouse Inventory";
					echo "<br>";
				}
				else
				{
					echo "Fail to Update the Inventory";
					echo "<br>";
				}
			}
			else
			{
				echo "Part is not found in Warehouse Inventory";
			}
		}


	}
 

	
	echo '<input type = "submit" value = "Add to the inventory">';
	echo "</form>";

}

catch(PDOexception $e) { // handle that exception
echo "Connection to database failed: " . $e->getMessage(); }
?>

</body>
</html>




