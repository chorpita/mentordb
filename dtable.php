<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tabelle löschen</title>
</head>
<body>
<h2>Home Grown MySQL-Manager</h2>
&copy; Douglas Chorpita - HRZ
<?php
$tname = $_REQUEST['table'];
echo "<h2>Delete table<i> ";
echo $tname;
echo "</i></h2>";
echo "Are you sure that you want to delete table <i><b>";
echo $tname;
echo "</b></i> ?";
?>
<p/>
<p/>
<table>
<tr>
<td>
<?php
echo "<form method='post' action='tables.php?table=";
echo $tname;
echo "&action=del' autocomplete='off' name='yes_form'>";
?>
<input name="yes" type="submit" value="I am sure"  />
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
