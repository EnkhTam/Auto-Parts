<html>
<head>
</head>

<body>
  <h1>Set Shipping Cost</h1>

 <form action="http://students.cs.niu.edu/~z1866268/shippingcost.php" method="post">

 <label for="max">Max Weight:</label>
 <input name="max" id="max" type=".01" /> 

 <br> </br>

 <label for="rate">Shipping Rate:</label>
 <input name="rate" id="rate" type=".001" /> 

<br> </br>

<input type="submit" value="submit"/>   

</form>
</body>
</html>


<?php
 $username = "z1881567";
 $password = "2001Feb22";

 include("drawtable.php");

 try
 {
 $dsn = "mysql:host=courses;dbname=z1881567";
 $pdo = new PDO($dsn, $username, $password);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 if(!empty($_POST['max']) and !empty($_POST['rate']))
 {
  $max = $_POST['max'];
  $rate = $_POST['rate'];

  $rs = $pdo->prepare("INSERT into management(maxWeight,shippingRate) values(?,?)");
  $rs->execute(array($max,$rate));

  $rs = $pdo->query("SELECT * FROM management");
  $rows = $rs->fetchAll(PDO::FETCH_ASSOC);
  draw_table($rows);
 }

 else
 {
	echo "Submit the correct amount of items.";
 }
}

catch(PDOExeption $e)
{
	echo "Connection to database failed: " . $e->getMessage();
}
?>
