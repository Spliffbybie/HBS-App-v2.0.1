<?php 
 require_once('../includes/checkaccess.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Add Account</title>
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
<a href="controlpanel/settings.php"><img src="../../lib/images/controlpanel.png"> Control Panel </a></div>
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

<div class="leftPanel">

<ul class="sideMenu"><img src="../../lib/images/settings.gif">System Settings
<li>User Accounts Management</li>
	<ul>
	<li><a href="useraccounts.php" >View User Accounts</a></li>
	<li class="active"><a href="" >Add User Account</a></li>
	<li><a href="editaccount.php">Edit User Account</a></li>
	<li><a href="deleteaccount.php">Delete User Account</a></li>
	</ul>

</li>
<li>Room Management</li>
<li><a href="">Backup Database</a></li>
</ul>
</div>

<div class="content">
<?php include('../../lib/modules/addAccount.php'); ?>
</div>
  
</td></tr>
</table>
</body>
</html>