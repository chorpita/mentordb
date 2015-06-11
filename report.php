<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<h2>Home Grown MySQL-Manager</h2>
&copy; Douglas Chorpita - HRZ

<?php
    $host_name  = "db579646725.db.1and1.com";
    $database   = "db579646725";
    $user_name  = "dbo579646725";
    $password   = "applebase";

	$mysqli = new mysqli(  $host_name, $user_name, $password, $database );

	if( $mysqli->connect_errno ) 
	    die( "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error );
	
	echo "<h1>People</h1> <ul>";
	
	$sql = "SHOW TABLE STATUS FROM " . $database; 
	$result = $mysqli->query( $sql );
	 	
	
   $result = $mysqli->query( "SELECT person_id FROM person" );
   $people = array(); 
   $fns = array();
   $lns = array();
   $joins = array();
   $i = 0;
   while( $row = $result->fetch_assoc() ) 
   		$people[ $i++ ] = $row[ "person_id" ];
		
   $stmt1 = $mysqli->prepare( "SELECT first_name, last_name FROM person where person_id=?" );
   if( !$stmt1 )
		echo "Prepare failed!";
		
   $num = count( $people );
   for( $i = 0; $i < $num; $i++ )
   {
        $fname = NULL;
		$lname = NULL;
		$mid   = NULL;
		$stmt1->bind_param( "i", $people[ $i ] );
		$stmt1->execute();
		$stmt1->bind_result( $fname, $lname );
		$stmt1->fetch();
		$fns[ $i ] = $fname;
		$lns[ $i ] = $lname;
	}   			
   $stmt1->close();
   
   $stmt2 = $mysqli->prepare( "SELECT mentor_id FROM pm_join where person_id=?" );	
   if( !$stmt2 )
		echo "Prepare failed!";
   
   for( $i = 0; $i < $num; $i++ )
   {
   		$joins[ $i ] = array();
		echo "<li><b>   " . $fns[ $i ] . " " . $lns[ $i ] . "</b></li>";
		echo "<ul> <li> has mentors ";
		$stmt2->bind_param( "i", $people[ $i ] );
		$stmt2->execute();
		$stmt2->bind_result( $mid );
//		$j = 0;
//		while( 	$stmt2->fetch() ) {
//			$joins[ $i ][ $j ] = $mid;
//			echo $mid . " - ";
//			$j++;
//		}
		echo "</li>";
		echo "<li> has interests </li> </ul>";
   }
   $stmt2->close();
   
//   $stmt3 = $mysqli->prepare( "SELECT first_name, last_name FROM mentor WHERE person_id=?" );	
//   if( !$stmt3 )
//		echo "Prepare failed!";
   
   echo "</ul>";	

	echo "<h1>Mentors</h1> <ul>";

   $result = $mysqli->query( "SELECT mentor_id FROM mentor" );
   $mentors = array(); 
   $fns = array();
   $lns = array();
   $i = 0;
   while( $row = $result->fetch_assoc() ) 
   		$mentors[ $i++ ] = $row[ "mentor_id" ];
   
   $stmt1 = $mysqli->prepare( "SELECT first_name, last_name FROM mentor WHERE mentor_id=?" );
   if( !$stmt1 )
		echo "Prepare failed!";
		
   $stmt2 = $mysqli->prepare( "SELECT person_id FROM pm_join WHERE mentor_id=?" );	
   if( !$stmt2 )
		echo "Prepare failed!";
   
   $num = count( $mentors );
   for( $i = 0; $i < $num; $i++ )
   {
        $fname = NULL;
		$lname = NULL;
		$mid   = NULL;
		$stmt1->bind_param( "i", $mentors[ $i ] );
		$stmt1->execute();
		$stmt1->bind_result( $fname, $lname );
		$stmt1->fetch();
		
		echo "<li><b>  Prof. " . $fname . " " . $lname . "</b></li>";
		echo "<ul> <li> has students ";
/*
		$stmt2->bind_param( "i", $people[ $i ] );
		$stmt2->execute();
		$stmt2->bind_result( $mid );
		while( 	$stmt2->fetch() ) {
			echo $mid;
		}
		echo "</li>";
*/		
		echo "<li> has interests </li> </ul>";
   }
   $stmt1->close();
   $stmt2->close();
   echo "</ul>";	
	
	$mysqli->close();
?>


</body>
</html>
