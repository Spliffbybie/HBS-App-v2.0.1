<?PHP
 require_once('../../Connections/db_link.php'); 

//include the main validation script
 require_once("../../includes/formvalidator.php");

 $show_form=true;

 if(isset($_POST['addinfo'])) {
 // The form is submitted
    //Setup Validations
    $validator = new FormValidator();
    $validator->addValidation("FirstName","req","Please fill in First Name");
	$validator->addValidation("LastName","req","Please fill in Last Name");
	$validator->addValidation("AddressTown","req","Please fill in Town");
	$validator->addValidation("Country","req","Please fill in Country");
	$validator->addValidation("AddressPostal","req","Please fill in Postal Address");
	$validator->addValidation("PhoneNumber1","req","Please fill in Phone number 1");
	$validator->addValidation("PhoneNumber2","req","Please fill in Phone number 2");
	$validator->addValidation("Email","email","The input for Email should be a valid email value");
    $validator->addValidation("Email","req","Please fill in Email");
    $validator->addValidation("IdNumber","req","Please fill in ID Number");
	$validator->addValidation("PlateNo","req","Please fill in Plate Number");
	$validator->addValidation("VehicleModel","req","Please fill in Vehicle Model");
	$validator->addValidation("DateIn","req","Please fill in Date-in");
	$validator->addValidation("DateOut","req","Please fill in Date-out");
	$validator->addValidation("Duration","req","Please fill in Duration");
	$validator->addValidation("NoAdults","req","Please fill in Number of Adults");
	$validator->addValidation("NoChildren","req","Please fill in Number of Children");

	//Now, validate the form

    if($validator->ValidateForm()) {
        /****************************************************************************************************
		*Validation success. 
        *Here we can proceed with processing the form 
        *saving to Database
        ****************************************************************************************************/ 
        echo "<h2>Validation Success!</h2>";
		
        $show_form=false;
		
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
	$currMonth = date("F");
	$insert_booking = sprintf("INSERT INTO reservations (CustomerId, RoomNo, RoomType, DateIn, DateOut, Duration, Month, NoAdults, NoChildren) VALUES ($cgid, %s, %s, %s, %s, %s, '$currMonth', %s, %s)",
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
	$insert_guest = sprintf("INSERT INTO guest (GuestId, GuestTitle, FirstName, LastName, AddressTown, AddressPostalCode, AddressCountry, PhoneNumber1, PhoneNumber2, GuestEmail ) VALUES ($cgid, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['AddressTown'], "text"),
					    GetSQLValueString($_POST['AddressPostal'], "text"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['PhoneNumber1'], "text"),
                       GetSQLValueString($_POST['PhoneNumber2'], "text"),
					   GetSQLValueString($_POST['Email'], "text"));

  mysql_select_db($database_db_link, $db_link);
  $Result_guest = mysql_query($insert_guest, $db_link) or die('error ADD Guest' . mysql_error());
	
	$t=$_POST['Title']; $fn=$_POST['FirstName']; $ln=$_POST['LastName'];
	
  $insertGoTo = "feedback.php?rno=$roomNo&rt=$roomType&t=$t&fn=$fn&ln=$ln&d=$d";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
    }
    else
    {
		echo'<div class="error_box">';
		echo '<p><img src="../../lib/images/sad_face.png" /><br /><b>ERROR: INVALID ENTRY</b></p>';
		echo '<p>OOPS Something went wrong</p>';
		

        $error_hash = $validator->GetErrors();
        foreach($error_hash as $inpname => $inp_err)
        {
            echo "<p>$inpname : $inp_err<br/>";
			
        }        
    }echo "</div>";
}//if(isset($_POST['Submit']))

 if(true == $show_form)
 {
?>

<h3>Add Guest</h3>

<form name="AddGuest" method="POST" action="<?php $editFormAction; ?>" >

<table width="742" border="0" align="center">

  <tr>

    <th colspan="4">Guest Information <div id="status">Guest Status:<select name="Status">
      <option value="In">In</option>
      <option value="Pending">Pending</option>
    </select>
	</div></th>
      </tr>

  <tr>

    <td id="row-title">Title</td>

    <td><select name="Title">
      <option value="Dr.">Dr.</option>
      <option value="Mr.">Mr.</option>
      <option value="Mrs.">Mrs.</option>
      <option value="Ms.">Ms.</option>
    </select></td>

    <td id="row-title">Membership</td>

	<td><select name="Membership" size="1">
      <option>Yes</option>
      <option>No</option>
    </select></td>
  </tr>

  <tr>

    <td id="row-title">First Name </td>

    <td><input name="FirstName" type="text" maxlength="20"></td>

    <td id="row-title">Last Name</td>

    <td><input name="LastName" type="text" maxlength="20"></td>

  </tr>

  <tr>
  	 
    <td width="160" id="row-title">Town</td>
 
    <td width="220"><input name="AddressTown" type="text" maxlength="20"></td>
 
    <td width="146" id="row-title">Country</td>
 
    <td width="198"><input name="Country" type="text" maxlength="20"></td>
 
  </tr>
 
  <tr>
 
    <td id="row-title">Postal Code</td>
 
    <td><textarea name="AddressPostal" rows="2" maxlength="30" ></textarea></td>
 
    <td id="row-title">Email</td>
 
    <td id="eg"><input name="Email" type="text"><br/>
	eg. yourname@email.com</td>
  </tr>
 
  <tr>
 
    <td id="row-title">Phone Number1</td>
 
    <td><input name="PhoneNumber1" type="text" maxlength="20"></td>
 
    <td id="row-title">Phone Number2:</td>
 
    <td><input name="PhoneNumber2" type="text" maxlength="20"></td>
 
  </tr>
 
  <tr>
 
    <th colspan="4" align="center">Room Information</th>`
	   
  </tr>
  
  <tr>
  
    <td id="row-title">Room Number:</td>
  
    <td><?php echo $roomNo; ?></td>
  
    <td id="row-title">Room Type:</td>
  
    <td><?php echo $roomType; ?></td>
  
  </tr>
  
  <tr>
  
    <td id="row-title">Date In</td>
  
    <td id="eg"><input name="DateIn" type="text" maxlength="10"><br />YYYY-MM-DD</td>
  
    <td id="row-title">Date Out</td>
  
    <td id="eg"><input name="DateOut" type="text" maxlength="10"><br />YYYY-MM-DD</td>
  
  </tr>
  
  <tr>
  
    <td id="row-title">Duration (Days)</td>
  
    <td><input name="Duration" type="text" maxlength="3" size="4"></td>
  
    <td id="row-title">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <td id="row-title">No. of Adults</td>
  
    <td><input name="NoAdults" type="text" maxlength="2" size="4"></td>
  
    <td id="row-title">No. of Children</td>
  
    <td><input name="NoChildren" type="text" maxlength="2" size="4"></td>
  
  </tr>
  
  <tr>
  
    <th colspan="4">Indentification Information </th>
  
     </tr>
  
  <tr>
  
    <td id="row-title">ID Type </td>
  
    <td><select name="IdType">
      <option>Driving License</option>
      <option>Passport</option>
    </select></td>
  
    <td id="row-title">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <td id="row-title">ID Number </td>
  
    <td><input name="IdNumber" type="text" maxlength="20"></td>
  
    <td id="row-title">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <th colspan="4">Vehicle Information</th>
  
    <td id="row-title">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <td id="row-title">Vehicle</td>
  
    <td>
      <select name="Vehicle">
        <option>Car</option>
        <option>Motorcycle</option>
		<option>None</option>
      </select>    </td>
  
    <td id="row-title">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <td id="row-title">Vehicle Model </td>
  
    <td>
      <input name="VehicleModel" type="text" maxlength="20">    </td>
  
    <td id="row-title">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <td id="row-title">Plate Number </td>
  
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
<?PHP
}//true == $show_form
?>

