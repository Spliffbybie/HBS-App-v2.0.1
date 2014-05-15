<?php
require_once('_connections/db_link.php'); 
require_once('_includes/check_access.php');
//validate post input if ()
require_once "_includes/formvalidator.php";
$show_form=true;

class MyValidator extends CustomValidator
{
	function DoValidate(&$formars,&$error_hash)
	{
        if(stristr($formars['Comments'],'http://'))
        {
            $error_hash['Comments']="No URLs allowed in comments";
            return false;
        }
		return true;
	}
}

if(isset($_POST['Submit']))
{
    $validator = new FormValidator();
    $validator->addValidation("FirstName","req","Please fill in First Name");	 
	$validator->addValidation("LastName","req","Please fill in Last Name");
	$validator->addValidation("AddressTown","req","Please fill in Address Town");
	$validator->addValidation("Country","req","Please fill in Country");
	$validator->addValidation("AddressPostal","req","Please fill in Postal Address");
	$validator->addValidation("PhoneNumber1","req","Please fill in Phone Number 1");
	$validator->addValidation("PhoneNumber2","req","Please fill in Phone Number 2");
    $validator->addValidation("Email","email","The input for Email should be a valid email value");
    $validator->addValidation("Email","req","Please fill in Email");
	$validator->addValidation("IdNumber","req","Please fill in Id Number");
	$validator->addValidation("VehicleModel","req","Please fill in Vehicle Model");
	$validator->addValidation("PlateNo","req","Please fill in Plate Number");
    $custom_validator = new MyValidator();
    $validator->AddCustomValidator($custom_validator);

    if($validator->ValidateForm())
    {
        echo "<h2>Validation Success!</h2>";
        //$show_form=false;

//if(true == $show_form)
//{
 //assign variables
 //$cgid = $_POST["id"];
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
 $vehiclemodel = $_POST["VehicleModel"];
 $plateno = $_POST["PlateNo"];
 

 $roomno = $_GET["RNo"];
 $roomtype = $_GET["RT"];
 $datein = $_POST["DateIn"];
 $dateout = $_POST["DateOut"];
 $duration = $_POST["Duration"];
 $noadults = $_POST["NoAdults"];
 $nochildren = $_POST["NoChildren"];


 //$Error = "Vehicle Info Error";
//query insert into the db 
mysql_select_db($database_db_link, $db_link);
$sql_roomprice = "SELECT roomprices.RoomPrice, rooms.RoomNo
FROM (roomprices INNER JOIN rooms ON roomprices.RoomPriceId = rooms.RoomPriceId) INNER JOIN roomtypes ON rooms.RoomTypeId = roomtypes.RoomTypeId
WHERE (((rooms.RoomNo)='$roomno'))";
$excute_roomprice = mysql_query($sql_roomprice, $db_link) or die ('Error Room No' .mysql_error());
$row_result_roomprice = mysql_fetch_assoc($excute_roomprice);
$roomprice = $row_result_roomprice['RoomPrice'];
//caculate cost  
  $cost = $duration * $roomprice;
  
//if vehicle is none dont insert
	if ($_POST["Vehicle"] = "None"){
		$plateno = "None";
	}
	else {
	
	$add_vehicle = "INSERT INTO vehicle (PlateNumber, Vehicle, VehicleModel) VALUES ('$plateno', '$vehicle', '$vehiclemodel')";
	$excute_vehicle = mysql_query($add_vehicle, $db_link) or die ('Error add vehicle' .mysql_error());
	
}

	$add_customer = "INSERT INTO customers (CustomerId, CustomerTitle, Membership, CustomerFName, CustomerLName, AddressTown, AddressCountry, AddressPostalCode, PhoneNumber1, PhoneNumber2, CustomerEmail, IdNumber, IdType, PlateNumber) VALUES ('', '$title', '$membership', '$fname', '$lname', '$addresstown', '$country', '$addresspostal', '$phone1', '$phone2', '$email', '$idnumber', '$idtype', '$plateno' )";
$excute_customer = mysql_query($add_customer, $db_link) or die ('Error add customer' .mysql_error());

// get customerid
	$select_customer = "SELECT * FROM customers WHERE IdNumber = '$idnumber' ";
$excute_customer = mysql_query($select_customer, $db_link) or die (mysql_error());
$row_result_customer = mysql_fetch_assoc($excute_customer);
$totalRows_customer = mysql_num_rows($excute_customer);
$cgid = $row_result_customer['CustomerId'];

	$add_guest = "INSERT INTO guest (GuestId, GuestTitle, FirstName, LastName, AddressTown, AddressCountry, PhoneNumber1, PhoneNumber2 ) VALUES ('$cgid', '$title', '$fname', '$lname', '$addresstown', '$country', '$phone1', '$phone2' )";  
$excute_guest = mysql_query($add_guest, $db_link) or die ('Error add guest' .mysql_error());

	$add_reservation = "INSERT INTO reservations (ReservationId, CustomerId, RoomNo, RoomType, DateIn, DateOut, Duration, NoAdults, NoChildren) VALUES ('', '$cgid', '$roomno', '$roomtype', '$datein', '$dateout', '$duration', '$noadults', '$nochildren' )";
$excute_reservation = mysql_query($add_reservation, $db_link) or die ('Error add reservation' .mysql_error());

//update room status to not available
	$update_rooms = "UPDATE rooms SET Available = 'No' WHERE RoomNo = '$roomno' LIMIT 1";
$excute_rooms = mysql_query($update_rooms, $db_link) or die ('Error update Room' .mysql_error());


//get reservationId
	$select_reservation = "SELECT * FROM reservations WHERE CustomerId = '$cgid' ";
$excute_reservation = mysql_query($select_reservation,$db_link) or die('Error select reservation' .mysql_error());
$row_result_reservation = mysql_fetch_assoc($excute_reservation);
$totalRows_reservation = mysql_num_rows($excute_reservation);

$reservationid = $row_result_reservation['ReservationId'];

	$add_reservationlink = "INSERT INTO reservedrooms (ReservationId, RoomNo, GuestId) 
VALUES ('$reservationid', '$roomno', '$cgid')";
$excute_reservationlink = mysql_query($add_reservationlink,$db_link) or die('Error link reservation' .mysql_error());
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Confimation</title>
<link href="styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />

</head>

<body>
<div class="container">
<h1>Hotel Booking System</h1>
<hr />
<a href="reservation.php">View Reservations</a> | <a href="guestlist.php">View Guest List</a> | <a href="check_rooms.php">Add Guest</a> |
<h3>Guest Details </h3>
<p>You have succefully reserved a room for : <b> <?php echo $_POST["Title"], ' ', $_POST["FirstName"], ' ', $_POST["LastName"]; ?></b></p>  
<p>Room Number : <b> <?php echo $_GET["RNo"]; ?> </b></p>
<p>Room Type : <b> <?php echo $_GET["RT"]; ?> </b></p>
<h3>Make Payment</h3>
<p>Duration : <b> <?php echo $_POST["Duration"]; ?> </b></p>
<p>Room Price: <b> <?php echo $roomprice; ?> </b></p>
<p>Total Cost: <b> <?php echo $cost; ?> </b></p></p>
<form action="makepayment.php?c=<?php echo $cost; ?>" method="post" name="Payment">
<table border="1">
<tr><td>Payment Method:</td><td>
<select name="PaymentMethod">
        <option value="1">Visa Card</option>
        <option value="2">Cash</option>
      </select></td>
	  </tr>
<tr><td align="right">Paid:</td><td><input name="Paid" type="text" maxlength="6" ></td>
<tr><td colspan="2"><input type="submit" value="Make Payment"></td>
</tr>
</table></form>
<?PHP
}
    else
    {
		include('_includes/page.php');
		echo "<div class='error_box' align='center'>";	
		echo '<a href="addguest.php">RETURN</a>';     
        echo "<h2><img src ='images/messageboxerror.ico'>", "Validation Errors:</h2>";
		

        $error_hash = $validator->GetErrors();
        foreach($error_hash as $inpname => $inp_err)
		
        {
            echo "<p>$inpname : $inp_err</p>";
			
        }   
		
    }
}
//} true == $show_form
?>
</div>
</body>
</html>