<?php 
 require_once('../AdminConnections/db_link.php'); 
 
 require_once('../includes/checkaccess.php');

//get room no and room typ
 $roomNo = $_GET['rno']; $roomType = $_GET['rt'];
 
//$redirectValidationSuccess = "feedback.php?rno= $roomNo&rt= $roomType";

	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

 $editFormAction = $_SERVER['PHP_SELF'];
	
	if (isset($_SERVER['QUERY_STRING'])) {
  
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "AddGuest")) {
  
  $insertSQL = sprintf("INSERT INTO customers (CustomerTitle, Membership, CustomerFName, CustomerLName, AddressTown, AddressCountry, AddressPostalCode, PhoneNumber1, PhoneNumber2, CustomerEmail, IdNumber, IdType, PlateNumber, Status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Membership'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['AddressTown'], "text"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['AddressPostal'], "text"),
                       GetSQLValueString($_POST['PhoneNumber1'], "text"),
                       GetSQLValueString($_POST['PhoneNumber2'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['IdNumber'], "text"),
                       GetSQLValueString($_POST['IdType'], "text"),
                       GetSQLValueString($_POST['PlateNo'], "text"),
					   GetSQLValueString($_POST['Status'], "text"));

  mysql_select_db($database_db_link, $db_link);
  $Result1 = mysql_query($insertSQL, $db_link) or die(mysql_error());
}

// get customerid

 $idnumber = $_POST['IdNumber'];
 
	$select_customer = "SELECT CustomerId FROM customers WHERE IdNumber = '$idnumber' ";
 $excute_customer = mysql_query($select_customer, $db_link) or die (mysql_error());
 $row_result_customer = mysql_fetch_assoc($excute_customer);
 $totalRows_customer = mysql_num_rows($excute_customer);
 $cgid = $row_result_customer['CustomerId'];

	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "AddGuest")) {
  
  $insertSQL = sprintf("INSERT INTO vehicle (PlateNumber, Vehicle, VehicleModel) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['PlateNo'], "text"),
                       GetSQLValueString($_POST['Vehicle'], "text"),
                       GetSQLValueString($_POST['VehicleModel'], "text"));

  mysql_select_db($database_db_link, $db_link);
  $Result1 = mysql_query($insertSQL, $db_link) or die(mysql_error());
	
	$insert_booking = sprintf("INSERT INTO reservations (CustomerId, RoomNo, RoomType, DateIn, DateOut, Duration, NoAdults, NoChildren) VALUES ($cgid, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_GET['rno'], "text"),
					   GetSQLValueString($_GET['rt'], "text"),
					   GetSQLValueString($_POST['DateIn'], "date"),
                       GetSQLValueString($_POST['DateOut'], "date"),
                       GetSQLValueString($_POST['Duration'], "int"),
					   GetSQLValueString($_POST['NoAdults'], "int"),
					   GetSQLValueString($_POST['NoChildren'], "int"));

  mysql_select_db($database_db_link, $db_link);
  $Result_booking = mysql_query($insert_booking, $db_link) or die('error here' . mysql_error());
	
	//insert guest
	$insert_guest = sprintf("INSERT INTO guest (GuestId, GuestTitle, FirstName, LastName, AddressTown, AddressCountry, PhoneNumber1, PhoneNumber2 ) VALUES ($cgid, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['AddressTown'], "text"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['PhoneNumber1'], "text"),
                       GetSQLValueString($_POST['PhoneNumber2'], "text"));

  mysql_select_db($database_db_link, $db_link);
  $Result_guest = mysql_query($insert_guest, $db_link) or die('error here' . mysql_error());
	
	$t=$_POST['Title']; $fn=$_POST['FirstName']; $ln=$_POST['LastName'];
	
  $insertGoTo = "feedback.php?rno=$roomNo&rt=$roomType&t=$t&fn=$fn&ln=$ln&d=$d";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Add_guest</title>
<link href="../../lib/styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />

</head>

<body>

<table class="container" align="center">
<tr><td>

<table class="info_bar" cellspacing="5px" cellpadding="0px" width="920px" >

<tr>

<td class="info"></td>

<td class="info"><?php echo date("F d Y")?></td>

<td class="logout_box"><img src = "../../lib/images/online.ico" align="bottom"><?php echo $_SESSION['MM_Username']; ?> | <a href="<?php echo $logoutAction ?>">Log out</a></td>

</tr></table>

<div class="header">

<h1>Company name</h1>

<div id="header_shortcut">
<a href="controlpanel/settings.php"><img src ="../../lib/images/settings.png"  width="26" height="27" title="Add Guest"> Control Panel </a></div>
</div>

<hr />

<div class="navi_icons">

<a href="../home.php"><img src="../../lib/images/home.png" width="26" height="27" title="Home"> Home</a> |

<a href="../reservation.php"><img src="../../lib/images/reservations.png"  width="26" height="27" title="View Reservations"> View Reservations</a> | 

<a href="../guestlist.php"><img src="../../lib/images/guestlist.png"  width="26" height="27" title="Guest List"> Guest List</a> | 

<a href="checkrooms.php"><img src ="../../lib/images/addguest.png"  width="26" height="27" title="Add Guest"> Add Guest</a> | 

<a href="../controlpanel/settings.php"><img src ="../../lib/images/settings.png"  width="26" height="27" title="Add Guest"> Reports </a></div>


<br />

<!--PHP code to validate all field entries-->
<?PHP
//include the main validation script
require_once "formvalidator.php";

$show_form=true;

if(isset($_POST['Submit']))
{// The form is submitted

    //Setup Validations
    $validator = new FormValidator();
    $validator->addValidation("Name","req","Please fill in Name");
    $validator->addValidation("Email","email","The input for Email should be a valid email value");
    $validator->addValidation("Email","req","Please fill in Email");
    //Now, validate the form
    if($validator->ValidateForm())
    {
        //Validation success. 
        //Here we can proceed with processing the form 
        //(like sending email, saving to Database etc)
        // In this example, we just display a message
        echo "<h2>Validation Success!</h2>";
        $show_form=false;
    }
    else
    {
        echo "<B>Validation Errors:</B>";

        $error_hash = $validator->GetErrors();
        foreach($error_hash as $inpname => $inp_err)
        {
            echo "<p>$inpname : $inp_err</p>\n";
        }        
    }//else
}//if(isset($_POST['Submit']))

if(true == $show_form)
{
?>



<h3>Add Guest <div id="status">Guest Status:<select name="Status">
      <option value="In">In</option>
      <option value="Pending">Pending</option>
    </select>
	</div></h3>

<form name="AddGuest" method="POST" action="<?php echo $editFormAction; ?>" >

<table width="742" border="0" align="center">

  <tr>

    <th colspan="4">Guest Information </th>
      </tr>

  <tr>

    <td align="right">Title</td>

    <td><select name="Title">
      <option value="Dr.">Dr.</option>
      <option value="Mr.">Mr.</option>
      <option value="Mrs.">Mrs.</option>
      <option value="Ms.">Ms.</option>
    </select></td>

    <td align="right">Membership</td>

	<td><select name="Membership" size="1">
      <option>Yes</option>
      <option>No</option>
    </select></td>
  </tr>

  <tr>

    <td align="right">First Name </td>

    <td><input name="FirstName" type="text" maxlength="20"></td>

    <td align="right">Last Name</td>

    <td><input name="LastName" type="text" maxlength="20"></td>

  </tr>

  <tr>
  	 
    <td width="160" align="right">Town</td>
 
    <td width="220"><input name="AddressTown" type="text" maxlength="20"></td>
 
    <td width="146" align="right">Country</td>
 
    <td width="198"><input name="Country" type="text" maxlength="20"></td>
 
  </tr>
 
  <tr>
 
    <td align="right">Postal Code</td>
 
    <td><textarea name="AddressPostal" rows="2" maxlength="30" ></textarea></td>
 
    <td align="right">Email</td>
 
    <td id="eg"><input name="Email" type="text"><br/>
	eg. yourname@email.com</td>
  </tr>
 
  <tr>
 
    <td align="right">Phone Number1</td>
 
    <td><input name="PhoneNumber1" type="text" maxlength="20"></td>
 
    <td align="right">Phone Number2:</td>
 
    <td><input name="PhoneNumber2" type="text" maxlength="20"></td>
 
  </tr>
 
  <tr>
 
    <th colspan="4" align="center">Room Information</th>`
	   
  </tr>
  
  <tr>
  
    <td align="right">Room Number:</td>
  
    <td><?php echo $roomNo; ?></td>
  
    <td align="right">Room Type:</td>
  
    <td><?php echo $roomType; ?></td>
  
  </tr>
  
  <tr>
  
    <td align="right">Date In</td>
  
    <td id="eg"><input name="DateIn" type="text" maxlength="10"><br />YYYY-MM-DD</td>
  
    <td align="right">Date Out</td>
  
    <td id="eg"><input name="DateOut" type="text" maxlength="10"><br />YYYY-MM-DD</td>
  
  </tr>
  
  <tr>
  
    <td align="right">Duration (Days)</td>
  
    <td><input name="Duration" type="text" maxlength="3" size="4"></td>
  
    <td align="right">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <td align="right">No. of Adults</td>
  
    <td><input name="NoAdults" type="text" maxlength="2" size="4"></td>
  
    <td align="right">No. of Children</td>
  
    <td><input name="NoChildren" type="text" maxlength="2" size="4"></td>
  
  </tr>
  
  <tr>
  
    <th colspan="4">Indentification Information </th>
  
     </tr>
  
  <tr>
  
    <td align="right">ID Type </td>
  
    <td><select name="IdType">
      <option>Driving License</option>
      <option>Passport</option>
    </select></td>
  
    <td align="right">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <td align="right">ID Number </td>
  
    <td><input name="IdNumber" type="text" maxlength="20"></td>
  
    <td align="right">:</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <th colspan="4">Vehicle Information</th>
  
    <td align="right">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <td align="right">Vehicle</td>
  
    <td>
      <select name="Vehicle">
        <option>Car</option>
        <option>Motorcycle</option>
		<option>None</option>
      </select>    </td>
  
    <td align="right">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <td align="right">Vehicle Model </td>
  
    <td>
      <input name="VehicleModel" type="text" maxlength="20">    </td>
  
    <td align="right">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <td align="right">Plate Number </td>
  
    <td><input name="PlateNo" type="text" maxlength="15"></td>
  
    <td>&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>

<tr>

	<td colspan="4">

	<div class="Form_buttons" ><input type="Submit" value="Add Guest" name="addinfo">

	  <input type="reset" value="Clear Details" name="Reset"></div></td>

</tr>  

</table>

<input type="hidden" name="MM_insert" value="AddGuest">

</form>

</td></tr></table>

</body>

</html>