<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">
<title>Open Server</title>
</head>
<body>
<?php
if (isset($_POST["name"]))
{
	echo "
   <form action='authorization.php' method='post'>
   name<input name='login' value='".$_POST["login"]."'><br/>
   password<input name='password' type = 'password'><br/>
	<input type='submit' ><br/>";
}
else
{
	echo '
	<form action="authorization.php" method="post">
   login<input name="login"><br/>
   password<input name="password" type = "password"><br/>
   <input type="submit"><br/>';
}
?>
<?php
if (isset($_POST["login"]))
{
      $db = mysql_connect("127.0.0.1:3306","root","");
      mysql_select_db("lab2" ,$db);
	  $selectquery = mysql_query("SELECT login, password from d_user WHERE login='".$_POST["login"]."';");
	  $flag = false;
      while ($arr=mysql_fetch_array($selectquery)) 
	  { 
	      if($_POST["login"] == $arr[0] && $_POST["password"] == $arr[1]) $flag = true;
	  }
	  if($flag)
	  {
		  $_SESSION["login"] = $_POST["login"];
		  echo '<script type="text/javascript">'; 
          echo 'window.location.href="calendar.php";'; 
          echo '</script>'; 
	  }
	  else
	  {
		  echo "login/password incorrect<br/>";
	  }
	  mysql_close($db);
}
?>
<a href="registration.php">Регистрация</a><br/>
<a href="forgotpassword.php">Забыли пароль?</a><br/>
</body>
