<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 05
//  Create a PHP DOMDocument DOMElement with id attribute
//  + Internal test, ensure getElementById identifies the node correctly

$html5 = new HTML5Document("html", "body");

$html5->append("div")->attribute("id", "pageHome")->attribute("class", "interface");

//  This must output: div
//echo $html5->domobject("div")->getElementById("pageHome")->nodeName;
//exit;

$html5->save()->write();
