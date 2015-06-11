<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Attribute definieren</title>
</head>

<body>
<h2>Home Grown MySQL-Manager</h2>
&copy; Douglas Chorpita - HRZ
<?php

include( "constants.php" );

$loop = $_REQUEST['numfields'];

echo "<h2>Define attributes of table <i>" . $_REQUEST['tname'] . "</i></h2>";

echo "<form method='post' action='table.php?table=";
echo $_REQUEST['tname'];
echo "&num=";
echo $_REQUEST['numfields'];
echo "' autocomplete='off' name='ctable2_form'>";
?>

<table bgcolor="#EEEEEE" width="400" border="4">
<tr><td><b>Attribute Name</b> </td><td> <b>Data Type </b></td><td> <b>Length</b></td><td> <b>Primary Key?</b></td></tr>

<?php
for( $i = 0; $i < $loop; $i++)
{
	echo "<tr><td><input name='attr";
	echo $i;
	echo "' id='attr";
	echo $i;
	echo "' value='' size='17' type='text'></td><td><select name ='dtype";
	echo $i;
	echo "'>";
	foreach ($sql_dtypes as $value)
	{
		echo "<option>";
		echo $value;
	}
	echo "</select></td><td><input name='length";
	echo $i;
	echo "' id='length";
	echo $i;
	echo "' value='' size='3' type='text'></td><td align='center'><input name='prim";
	echo $i;
	echo "' id='prim";
	echo $i;
	echo "' type='checkbox' value='0'></td><tr>";
}
?>
</table>
<p/><p/>
<table><tr><td>

<p><input type="submit" value="Save"></p>
</form>
</td>
<td>
<form method="post" action="tables.php" autocomplete="off" name='abort_form'>
<input type="submit" value="Cancel">
</form>
</td></tr></table>
</body>
</html>
