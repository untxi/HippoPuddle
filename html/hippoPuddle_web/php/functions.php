<?php
/*
	Funciones en php para acceder a los datos de lós sitios web
*/
include('simple_html_dom.php');

function validationLink($link){
  echo $link;
}

function readData($url){
	//$url = 'http://www.musica.com/letras.asp?letra=2201161';
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTMLFile($url);
    $title = $doc->getElementsByTagName('title');
    $myTitle = $title->item(0)->nodeValue;
    $p = $doc->getElementsByTagName('p');
    $myText = $p->item(0)->nodeValue;
    $mytag = "musica";

    echo ("$url", "$myTitle", "$myText", "$myTag");
}

function writeLinks($myLineURL){
	// Find all links
	$html = file_get_html($myLineURL);
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
	    }
	     next($collection);
	}
	//cerrar archivo
	fclose($myfile);
}

function dataManage(){
	$myFileName = "link_txt.txt";
	$myfile = fopen($myFileName, "r") or die("Unable to open file!");
	while(!feof($myfile)) {
	  $myLine = fgets($myfile) . "<br>";
	  $newFeed = readData($myLine);
		//save $newFeed on DB
	}
	fclose($myfile);
}


function printData($myFileName){
	echo "myfile is $myFileName <br><br>";
	$myfile = fopen($myFileName, "r") or die("Unable to open file!");
	while(!feof($myfile)) {
	  $myLine = fgets($myfile) . "<br>";
		echo $myLine;
	}
	fclose($myfile);
}

?>