<?php
require_once('_connections/db_link.php');
require_once('_includes/check_access.php');
//assign variables
 $GNo = $_GET["GNo"];
 $plateNo = $_GET["PlateNo"];
 
 $title = $_POST["Title"];
 $fname = $_POST["FirstName"];
 $lname = $_POST["LastName"];
 $addresstown = $_POST["AddressTown"];
 $phone1 = $_POST["PhoneNumber1"];
 $phone2 = $_POST["PhoneNumber2"];
 $country = $_POST["Country"];
 $membership = $_POST["Membership"];
 $idnumber = $_POST["IdNumber"];
 $idtype = $_POST["IdType"];
 $email = $_POST["Email"];
 $addresspostal = $_POST["AddressPostal"];
 
 $vehicle = $_POST["Vehicle"];
 $vehiclemodel = $_POST["vehicleModel"];
 
  $datein = $_POST["DateIn"];
 $dateout = $_POST["DateOut"];
 $duration = $_POST["Duration"];
 $noadults = $_POST["NoAdults"];
 $nochildren = $_POST["NoChildren"];

  
  $cost = $_POST["totalcost"];
  $paid = $_POST["paid"];
  $balance = $paid - $cost ;

//upadting to Database
mysql_select_db($database_db_link, $db_link);

$update_guest = "UPDATE guest SET FirstName = '$fname', LastName = '$lname', AddressTown = '$address', AddressCountry = '$country', PhoneNumber1 = '$phone1', PhoneNumber2 = '$phone2' WHERE GuestId ='$GNo' LIMIT 1";

$update_customer = "UPDATE customers SET FirstName = '$fname', LastName = '$lname', AddressTown = '$address', AddressCountry = '$country', PhoneNumber1 = '$phone1', PhoneNumber2 = '$phone2', Membership = '$membership', IdNumber = '$idnumber', Idtype = '$idtype', PlateNumber = '$plateNumber'  WHERE GuestNo ='$GNo' LIMIT 1";

$update_vehicle = "UPDATE vehicle SET Vehicle = '$vehicle', VehicleModel = '$vehiclemodel', PlateNumber = '$plateno'  WHERE PlateNumber ='$plateNo' LIMIT 1";

$update_reservation ="UPDATE reservations SET DateIn = '$datein', DateOut = '$dateout', Duration = '$duration', NoAdults = '$noadults', NoChildren = '$nochildren' WHERE CustomerId = '$GNo' LIMIT 1";
//excute sql
$excute_guest = mysql_query($update_guest,$db_link) or die(mysql_error());
$excute_reservation = mysql_query($update_reservation, $db_link) or die (mysql_error());
$excute_vehicle = mysql_query($update_vehicle,$db_link) or die(mysql_error());
$excute_customer = mysql_query($update_customer,$db_link) or die(mysql_error());

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<link href="styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<h1>Hotel Booking System</h1>
<hr />
<a href="reservation.php">View Reservations</a> | <a href="guestlist.php">View Guest List</a> | <a href="check_rooms.php">Add Guest</a> |
<h3>Guest Details Updated</h3>
<p>You have succefully updated guest details of : <b> <?php echo $_POST["FirstName"], ' ', $_POST["LastName"]; ?></b></p> 
<?php RedirectToURL("guestlist.php");?>
</body>
</html>
