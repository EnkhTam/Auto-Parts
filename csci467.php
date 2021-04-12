 <html>
 <head>
 </head>

 <body>
 <h1>View Orders</h1>

 <h3>Orders can be searched based on date range, status (authorized, shipped) or prize range.</h3>

 <form action="http://students.cs.niu.edu/~z1866268/csci467.php" method="post">

 <label for="status">Status:</label>
 <input name="status" id="status" type="text" />

 <br> </br>

 <label for="date1">Enter a first date:</label>
 <input name="date1" id="date1" type="date" />

 <label for="date2">Enter the second date in the second range:</label>
 <input name="date2" id="date2" type="date" />

 <br> </br>

 <label for="price1">Price1:</label>
 <input name="price1" id="price1" type=".01" />

 <label for="price2">Price2:</label>
 <input name="price2" id="price2" type=".01" />

 <br> </br>

 <input type="hidden" name="process" value="1" />
 <input type="submit" value="Submit" />

 </form>
 </body>
 </html>

 <?php

 include("drawtable.php");

 $username = "z1881567";
 $password = "2001Feb22";

 try
 {
 $dsn = "mysql:host=courses;dbname=z1881567";
 $pdo = new PDO($dsn, $username, $password);

/*
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
*/
error_reporting(0);

if (!empty($_POST['date1']) and !empty($_POST['date2']))
{
        $date1 = $_POST['date1'];
	$date2 = $_POST['date2'];

 	$s1 = "SELECT * FROM orders WHERE created_at BETWEEN '";
	$s2 = "$date1";
	$s3 = $s1.$s2;
	$s4 = "' and '";
	$s5 = $s3.$s4;
	$s6 = "$date2";
	$s7 = $s5.$s6;
	$s8 = "';";
	$s9 = $s7.$s8;

	$st = $pdo->prepare("$s9");
	$st->execute();

	$rs = $pdo->query("$s9");
	$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
        draw_table($rows);
}

if (!empty($_POST['price1']) and !empty($_POST['price2']))
{
	$price1 = $_POST['price1'];
	$price2 = $_POST['price2'];

	$s1 = "SELECT * FROM orders WHERE totalPrice BETWEEN '";
	$s2 = "$price1";
	$s3 = $s1.$s2;
	$s4 = "' and '";
	$s5 = $s3.$s4;
	$s6 = "$price2";
	$s7 = $s5.$s6;
	$s8 = "';";
	$s9 = $s7.$s8;

	$st = $pdo->prepare("$s9");
        $st->execute();

        $rs = $pdo->query("$s9");
        $rows = $rs->fetchAll(PDO::FETCH_ASSOC);
        draw_table($rows);
}

if(!empty($_POST['status']))
{
	$status = $_POST['status'];

	$s1 = "SELECT * FROM orders WHERE status='";
	$s2 = "$status";
	$s3 = $s1.$s2;
	$s4 = "';";
	$s5 = $s3.$s4;

	$st = $pdo->prepare("$s5");
        $st->execute();

	$rs = $pdo->query("$s5");
	$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
        draw_table($rows);
}
}
catch(PDOExeption $e)
{
echo "Connection to database failed: " . $e->getMessage();
}
?>
