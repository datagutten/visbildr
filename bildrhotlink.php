<?Php
$start=time();
header('Content-type: image/jpeg');
$id=$_GET['id'];

$ch = curl_init();

// set URL and other appropriate options
//curl_setopt($ch, CURLOPT_URL, 'http://bildr.no/image/749833.jpeg');
curl_setopt($ch, CURLOPT_URL,"http://www.bildr.no/image/$id.jpeg");
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 6.1; nb-NO; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12');

curl_exec($ch);


curl_close($ch);

$end=time();
$timestring="$id: $end-$start=";
$timestring.=$end-$start;
$handle=fopen('bildrhotlinktime.txt','a');
fwrite($handle,$timestring."\n");
fclose($handle);

