<?php
require_once('../includes/checkaccess.php');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>System Configuration</title>
<link href="../../lib/styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />

</head>

<body>

<table class="container" align="center">

<tr><td>

<table class="info_bar" cellspacing="5px" cellpadding="0px" width="920px" >

<tr>

<td class="info"></td>

<td class="info"><?php echo date("F d Y")?></td>

<td class="logout_box"><img src = "../../lib/images/online.png" > <?php echo $_SESSION['MM_Username']; ?></td>

</tr></table>

<div class="header">

<h1>Company Name</h1>

<div id="header_shortcut">
<a href="settings.php"><img src="../../lib/images/controlpanel.png"> Control Panel </a></div>
</div>

<hr />

<div class="menu">
	
	<ul>

	<li class="home"><a href="../home.php"><span>Home</span></a></li>

	<li class="booking"><a href="../bookings.php"><span>Bookings</span></a> </li>

	<li class="list"><a href="../guestlist.php"><span>Guest List</span></a> </li>

	<li class="add"><a href="../addguest/checkrooms.php"><span>Add Guest</span></a> </li>

	<li class="report"><a href=""><span>Reports</span></a></li>

</ul></div>

<br/>

<h3><img src="../../lib/images/controlpanel.png">Control Panel </h3>

<div class="menuPanel" align="center">

<ul class="settingsMenu"><img src="../../lib/images/settings.gif">System Settings

<li>User Accounts Management</li>
	<ul>
	<li class="linkAsButton"><a href="useraccounts.php"><span><img src="../../lib/images/useraccount.png"> View User Accounts</span></a></li>

	<li class="linkAsButton"><a href="addaccount.php"><span><img src="../../lib/images/addaccount.png"> Add User Account</span></a></li>

	<li class="linkAsButton"><a href="editaccount.php"><span><img src="../../lib/images/editaccount.png"> Edit User Account</span></a></li>

	<li class="linkAsButton"><a href="deleteaccount.php"><span><img src="../../lib/images/deleteaccount.png"> Delete User Account</span></a></li>
	</ul>

</li>

<li>Room Managemen</li>

<li><a href="">Backup Database</a></li>

</ul>

</div>

</td></tr></table>

</body>

</html>