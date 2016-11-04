<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 06
$describe = "Require the ability to create a stylesheet link with requested attributes";

//  Create an instance of the HTML5Document
$html5 = new HTML5Document("html", "body");

//  Create the document <title>
$html5->head->title("0.6")
	->title("Test 06", 1, " ")
	->title("HTML5Dom", -1, "|");

//  Create some document <meta> tags
$html5->head->meta( ["viewport"=>"width=device-width,initial-scale=1"] )
	->meta( ["name"=>"author","content"=>"Todd Cytra tcytra.gmail.com."] )
	->meta( ["name"=>"description","content"=>$describe] );

//  Create some document stylesheet <link> elements
$html5->head->link("include/default.css")->link("include/utility.css");

//  Create a document <body> element
$html5->append("div")->attribute("id", "homepage")->attribute("class", "page interface");

$html5->save()->write();
