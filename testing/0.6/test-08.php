<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

$testcase = "Test 0.8";
$describe = "Ensure the head elements are appended in a sensible order";

//  Create an instance of the HTML5Document
$html5 = new HTML5Document("html", "body");

//  Create some document <meta> tags
$html5->head->meta( ["viewport"=>"width=device-width,initial-scale=1"] )
	->meta( ["name"=>"author","content"=>"Todd Cytra tcytra.gmail.com."] )
	->meta( ["name"=>"description","content"=>$describe] );

//  Create a document stylesheet <link> element
$html5->head->link("include/default.css");

//  Create a document javascript <script> element
$html5->head->script("include/system-0.5.1.js");



$html5->head->link("include/utility.css");


//  Create the document <title>
$html5->head->title("HTML5Dom | 0.6 Test {$testcase}");


//  Create a document <body> element
$html5->append("div")->attribute("id", "testing")->attribute("class", "page interface");

$html5->save()->write();
