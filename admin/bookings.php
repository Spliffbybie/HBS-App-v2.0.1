<?php
 require_once('includes/checkaccess.php');
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>reservation</title>
<link href="../lib/styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />

<script>
function showBooking(str) {

if (str=="") {
	document.getElementById("display").innerHTML="";
	return;
	}
	if (window.XMLHttpRequest) {
	//code for IE7, Firefox, Chrome, Opera Safari
	xmlhttp=new XMLHttpRequest();
	}
	else {
	xmlhttp=new ActiveXobject ("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	document.getElementById("display").innerHTML=xmlhttp.responseText;
	}
}
xmlhttp.open ("GET", "../lib/modules/viewBookings.php?q="+str,true);
xmlhttp.send();
}
</script>

</head>

<body>

<div class="container">

<table class="info_bar" cellspacing="5px" cellpadding="0px" width="100%" >

<tr>

<td class="info"></td>

<td class="info"><?php echo date("F d Y")?></td>

<td class="logout_box"><img src = "../lib/images/online.png" > <?php echo $_SESSION['MM_Username']; ?> | <a href="<?php echo $logoutAction ?>"class="linkAsButton"><span>Log out</span></a></td>

</tr></table>

<div class="header">

<h1>Company name</h1>

<div id="header_shortcut">

<a href="controlpanel/settings.php"><img src ="../lib/images/controlpanel.png" > Control Panel </a></div>
</div>

<hr />

<div class="menu">
	
	<ul>

	<li class="home"><a href="home.php"><span>Home</span></a></li>

	<li class="bookingActive"><a href="bookings.php"><span>Bookings</span></a> </li>

	<li class="list"><a href="guestlist.php"><span>Guest List</span></a> </li>

	<li class="add"><a href="addguest/checkrooms.php"><span>Add Guest</span></a> </li>

	<li class="report"><a href=""><span>Reports</span></a></li>

</ul></div>

<br/>

<table border="0" width="100%" class="mainPanel" cellspacing="0">

<tr><td valign="top" class="leftPanel" >
<div class="cell">
<h3>Room Information</h3>
<?php include("../_iframe/iframe_rooms.php"); ?>
</div>

<br />

<div class="cell">

    <div id="cell-calendar">	
    </div>
</div>


</td>

<td valign="top" class="rightPanel">

<div class="cell">
<h3>Bookings</h3> 
<form>
<select name="view" onChange="showBooking(this.value)" >
<option value="">Select View Mode</option>
<option value="All">All</option>
<option value="Today">Today</option>
<option value="Month">Month</option>
</select>
</form>
<div id ="display"></div>
</div>
</td></tr></table>
</div>
</body>
</html>
<?php
//mysql_free_result($reservations);
?>
