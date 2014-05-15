<?php
 require_once('../../Connections/db_link.php'); 

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
	  <td><a href ="deleteuser.php?id=<?php echo $row_admins['admin_id']; ?>&ut=<?php echo $row_admins['User_type']; ?>"><img src="../../lib/images/del.png"> Delete</a></td>
      </tr>
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
	  <td><a href ="deleteuser.php?id=<?php echo $row_users['User_id']; ?>&ut=<?php echo $row_users['User_type']; ?>"><img src="../../lib/images/del.png"> Delete</a></td>
      </tr>
      <?php } while ($row_users = mysql_fetch_assoc($users)); ?>
  </table>