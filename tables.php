<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>table overview for simple webapp...</title></head>

<body>
<h2>Home Grown MySQL-Manager</h2>
&copy; Douglas Chorpita - HRZ

<h2>Table Overview</h2>

<table border="4" bgcolor="#EEEEEE">
<tr>
  <td align='center'><b>Table name</b></td>
  <td align='center'><b>Rows</b></td>
  <td align='center'><b>Bytes</b></td>
  <td align='center'><b>Created</b></td>
  <td align='center'><strong>Changed</strong></td>
</tr>
<?php


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
   
$action = $_REQUEST['action'];  

if( $action == "del" )
{
	$tname = $_REQUEST['table'];
	$sql = "DROP TABLE " . $tname;
	$result = mysql_query( $sql );
} 

if( $action == "empty" )
{
	$tname = $_REQUEST['table'];
	$sql = "TRUNCATE TABLE " . $tname;
	$result = mysql_query( $sql );
} 

   
$sql = "SHOW TABLE STATUS FROM " . $database; 
$result = mysql_query($sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while( $row = mysql_fetch_row($result) ) 
   {
	echo "<tr><td align='center'><a href='table.php?table=";
    echo $row[0];
	echo "'>";
	echo $row[0];
	echo "</a></td><td align='center'>";
	echo $row[4];
	echo "</td><td align='center'>";
	echo $row[6];
	echo "</td><td align='center'>";
	echo $row[11];
	echo "</td><td align='center'>";
	echo $row[12];
	echo "</td></tr>";
   }
?>
</table>
<br/>
<form method="post" action="ctable1.php" autocomplete="off" name="ctable1_form">
<input type="submit" value="Create new table">
</form>	
</body>
</html>
