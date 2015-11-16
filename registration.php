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
   <form action='registration.php' method='post'>
   name<input name='name' value='".$_POST["name"]."'><br/>
   login<input name='login' value='".$_POST["login"]."'><br/>
   email<input name='email' value='".$_POST["email"]."'><br/>
   password<input name='password' type = 'password'><br/>
   confirm password<input name='password2' type = 'password'><br/>
	<input type='submit'><br/>";
}
else
{
	echo '
	<form action="registration.php" method="post">
    name<input name="name"><br/>
   login<input name="login"><br/>
   email<input name="email"><br/>
   password<input name="password" type = "password"><br/>
   confirm password<input name="password2" type = "password"><br/>
   <input type="submit"><br/>';
}
?>

<?php

if (isset($_POST["name"]))
{
	$flag = true;
   if ($_POST["name"] == "") {
	   echo 'name must not be empty<br/>';
	   $flag = false;
   }
   if ($_POST["login"] == "") {
	   echo 'login must not be empty<br/>';
	   $flag = false;
   }
   if ($_POST["email"] == "") {
	   echo 'email must not be empty<br/>';
	   $flag = false;
   } else
   if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo "E-mail указан не верно<br/>";
	$flag = false;
   }
   if ($_POST["password"] == "") {
	   echo 'password must not be empty<br/>';
	   $flag = false;
   }
   if ($_POST["password"] != $_POST["password2"]) {
	   echo 'confirm password<br/>';
	   $flag = false;
   }
   
   if ($flag) {
      $db = mysql_connect("127.0.0.1:3306","root","");
      mysql_select_db("lab2" ,$db);
	  $selectquery = mysql_query("SELECT login, email from d_user;");
	  $flag2 = true;
	  $flag3 = true;
      while ($arr=mysql_fetch_array($selectquery)) 
	  { 
	      if($_POST["login"] == $arr[0]) $flag2 = false;
		  if($_POST["email"] == $arr[1]) $flag3 = false;
	  }
      if($flag2 && $flag3)
	  {
          $query = "INSERT INTO d_user (name, login, email, password, status, never_notify) VALUES ('".$_POST["name"]."', '".$_POST["login"]."', '".$_POST["email"]."', '".$_POST["password"]."', 'Standart', 0);";
          $sql = mysql_query($query);
	  }
	  else if(!$flag2) echo "login is taken<br/>";
	  else if(!$flag3) echo "this email is already used<br/>";
	  mysql_close($db);
   }
}
?>
<a href="authorization.php">Авторизация</a><br/>
</form>
</body>
