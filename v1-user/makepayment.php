<?php 
require_once('_connections/db_link.php'); 
//require_once('_includes/check_access.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>payement_transuction</title>
<link href="styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container">
<h1>Hotel Booking System</h1>
<hr />
<div align="center">
<div class="icons"><a href="limitedpanel.php"><img src="images/home.png" alt="Home"></a></div>
<br />
<h3>Payment Transuction</h3>
<?php 
if (is_numeric($_POST['Paid'])){
	$paid = $_POST['Paid']; $cost = $_GET['c']; $pm = $_POST['PaymentMethod']; $paid = $_POST['Paid'];

  $insertSQL ="INSERT INTO payments (PaymentId, CustomerId, PaymentMethodId, PaymentAmount) VALUES ('','', '$pm', $paid)";

  mysql_select_db($database_db_link, $db_link);
  $Result1 = mysql_query($insertSQL, $db_link) or die(mysql_error());

echo "<p>Transuction was successfull</p>";
	echo "<p>Paid: <b>", $paid, "</b></p>";
	echo "<p>Change: <b>", $paid - $cost, "</b></p>";
	echo "<p>Balance:</p>";
	
}
else 
	{
	echo "<div class='error_box' align='center'>";
	echo '<a href="addguest.php">RETURN</a>';     
    echo "<h2><img src ='images/messageboxerror.ico'>", "Validation Errors:</h2>";
	echo "<p>Invalid Payment Entry</p>"; 
	echo "</div>";
	}
?>
</div>
</div>
</body>
</html>
