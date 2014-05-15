<?php 
require_once('../../Connections/db_link.php');

require_once('../includes/checkaccess.php');

mysql_select_db($database_db_link, $db_link);

$select_roomtype = "SELECT * FROM roomtypes";
$excute_roomtype = mysql_query($select_roomtype, $db_link) or die(mysql_error());
$row_result_roomtype_1 = mysql_fetch_assoc($excute_roomtype);
$totalRows_result_roomtype_1 = mysql_num_rows($excute_roomtype);

//if (isset($_POST['submit']))
//{
$roomtype = $_POST['roomtype'];

$query_roomtype = "SELECT * FROM roomtypes WHERE RoomType = '$roomtype' LIMIT 1";
$result_roomtype = mysql_query($query_roomtype, $db_link) or die(mysql_error());
$row_result_roomtype = mysql_fetch_assoc($result_roomtype);
$totalRows_result_roomtype = mysql_num_rows($result_roomtype);

$roomid = $row_result_roomtype['RoomTypeId'];
 
$query_rooms = "SELECT * FROM rooms WHERE RoomTypeId = '$roomid' AND Available = 'yes' ";
$result_rooms = mysql_query($query_rooms, $db_link) or die(mysql_error());
$row_result_rooms = mysql_fetch_assoc($result_rooms);
$totalRows_result_rooms = mysql_num_rows($result_rooms);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>available rooms</title>
<link href="../../lib/styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">

<table class="info_bar" cellspacing="5px" cellpadding="0px" width="100%" >

<tr>

<td class="info"></td>

<td class="info"><?php echo date("F d Y")?></td>

<td class="logout_box"><img src = "../../lib/images/online.png" > <?php echo $_SESSION['MM_Username']; ?></td>

</tr></table>

<div class="header">

<h1>Company name</h1>

<div id="header_shortcut">
<a href="../controlpanel/settings.php"><img src ="../../lib/images/controlpanel.png" > Control Panel </a></div>
</div>

<hr />

<div class="menu">
	
	<ul>

	<li class="home"><a href="../home.php"><span>Home</span></a></li>
	
	<li class="booking"><a href="../bookings.php"><span>Bookings</span></a> </li>

	<li class="list"><a href="../guestlist.php"><span>Guest List</span></a> </li>

	<li class="addActive"><a href="checkrooms.php"><span>Add Guest</span></a> </li>

	<li class="report"><a href="../"><span>Reports</span></a></li>

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
<h3>Check Available Rooms</h3>

<form name="check room" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<table width="454" border="0" align="center">

  <tr>
    <td align="right">Select Room Type </td>
    <td><select  name="roomtype">
      <?php
do {  
?>
      <option  value="<?php echo $row_result_roomtype_1['RoomType']?>"<?php if (!(strcmp($row_result_roomtype_1['RoomType'], $row_result_roomtype_1['RoomType'])))  ?>><?php echo $row_result_roomtype_1['RoomType']?></option>
      <?php
} while ($row_result_roomtype_1 = mysql_fetch_assoc($excute_roomtype));
  $rows = mysql_num_rows($excute_roomtype);
  if($rows > 0) {
      mysql_data_seek($excute_roomtype, 0);
	  $row_result_roomtype_1 = mysql_fetch_assoc($excute_roomtype);
  }
?>
    </select> 
     
      <input type="Submit" name="check" value="Check Available Rooms"> </td>
  </tr>
  </form>
  <?php if(isset($_POST['check'])) {?>
  <tr>
    <td colspan="2"><?php echo "<h4>", $row_result_roomtype['RoomType'],' ', "Rooms</h4>"; ?></td>
  </tr>
  <tr>
    <td colspan="2"><?php 
  //check if database has available rooms
  if ($totalRows_result_rooms == '0') {
  echo "<h4>","There are no",' ',$row_result_roomtype['RoomType'],' ',"Rooms available</h4>" ;  
		} 
	else 
		{
		echo "Select a Room Number" ;
		}
			?>
	</td>
  </tr>
  <tr>
  <?php
do {  ?>
    <td colspan="2">
 <a href="guestinfo.php?rno=<?php echo $row_result_rooms['RoomNo']; ?>&rt=<?php echo $row_result_roomtype['RoomType']; ?>"><?php echo $row_result_rooms['RoomNo']; ?></a></td>
  </tr>
    <?php } while ($row_result_rooms = mysql_fetch_assoc($result_rooms)); 
	}
	echo "</table>"; ?>
</td></tr></table>
</div>

</div>
</body>
</html>
