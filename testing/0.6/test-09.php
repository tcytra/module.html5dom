<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

$testcase = "Test 09";
$describe = "Require the ability to create a javascript script element with provided code";

//  Create an instance of the HTML5Document
$html5 = new HTML5Document("html", "body");

//  Create the document <title> after the external file tags
$html5->head->title("HTML5Dom | 0.6 {$testcase}");

//  Create some document <meta> tags
$html5->head->meta( ["viewport"=>"width=device-width,initial-scale=1"] )
	->meta( ["name"=>"author","content"=>"Todd Cytra tcytra.gmail.com."] )
	->meta( ["name"=>"description","content"=>$describe] );

//  Create a document stylesheet <link> element
$html5->head->stylesheet("include/default.css")->stylesheet("include/utility.css");

//  Assemble some javascript code to include with the <script> element
$code = <<<JavaScript
(function(){
	window.onload = function(){
		document.getElementById("testing").innerHTML = "<p>Ready.</p>";
	}
})();
JavaScript;

//  Create a document javascript <script> element
$html5->head->javascript("include/system-0.5.1.js")->javascript(null, $code);

//  Create a document <body> element
$html5->append("div")->attribute("id", "testing")->attribute("class", "page interface");

$html5->save()->write();
