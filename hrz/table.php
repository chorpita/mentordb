<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$tname = $_REQUEST['table'];
$attrs = $_REQUEST['num'];
$action = $_REQUEST['action'];
echo "<title>Tabelle: " . $tname . " </title>";
?>
</head>

<body>
<h2>MySQL-Manager</h2>
&copy; douglas chorpita - fachbereich neuere philologien - johann wolfgang goethe universität - frankfurt am main
<?php
echo "<h2>Tabelle: <i>" . $tname . "</i></h2>";

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
   
if( $attrs > 0 ) 
{
	$primFound = false;
	$sql = "CREATE TABLE " . $tname . " ( ";
	for ( $i = 0; $i < $attrs; $i++ )
	{
		$attrib_i = "attr" . $i;
		$datype_i = "dtype" . $i;
		$length_i = "length" . $i;
		$prmkey_i = "prim" . $i;
		
		$attr = $_REQUEST[ $attrib_i ];
		$dtype = $_REQUEST[ $datype_i ];
		$len = $_REQUEST[ $length_i ];
		$prim = $_REQUEST[ $prmkey_i ];
		
		$sql .= $attr . " " . $dtype . "( " . $len . " )";
		
		if( ! $primFound )
		    if ( $prim != "" )
    		{
			   $sql .= " NOT NULL AUTO_INCREMENT, PRIMARY KEY (" . $attr . ")";
			   $primFound = true;
		    }
		
		if( $i < $attrs - 1 )
			$sql .= ", ";
	}
	$sql .= ")";
	
   $created = mysql_query( $sql, $con );
   
   if( ! $created )
   {
	   echo "ERROR: mit SQL-Command '" . $sql . "'<br/><br/>";
	   echo "Could not create table: " . mysql_error();  
   }
}


$sql = "SHOW COLUMNS FROM " . $tname;
$columns = mysql_query( $sql, $con );

$sum = 0; 
if( $columns )
{
   while( $col = mysql_fetch_row( $columns ) ) 
   {
	 $colNames[ $sum ] = $col[ 0 ];
	 $colPrim[ $sum ] = $col[ 3 ];
     $sum++; 
   }
}


if( $action == "insert" )
{
	$sql = "INSERT INTO " . $tname . " (";
	
	$sql .= $colNames[ 0 ];
	
	for( $i = 1; $i < $sum; $i++ )
	{
	   $sql .= ", ";
	   $sql .= $colNames[ $i ];
    }
	
	$sql .= ") VALUES ('";
	
	$sql .= $_REQUEST['val0'];
	
	for( $i = 1; $i < $sum; $i++ )
	{
       $val_i = "val" . $i;
	   $sql .= "', '" . $_REQUEST[ $val_i ];
	}
	$sql .= "')";
	
	$result = mysql_query( $sql, $con );
}

if( $columns )
{
   echo "<table border='4' bgcolor='#EEEEEE'><tr>";
   for( $i = 0; $i < $sum; $i++ )
   {
		echo "<td align='center'><b>";
        echo $colNames[ $i ];
		echo "</b>";
		if( $colPrim[ $i ] == "PRI" )
		   echo "<img src='prim_key.gif'>";
		echo "</td>";
   }
   echo "</tr>";
   $count = 0;
   $sql = "SELECT * FROM " . $tname;
   $result = mysql_query( $sql, $con );
   while( $row = mysql_fetch_array( $result ) ) 
   {
 		echo "<tr>";
		for( $i = 0; $i < $sum; $i++ )
		{
			echo "<td align='center'>";
			$val = $row[ $colNames[ $i ] ];
			if( $val == "" )
    			echo "NULL";
			else
        	    echo $val;
			echo "</td>";
		}
		echo "</tr>";
	$count++;
   }
   echo "</table>";
}
else
{
   echo "ERROR: no columns found!";
}
?>

<p/>
<p/>
<table>
<tr>
<td>
<?php
echo "<form method='post' action='crow.php?table=";
echo $tname;
echo "' autocomplete='off' name='createrow_form'>";
echo "<input name='createrow' type='submit' value='Neue Reihe hinzufügen'  /></form>";
?>
</td>
<td>
<form method="post" action="tables.php" autocomplete="off" name="tableview_form">
<input name="tableview" type="submit" value="Tabellenübersicht"  />
</form>
</td>
<td>
<?php
echo "<form method='post' action='dtable.php?table=";
echo $tname;
echo "' autocomplete='off' name='deletetable_form'>";
echo "<input name='deletetable' type='submit' value='Tabelle löschen'  /></form>";
?>
</td>
</tr>
</table>
</body>
</html>
