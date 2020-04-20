<!DOCTYPE html>
<html>
<head>
	<title>List of Supported Timezones</title>
	<style>
        table, th, td {
          border: 1px solid black;
        }
    </style>
</head>
<body>
<table style="width:100%">
  <tr>
    <th>Code</th>
    <th>Name</th>
    <th>Code</th>
    <th>Name</th>
    <th>Code</th>
    <th>Name</th>
    <th>Code</th>
    <th>Name</th>
    <th>Code</th>
    <th>Name</th>
  </tr>
  <tr>
<?php
include "time_z.php";
$k=0;
while($k<=583)
{
    echo "<td>";
    echo $k;
    echo "</td><td>";
	echo $time_zones[$k];
	echo "</td>";
	$k++;
	if($k%5==0)
	{
	    echo "</tr><tr>";
	}
}
?>
</table>
</body>
</html>