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
	include('simple_html_dom.php');

	$MyLinks = array();
	$html = file_get_html($myURL);
	$collection = $html->find('a');
	//print_r(collection_values($collection));

	//abro el archivo donde voy a escribir los links de la collecion de <a> del html
	$file="/var/www/html/hippoPuddle_web/FilesOfSystem/link_txt.txt";
	$myfile = fopen($file, "w") or die("Unable to open file!");

	// escribir cada link
	for ($i = 0; $i <  count($collection); $i++) {
	    $key=key($collection);
	    $val=$collection[$key];
	    $val=$val->getAttribute( 'href' );
	    if ($val<> ' ') {
	      //escribir links en el txt
	      fwrite($myfile, $val. PHP_EOL);
	      array_push($MyLinks, $val); 
	    }
	     next($collection);
	}
	//cerrar archivo
	fclose($myfile);
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
    $myTag  = "musica";
    $myText = "";
    //echo $myTag . "<br>";
    //echo $url . "<br>";
    //echo $myTitle ."<br>";
    for ($i=0; $i < $p->length;$i++){
        $myText = $myText.$myLine= $p->item($i)->nodeValue;
    }
    //echo $myText;
    return array($myTitle, $myTag, $myText);
}
// *****************************************************************//
function getNextID($link, $title, $Tag)){
	if (file_exists('/var/www/html/hippoPuddle_web/FilesOfSystem/write_links.xml')) {
	    $xml = simplexml_load_file('/var/www/html/hippoPuddle_web/FilesOfSystem/write_links.xml');
	}
 	return count($xml);
}
// *****************************************************************//
function writeTXT($pLink, $pText){
  //abre el archivo
  $file="/var/www/html/hippoPuddle_web/FilesOfSystem/word_by_link.txt";
  $myfile = fopen($file, "w") or die("Unable to open file!");
  
  $pText = preg_split("/[\s,:';\.]+/", $pText);

  for($i=0; $i < count($pText);$i++){
    //echo $pText[$i]."    ".$pLink."<br>";
    $value = $pText[$i]."\t".$pLink;
    fwrite($myfile, $value. PHP_EOL);
  }

  fclose($myfile);
}
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
	
	$sql = "INSERT INTO `hippopuddle`.`Words` (`Word_ID`, `Word`, `WordsInText`, `Link`, `Title`) VALUES (NULL, \'a\', \'1\', \'a\', \'a\');";
	
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