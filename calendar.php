<!DOCTYPE html>
<html>
<head>
<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">
<title>Open Server</title>
</head>
<body>
<form action="calendar.php" method="post">
<select name="year">
<?php
for ($i=1970; $i<=2038; $i++) echo "<option>".$i."</option>";
?>
</select>
<select name="month">
<?php
for ($i=1; $i<=12; $i++) echo "<option>".$i."</option>";
?>
</select>
<input type="submit">
</form>
<?php

if (isset($_POST["year"]))
{
$timestamp = mktime(1,0,0,$_POST["month"],1,$_POST["year"]);
$startDay = Date("N", $timestamp);
$lastDay = Date("t", $timestamp);
?>
<table>
<tr>
<td>Пн</td><td>Вт</td><td>Ср</td><td>Чт</td><td>Пт</td><td>Сб</td><td>Вс</td>
</tr>
<?php
$currDay=1;
for ($i=0; $i<6; $i++)
{
echo "<tr>";
   for ($j=0; $j<7; $j++)
   {
      echo "<td>";
	  if (!($i == 0 && $j < ($startDay - 1) || $currDay > $lastDay))
	  {
	     echo $currDay;
		 $currDay++;
	  }
	  echo "</td>";
   }
echo "</tr>";
}
?>
</table>
<?php
}
?>
</body>
