<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 07
$describe = "Require the ability to create a javascript script element with the external src";

//  Create an instance of the HTML5Document
$html5 = new HTML5Document("html", "body");

//  Create the document <title>
$html5->head->title("0.6")
	->title("Test 07", 1, " ")
	->title("HTML5Dom", -1, "|");

//  Create some document <meta> tags
$html5->head->meta( ["viewport"=>"width=device-width,initial-scale=1"] )
	->meta( ["name"=>"author","content"=>"Todd Cytra tcytra.gmail.com."] )
	->meta( ["name"=>"description","content"=>$describe] );

//  Create a document stylesheet <link> element
$html5->head->link("include/default.css")->link("include/utility.css");

//  Create a document javascript <script> element
$html5->head->script("include/system-0.5.1.js");

//  Create a document <body> element
$html5->append("div")->attribute("id", "testing")->attribute("class", "page interface");

$html5->save()->write();
