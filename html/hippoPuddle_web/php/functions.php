<?php
/*
	Funciones en php para acceder a los datos de lós sitios web
*/
include('simple_html_dom.php');

// *****************************************************************//
function cantidadPalabraXtxt($myWord, $myString){
	$newArray = preg_split("/[\s,:';\.]+/", $myString);
	$myCount = 0;
	for($i = 0; $i < count($newArray);$i++){
		if (strtolower($newArray[$i]) == strtolower($myWord)){
			$myCount++;
		}
	}
	return $myCount;
}
// *****************************************************************//
/*
Entrada: enlace a sitio web
Salida:  TRUE si es un enlace valido, FALSE si no es valido
*/
function validationLink($url){
    $h = get_headers($url);
    $status = array();
    preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
    return ($status[1] == 200);
}
// *****************************************************************//
function getLinks($myURL){
	//Variables
	$MyLinks = array();
	$html = file_get_html($myURL);
	$collection = $html->find('a');

	//abro el archivo donde voy a escribir los links de la collecion de <a> del html
	$file="/var/www/html/hippoPuddle_web/FilesOfSystem/link_txt.txt";
	$myfile = fopen($file, "w") or die("Unable to open file!");

	// limita los links para recursion a 50
	if (count($collection) > 50){
		$limitQurl = 50;
	}else{
		$limitQurl = count($collection);
	}

	// escribir cada link
	for ($i = 0; $i <  $limitQurl; $i++) {
	    $key=key($collection);
	    $val=$collection[$key];
	    if ($val<> ' ') {
	      fwrite($myfile, $val. PHP_EOL); //escribir links en el TXT MADRE
	      array_push($MyLinks, $val);    // agregarlos al array
	    }
	    next($collection);
	}
	fclose($myfile);	//cerrar archivo

	return $MyLinks;
}
// *****************************************************************//
function readData($url){
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTMLFile($url);
    $title = $doc->getElementsByTagName('title');
    $myTitle = $title->item(0)->nodeValue;
    $p = $doc->getElementsByTagName('p');
    $myText = $p->item(0)->nodeValue;
    $mytag = "code";

    return array($myTitle,  $myTag, $myText);
}
// *****************************************************************//
function getNextID($link, $title, $Tag)){
	if (file_exists('/var/www/html/hippoPuddle_web/FilesOfSystem/write_links.xml')) {
	    $xml = simplexml_load_file('/var/www/html/hippoPuddle_web/FilesOfSystem/write_links.xml');
	}
 	return count($xml);
}
// *****************************************************************//
 /*function writeXML($pTitle,$pTag,$pLink,$pText){
	$id = getNextID();
	//$xmlstr=<<<XML
	//<lead>
	//</lead>
	//XML;

	$sxe = new SimpleXMLElement(<lead></lead>);//$xmlstr);
	$sxe->addAttribute('type', 'documentary');

	// crea el puntero que va a ser la hoja del xml
	$myLead = $sxe->addChild('Lead');
	//agrega las "propiedades" de la hoja
	//                tag xml   contenido del tag
	$myLead->addChild('ID',$id);
	$myLead->addChild('title',$pTitle);
	$myLead->addChild('tag',  $pTag);
	$myLead->addChild('link', $pLink);
	$myLead->addChild('text', $pText);


	$dom = new DOMDocument('1.0');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($sxe->asXML());
	//Echo XML - remove this and following line if echo not desired
	echo $dom->saveXML();
	//Save XML to file - remove this and following line if save not desired
	$dom->save('/var/www/html/hippoPuddle_web/FilesOfSystem/write_links.xml');//aquí va su archivo de contenido
}*/
// *****************************************************************//
function saveDB($pWord,$pInText,$pUrl,$pTitle){
	$servername = "localhost";
	$username = "root";
	$password = "myxu";
	$dbname = "hippopuddle";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "INSERT INTO Words (Word, WordsInText, Link)
	VALUES ('MySQLi', 10 , 'http://www.w3schools.com/php/php_mysql_insert.asp')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

$conn->close();
}
// *****************************************************************//
/*
Funcion Recursiva para minería de datos a pequeña escala
$setRec es el límite de recursión para evitar ciclos infinitos
*/

function save($pLinks,$setRec = 10){
	$source = readData($pLink);
	$pUrl   = $pLinks;
	$pTitle = $source[0];
	$pTag   = $source[1];
	$pText  = $source[2];
	//saveDB
	saveDB($pWord,$pInText,$pUrl,$pTitle);
	
	if($pLinks)
	// call new feed
	$allLinks = getLinks($pLink);
	// Set new value for recursion
	$setRec--;
	$lenAllLinks = count($allLinks);
	if($lenAllLinks < $setRec){
		$setRec = $lenAllLinks;
	}
	save($lenAllLinks, $setRec);
}
// *****************************************************************//
function dataManage(){
	$myFileName = "link_txt.txt";
	$myfile = fopen($myFileName, "r") or die("Unable to open file!");
	while(!feof($myfile)) {
	  $pLink = fgets($myfile);
	  //save
	  save($pLink);
	}
	fclose($myfile);
}
// *****************************************************************//
function printData($myFileName){
	echo "myfile is $myFileName <br><br>";
	$myfile = fopen($myFileName, "r") or die("Unable to open file!");
	while(!feof($myfile)) {
	  $myLine = fgets($myfile) . "<br>";
		echo $myLine;
	}
	fclose($myfile);
}
// *****************************************************************//
?>