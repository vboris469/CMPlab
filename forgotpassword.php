<!DOCTYPE html>
<html>
<head>
<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">
<title>Open Server</title>
</head>
<body>
<form action='forgotpassword.php' method='post'>
   email<input name='email'><br/>
	<input type='submit'><br/>
	</form>
	<?php
if (isset($_POST["email"]))
{
	$db = mysql_connect("127.0.0.1:3306","root","");
      mysql_select_db("lab2" ,$db);
	  $selectquery = mysql_query("SELECT email, password from d_user;");
	  $flag = false;
      while ($arr=mysql_fetch_array($selectquery)) 
	  { 
	      if($_POST["email"] == $arr[0])
		  {
			  $flag = true;
			  $pass = $arr[1];
			  break;
		  }
	  }
	  if($flag) 
	  {
		  $issent = mail($_POST["email"], "Password recover", "Your password is ".$pass);
		  if ($issent)
		  echo "your password was sent on your email<br/>";
	      else echo "cant send email<br/>";
	  }
	  else echo "this email does not exists<br/>";
	  mysql_close($db);
}
?>
<a href="authorization.php">Назад</a><br/>
</body>
