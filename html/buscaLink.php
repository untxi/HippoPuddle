<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>

<?php
include('simple_html_dom.php');
// Find all links

$html = file_get_html("http://www.musica.com/letras.asp?letra=2230396");
$collection = $html->find('a');
//print_r(collection_values($collection));

//abro el archivo donde voy a escribir los links de la collecion de <a> del html
$file="/var/www/html/hippoPuddle_web/FilesOfSystem/link_txt.txt";
$myfile = fopen($file, "w") or die("Unable to open file!");

// escribir cada link
for ($i = 0; $i <  count($collection); $i++) {
    $key=key($collection);
    $val=$collection[$key];
    if ($val<> ' ') {
      //escribir links en el txt
      fwrite($myfile, $val. PHP_EOL);
      //echo $val ." <br> "; 
    }
     next($collection);
}
//cerrar archivo
fclose($myfile);

?>
</body>
</html>