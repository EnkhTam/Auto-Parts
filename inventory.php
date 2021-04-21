<?php
include("drawtable.php");
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
				 $q = $pdo1->prepare("select description from parts where number = ?");
			         $q->execute([$_POST["part_number"]]);
				 $name = $q->fetchColumn();
				 echo "Product ".$name." is found in Warehouse Inventory";
				 echo "<br>";
				 $sql = "update inventory set quantityAvailable = quantityAvailable + ? where itemid = ?";
                 $stmt2 = $pdo2->prepare($sql);
				 $stmt2->execute([$_POST["quantity"], $_POST["part_number"]]);
				 $rows = $stmt2->rowCount();
				 if($rows > 0)
				 {
					 echo "Inventory Updated, ".$_POST["quantity"]." ".$name." are added to the Warehouse Inventory";
					 echo "<br>";
					 echo "<br>";
                     for($i = 0; $i < 28; $i++)
                     {
                         $q = $pdo1->prepare("select description from parts where number = ?");
                                     $q->execute([$i+1]);
                         $name = $q->fetchColumn();
                                     $sql = "select quantityAvailable from inventory where itemid = ?";
                                   $rs = $pdo2->query("select itemid, quantityAvailable from inventory where itemid = ".($i+1));
                         $rows = $rs->fetchAll(PDO::FETCH_ASSOC);
                         draw_table($rows,$name);
                     }
                     for($j = 30; $j < 31; $j++)
                     {
                         $q = $pdo1->prepare("select description from parts where number = ?");
                         $q->execute([$j+1]);
                         $name = $q->fetchColumn();
                         $sql = "select quantityAvailable from inventory where itemid = ?";
                         $rs = $pdo2->query("select itemid, quantityAvailable from inventory where itemid = ".($j+1));
                         $rows = $rs->fetchAll(PDO::FETCH_ASSOC);
                         draw_table($rows, $name);
                     }
                     
                     for($m = 40; $m < 149; $m++)
                     {
                         $q = $pdo1->prepare("select description from parts where number = ?");
                         $q->execute([$m+1]);
                         $name = $q->fetchColumn();

                         $sql = "select quantityAvailable from inventory where itemid = ?";
                         $rs = $pdo2->query("select itemid, quantityAvailable from inventory where itemid = ".($m+1));
                         $rows = $rs->fetchAll(PDO::FETCH_ASSOC);
                         
                         draw_table($rows,$name);
                     }

				 }
				 else
				 {
					 echo "Fail to Update the Inventory";
					 echo "<br>";
				 }
		         }
		         else
		         {
			 	echo "Product is not found in Warehouse Inventory";
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
					echo "<br>";

					for($i = 0; $i < 28; $i++)
					{
						$q = $pdo1->prepare("select description from parts where number = ?");
                        			$q->execute([$i+1]);
						$name = $q->fetchColumn();
                			        $sql = "select quantityAvailable from inventory where itemid = ?";
                  				$rs = $pdo2->query("select itemid, quantityAvailable from inventory where itemid = ".($i+1));
						$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
						draw_table($rows,$name);
					}
                    for($j = 30; $j < 31; $j++)
                    {
                        $q = $pdo1->prepare("select description from parts where number = ?");
                        $q->execute([$j+1]);
                        $name = $q->fetchColumn();
                        $sql = "select quantityAvailable from inventory where itemid = ?";
                        $rs = $pdo2->query("select itemid, quantityAvailable from inventory where itemid = ".($j+1));
                        $rows = $rs->fetchAll(PDO::FETCH_ASSOC);
                        draw_table($rows, $name);
                    }
                    
                    for($m = 40; $m < 149; $m++)
                    {
                        $q = $pdo1->prepare("select description from parts where number = ?");
                        $q->execute([$m+1]);
                        $name = $q->fetchColumn();

                        $sql = "select quantityAvailable from inventory where itemid = ?";
                        $rs = $pdo2->query("select itemid, quantityAvailable from inventory where itemid = ".($m+1));
                        $rows = $rs->fetchAll(PDO::FETCH_ASSOC);
                        
                        draw_table($rows,$name);
                    }
                    
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
 	
}

catch(PDOexception $e) { // handle that exception
echo "Connection to database failed: " . $e->getMessage(); }
?>





