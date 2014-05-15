<h3>Guest List</h3>

<table width="920px" border="0" cellspacing="0px">
  <tr>
    <th>GuestTitle</th>
    <th>FirstName</th>
    <th>LastName</th>
    <th>AddressCountry</th>
    <th>PhoneNumber1</th>
    <th>PhoneNumber2</th>
  </tr>
<?php 
 require_once('../Connections/db_link.php'); 
 
 $maxRows_guestlist = 10;
 $pageNum_guestlist = 0;
 
 if (isset($_GET['pageNum_guestlist'])) {
 
  $pageNum_guestlist = $_GET['pageNum_guestlist'];
 }
 
 $startRow_guestlist = $pageNum_guestlist * $maxRows_guestlist;

 mysql_select_db($database_db_link, $db_link);

 $query_guestlist = "SELECT guest.GuestId, guest.GuestTitle, guest.FirstName, guest.LastName,  guest.AddressCountry, guest.PhoneNumber1, guest.PhoneNumber2 FROM guest";

 $query_limit_guestlist = sprintf("%s LIMIT %d, %d", $query_guestlist, $startRow_guestlist,  $maxRows_guestlist);
 
 $guestlist = mysql_query($query_limit_guestlist, $db_link) or die(mysql_error());
 
 $row_guestlist = mysql_fetch_assoc($guestlist);

 if (isset($_GET['totalRows_guestlist'])) {
 
  $totalRows_guestlist = $_GET['totalRows_guestlist'];
 } 
 else {
 
  $all_guestlist = mysql_query($query_guestlist);
 
  $totalRows_guestlist = mysql_num_rows($all_guestlist);
 }
 
 $totalPages_guestlist = ceil($totalRows_guestlist/$maxRows_guestlist)-1;
 
//check if database has records

  if ($totalRows_guestlist == '0') {
  			echo "<div class ='notification_box'>";
			echo "<p><img src ='../lib/images/info.png'> There are no records of any guest.</p>";
			echo "</div>";
 	}

	else {
    		do { ?>
    <tr class="row-1">
     
      <td><?php echo $row_guestlist['GuestTitle']; ?></td>

      <td><a href="viewguest.php?gno=<?php echo $row_guestlist['GuestId']; ?>"><?php echo $row_guestlist['FirstName']; ?></a></td>

      <td><?php echo $row_guestlist['LastName']; ?></td>

      <td><?php echo $row_guestlist['AddressCountry']; ?></td>

      <td><?php echo $row_guestlist['PhoneNumber1']; ?></td>

      <td><?php echo $row_guestlist['PhoneNumber2']; ?></td>

    </tr>

    <?php } while ($row_guestlist = mysql_fetch_assoc($guestlist)); 
	}
?>
</table>