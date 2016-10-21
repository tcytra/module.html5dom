<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Test 10";
$describe = "Require the ability to add a favicon link element to the document head";

//  Create an instance of the HTML5Document
$html5 = new HTML5Document("html", "body");

//  Assemble some javascript code to include with the <script> element
$code = <<<JavaScript
(function(){\nwindow.onload = function(){\n\tdocument.getElementById("testing").innerHTML = "<p>Ready.</p>";\n}\n})();
JavaScript;

//  Create the document <head> elements
$html5->head->title("0.6")->title("{$testcase}", true, " ")->title("HTML5Dom", -1, "|")
	->meta( ["viewport"=>"width=device-width,initial-scale=1"] )
	->meta( ["name"=>"author","content"=>"Todd Cytra tcytra.gmail.com."] )
	->meta( ["name"=>"description","content"=>$describe] )
	->stylesheet("include/default.css")
	->stylesheet("include/utility.css")
	->javascript("include/system-0.5.1.js")
	->javascript(null, $code)
	->favicon("/favicon.png");

//  Create a document <body> element
$html5->append("div")->attribute("id", "testing")->attribute("class", "page interface");

//  Output the Html5 document
$html5->save()->write();
