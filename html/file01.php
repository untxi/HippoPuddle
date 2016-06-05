
<!-- 
$myFileName = "/home/myxu/Escritorio/www/html/hippoPuddle_web/FilesOfSystem/link_txt.txt";
echo "myfile is $myFileName <br><br>";

$myfile = fopen($myFileName, "r") or die("Unable to open file!");
while(!feof($myfile)) {
  $myLine = fgets($myfile) . "<br>";
	echo $myLine;
}

fclose($myfile);

$myfile = fopen("links.xml", "r") or die("Unable to open file!");
echo fread($myfile,filesize("links.xml"));
fclose($myfile);
-->
<!--//Para leerlo
  function leer(){
    echo "<p><b>Ahora mostrandolo con estilo</b></p>";
    $xml = simplexml_load_file("enlaces.xml");
    $salida ="";
    foreach($xml->enlace as $item){
      $salida .=
        "<b>Autor:</b> " . $item->autor . "<br/>".
        "<b>Título:</b> " . $item->titulo . "<br/>".
        "<b>Año:</b> " . $item->anio . "<br/>".
        "<b>Editorial:</b> " . $item->editorial . "<br/><hr/>";
    }
    echo $salida;
-->    


<!DOCTYPE html>
<html>
<body>
<?php
// Get data from internet
//$newUrl, $newTitle, $newText, $newTag = function readData($url, $myTag);
$xml = simplexml_load_file("enlaces.xml");
//$myfile = simplexml_load_file("/www/html/hippoPuddle_web/FilesOfSystem/write_links.xml", "w") or die("Unable to open file!");

//file_put_contents(filename, data)
$txt = "<lead lead_ID="0000">";
fwrite($myfile, $txt);

$txt = "</lead>";
fwrite($myfile, $txt);
fclose(handle)close($myfile);

?>

</body>
</html> 