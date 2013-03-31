<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vis bildr</title>
</head>

<body>
<?Php
if(!isset($_POST['start']))
{
$data=file_get_contents('http://www.bildr.no/siste.php');
preg_match_all('^view/([0-9]+)^',$data,$result);
$start=$result[1][0];
}
else
	$start=$_POST['start'];
?>
<p>Som standard vises bildene i den størrelsen bildr.no har laget thumbnail i.</p>
<p>Om du ønsker annen størrelse, skriv inn  størrelse i prosent: 
<form id="form1" name="form1" method="post" action="">
  <p>Størrelse i prosent:
    <input name="size" type="text" id="size" size="2" maxlength="3" value="<?Php echo $_POST['size']; ?>" />
    %
<br />
    Bilder som skal vises:
    <input name="total" type="text" id="total" value="20" size="2" />
  <br />
  Kolonner: 
  <input name="cols" type="text" id="cols" value="5" size="2" />
  <br />
  Id for første bilde som skal vises: 
  <input name="start" type="text" id="start" value="<?Php echo $start; ?>" size="7" />
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Submit" />
  </p>
</form>
</p>
<p>
  <table border="1">
  <?Php
//  die();

if (isset($_POST['cols']))
{
$cols=$_POST['cols'];
$total=$_POST['total'];
$start=$_POST['start'];
}
else
{
$cols=5;
$total=20;
}
$rows=$total; 
$start=$start-($cols+$rows)+1;
//$start=692734-5;
$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 6.1; nb-NO; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12');

for ($i=$start; $i<=$start+$rows; $i=$i+$cols)
{
	echo "<tr>\n";
	for ($col=0; $col<=$cols-1; $col++)
	{
		$id=$i+$col;

		$size=getimagesize($bildrfile='http://www.bildr.no/image/'.$id.'.jpeg');
		$file="bildrhotlink.php?id=$id";
		

			$percent=$_POST['size'];

			 $htmlsize='width="'.$size[0]*$percent/100 .'" height="'.$size[0]*$percent/100 ."\"";
		if ($_POST['size']=='')
			echo '<td><a href="http://www.bildr.no/view/'.$id.'"><img src="http://www.bildr.no/thumb/'.$id.'.jpeg" /></a><br>'.$id.'</td>'."\n";
		else
			 echo "<td><a href=\"http://www.bildr.no/view/$id\"><img src=\"$file\" $htmlsize/></a><br>$id</td>\n";
//echo "<td><a href=\"http://www.bildr.no/view/$id\"><img src=\"$file\" $htmlsize/></a><br>$id</td>\n";
	}
	echo "</tr>\n";
	//die();
}
		curl_close($ch);
?>
</table>
</p>

</body>
</html>
