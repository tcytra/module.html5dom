<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 01
//  Create a PHP DOMDocument DOMElement without arguments; default to <div>

$html5 = new HTML5Document("html", "body");

//  Title and describe this testcase
$testcase = "Test 01";
$describe = "Require the ability to add a favicon link element to the document head";

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
