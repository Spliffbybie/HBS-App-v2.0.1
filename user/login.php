<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Home | Login</title>
<link href="../lib/styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>

<table class="container" align="center">
<tr><td>

<h1>Company name</h1>

<hr />

<?php 
function redirectToHTTPS()
{
if($_SERVER['HTTPS']!="on")
	{
	$redirect="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header("Location:$redirect");
	}
}
//redirectToHTTPS();

require_once('../connections/db_link.php');

// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['UserName'])) {
  $loginUsername=$_POST['UserName'];
  $password=$_POST['Password'];
  $MM_fldUserAuthorization = "User_type";
  $MM_redirectLoginSuccess = "home.php";
  $MM_redirectLoginFailed = "../index.html";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_db_link, $db_link);
  	
  $LoginRS__query=sprintf("SELECT login_alias, login_password, User_type FROM sys_users WHERE login_alias='%s' AND login_password='%s'",
  get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), md5($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $db_link) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'User_type');
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
   // header("Location: ". $MM_redirectLoginFailed );
	echo'<div class="error_box">';
	echo '<p><img src="../lib/images/sad_face.png" /><br />ERROR LOGIN CREDENTIALS</p>';
	echo '<p>OOPS Something went wrong<br />';
	echo 'Please enter your Username and Password correctly</p>';
	echo '</div>';
  }
}
?>


<div align="center">

<form action="<?php echo $loginFormAction; ?>" name="LoginForm" method="POST">

<fieldset>

	<table border="0" cellpadding="6" cellspacing="1" width="400px">

<tr>
	<th colspan="2"><img src ="../lib/images/User.ico" />USER LOGIN <img src ="../lib/images/lock.ico" align="right" /></th>
</tr>

<tr>
	<td align="right">Username</td>
	<td><input class="field" type="text" name="UserName" title="Username" size="25" maxlength="15"></td>
</tr>
<tr>
	<td align="right">Password</td>

	<td><input class="field" type="password" name="Password" Title="Password" size="25" maxlength="15"></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td>
		<span class="button"><input class="submit" type="submit" name="login" value="Login" title="Login"></span>
		<a href="../index.html" class="linkAsButton"><span>CANCLE</span></a>
	</td>
</tr>
</table></fieldset>
</form>
</div>	
</td></tr></table>
</body>
</html>
