<h3>Payment Transuction</h3>

<?php 

 if (is_numeric($_POST['Paid'])){
	
	$paid = $_POST['Paid']; $cost = $_GET['c']; $pm = $_POST['PaymentMethod']; $paid = $_POST['Paid'];    $cid = $_GET['cid'];
	
	require_once('../../Connections/db_link.php'); 
  
  $insertSQL ="INSERT INTO payments (PaymentId, CustomerId, PaymentMethodId, AmountPaid, Totalcost) VALUES ('','$cid', '$pm', $paid, $cost)";

  mysql_select_db($database_db_link, $db_link);
  
  $Result1 = mysql_query($insertSQL, $db_link) or die(mysql_error());
	
	echo  "<div class='success_box'>";
    echo "<p><img src='../../lib/images/ok.png' /> Transuction was successfull</p>";
	echo "<p>Paid: <b>", $paid, "</b></p>";
	echo "<p>Change: <b>", $paid - $cost, "</b></p>";
	echo "<p>Balance:</p> </div>";
	
	}
	else 
		{
		echo "<div class='error_box'>";
    	echo "<h2><img src ='../../images/error.png'>", "Validation Errors:</h2>";
		echo "<p>Invalid Payment Entry</p>"; 
		echo '<a href="feedback.php">RETURN</a>';  
		echo "</div>";
		}
?>