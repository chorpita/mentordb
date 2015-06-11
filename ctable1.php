<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Neue Tabelle erstellen</title>
</head>

<body>
<h2>Home Grown MySQL-Manager</h2>
&copy; Douglas Chorpita - HRZ
<h2>Create a new table</h2>
<form method="post" action="ctable2.php" autocomplete="off" name="ctable2_form">
				<table border="4" bgcolor="#EEEEEE">
					<tr>
						<th><label for="tname">Table name</label></th>
						<td><input name="tname" id="tname" value="" size="17" type="text"></td>
                                                <script language="JavaScript" type="text/javascript">if(document.getElementById) document.getElementById('tname').focus();</script>
					</tr>
					<tr>
						<th><label for="numfields">Number of attributes</label></th>
						<td><input name="numfields" id="numfields" value="" size="3" type="text"></td>
					</tr>
				</table>
<p/><p/>				
<table>				
<tr>
<td>
<input type="submit" value="define attributes">
</form>	
</td>
<td>
<form method="post" action="tables.php" autocomplete="off" name="abbrechen_form">
  <input name="submit" type="submit" value="Cancel" />
</form>
</td>
</tr>
</table>
</body>
</html>
