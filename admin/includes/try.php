<?php require_once('../../Connections/db_link.php'); ?>
<?php
mysql_select_db($database_db_link, $db_link);
$query_idtype = "SELECT customers.IdType FROM customers WHERE CustomerId ='3'";
$idtype = mysql_query($query_idtype, $db_link) or die(mysql_error());
$row_idtype = mysql_fetch_assoc($idtype);
$totalRows_idtype = mysql_num_rows($idtype);


//login status session 
	require_once('../adminConnections/db_link.php');

?>
<html>
<head>
<title>tryout</title>
</head>
<body>

<table>
<tr>
    <td align="right">ID Type </td>
    <td><select name="IdType">
      <option value="1" <?php if (!(strcmp(1, $row_idtype['IdType']))) {echo "selected=\"selected\"";} ?>>Driving License</option>
      <option value="2" <?php if (!(strcmp(2, $row_idtype['IdType']))) {echo "selected=\"selected\"";} ?>>Passport</option>
      <?php
do {  
?>
      <option value="<?php echo $row_idtype['IdType']?>"<?php if (!(strcmp($row_idtype['IdType'], $row_idtype['IdType']))) {echo "selected=\"selected\"";} ?>><?php echo $row_idtype['IdType']?></option>
      <?php
} while ($row_idtype = mysql_fetch_assoc($idtype));
  $rows = mysql_num_rows($idtype);
  if($rows > 0) {
      mysql_data_seek($idtype, 0);
	  $row_idtype = mysql_fetch_assoc($idtype);
  }
?>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($idtype);
?>