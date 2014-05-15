<?php
 require_once('../../Connections/db_link.php'); 
 require_once('../includes/checkaccess.php');

 mysql_select_db($database_db_link, $db_link);
 $query_admins = "SELECT sys_admins.admin_id, sys_admins.First_name, sys_admins.Last_name, Email, sys_admins.login_alias, sys_admins.User_type FROM sys_admins";
 $admins = mysql_query($query_admins, $db_link) or die(mysql_error());
 $row_admins = mysql_fetch_assoc($admins);
 $totalRows_admins = mysql_num_rows($admins);

 mysql_select_db($database_db_link, $db_link);
 $query_users = "SELECT sys_users.User_id, sys_users.First_name, sys_users.Last_name, Email, login_alias, sys_users.User_type FROM sys_users";
 $users = mysql_query($query_users, $db_link) or die(mysql_error());
 $row_users = mysql_fetch_assoc($users);
 $totalRows_users = mysql_num_rows($users);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Edit Account</title>
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
<a href="settings.php"><img src="../../lib/images/controlpanel.png"> Control Panel </a></div></div>

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
	<li><a href="addaccount.php">Add User Account</a></li>
	<li class="active"><a href="" >Edit User Account</a></li>
	<li><a href="deleteaccount.php">Delete User Account</a></li>
	</ul>

</li>
<li>Room Management</li>
<li><a href="">Backup Database</a></li>
</ul>
</div>

<div class="content">

  <table border="0" width="650px">
    <tr>
      
      <th>First Name</th>
      <th>Last Name</th>
	  <th>Email</th>
      <th>User Type</th>
	  <th>Login Alias</th>
    </tr>
    <?php do { ?>
      <tr>
        
        <td><?php echo $row_admins['First_name']; ?></td>
        <td><?php echo $row_admins['Last_name']; ?></td>
		<td><?php echo $row_admins['Email']; ?></td>
        <td><?php echo $row_admins['User_type']; ?></td>
		<td><?php echo $row_admins['login_alias']; ?></td>
   		<td><a href ="editadmin.php?aid=<?php echo $row_admins['admin_id']; ?>&ut=<?php echo $row_admins['User_type']; ?>"><img src="../../lib/images/edit.png"> Edit</a></td>
      <?php } while ($row_admins = mysql_fetch_assoc($admins)); ?>
  </table>
   <table border="0" width="650px">
    <tr>
      
      <th>First Name</th>
      <th>Last name</th>
	  <th>Email</th>
      <th>User Type</th>
	  <th>Login Alias</th>
    </tr>
    <?php do { ?>
      <tr>

        <td><?php echo $row_users['First_name']; ?></td>
        <td><?php echo $row_users['Last_name']; ?></td>
		<td><?php echo $row_users['Email']; ?></td>
        <td><?php echo $row_users['User_type']; ?></td>
		<td><?php echo $row_users['login_alias']; ?></td>
		<td><a href ="edituser.php?id=<?php echo $row_users['User_id']; ?>&ut=<?php echo $row_users['User_type']; ?>"><img src="../../lib/images/edit.png"> Edit</a></td>
      </tr>
      <?php } while ($row_users = mysql_fetch_assoc($users)); ?>
  </table>
</div>
</td></tr></table>
</body>
</html>