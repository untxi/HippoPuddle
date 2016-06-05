<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>

<?php

$xmlstr=<<<XML
<root>
</root>
XML;

$sxe = new SimpleXMLElement($xmlstr);
$sxe->addAttribute('type', 'documentary');

// crea el puntero que va a ser la hoja del xml
$myLead = $sxe->addChild('Lead');
//agrega las "propiedades" de la oja
//                tag xml   contenido del tag
$myLead->addChild('title', 'mi title');
$myLead->addChild('tag', 'unique');
$myLead->addChild('text', 'unique');

$characters = $myLead->addChild('characters');
$character  = $characters->addChild('character');
$character->addChild('name', 'Mr. Parser');
$character->addChild('actor', 'John Doe');

$rating = $myLead->addChild('rating', '5');
$rating->addAttribute('type', 'stars');


$dom = new DOMDocument('1.0');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($sxe->asXML());
//Echo XML - remove this and following line if echo not desired
echo $dom->saveXML();
//Save XML to file - remove this and following line if save not desired
$dom->save('fileName.xml');//aquí va su archivo de contenido

?>

</body>
</html>