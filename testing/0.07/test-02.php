<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Test 02";
$describe = "Rename the object files to the StudlyCase convention; Extend objects from the Html5 object";

//  create an instance of the Html5Document
$html5 = new Html5Document("html", "body");

//  Assemble some javascript code to include with the <script> element
$code = <<<JavaScript
(function(){\nwindow.onload = function(){\n\tdocument.getElementById("testing").innerHTML = "<h1>{$testcase}</h1><p>{$describe}.</p>";\n}\n})();
JavaScript;

//  Create the document <head> elements
$html5->head->meta( ["name"=>"description","content"=>$describe] )
	->title("HTML5Dom | 0.7 {$testcase}")
	->javascript(null, $code)
	->favicon();

//  Create a document <body> element
$html5->append("div")->attribute("id", "testing")->attribute("class", "page interface");

$html5->save()->write();
