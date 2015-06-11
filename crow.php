<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Neue Reihe hinzufügen</title>
</head>

<body>
<h2>Home Grown MySQL-Manager</h2>
&copy; Douglas Chorpita - HRZ

<?php
$tname = $_REQUEST['table'];
echo "<h2>Add a new row to table <i>" . $tname . "</i></h2>";


    $host_name  = "db579646725.db.1and1.com";
    $database   = "db579646725";
    $user_name  = "dbo579646725";
    $password   = "applebase";

    $con = mysql_connect( $host_name, $user_name, $password, $database );

if( ! $con )
   die( "Could not connect: " . mysql_error() );
   
$selected = mysql_select_db( $database, $con );   

if( ! $selected )
   die( "Could not connect: " . mysql_error() );

echo "<form method='post' action='table.php?table=";
echo $tname;
echo "&action=insert' autocomplete='off' name='save_form'>";
?>
<table bgcolor="#EEEEEE" border="4">

<?php
$sql = "SHOW COLUMNS FROM " . $tname;
$columns = mysql_query( $sql, $con );
$i = 0;
while( $col = mysql_fetch_row( $columns ) ) 
{
	echo "<tr>";
	echo "<td><b>";
	echo $col[ 0 ];
	echo "</b></td>";
	echo "<td>";
	if( $col[ 3 ] == "PRI" )
	{
		echo "<img src='prim_key.gif'>";
	}
	else
	{
		echo "<input name='val";
		echo $i;
		echo "' id='val";
		echo $i;
		echo "' value='' size='50' type='text'>";
	}
	echo "</td>";
	echo "</tr>";
	$i++;
}
?>
</table>
<p/><p/>
<table>
<tr>
<td>

<input name="yes" type="submit" value="Add row"  />
</form>
</td>
<td>
<?php
echo "<form method='post' action='table.php?table=";
echo $tname;
echo "' autocomplete='off' name='no_form'>";
echo "<input name='no' type='submit' value='Cancel'  /></form>";
?>
</td>
</tr>
</table>
</body>
</html>
