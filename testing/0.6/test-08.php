<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

$testcase = "Test 08";
$describe = "Ensure the head elements are appended in a sensible order";

//  Create an instance of the HTML5Document
$html5 = new HTML5Document("html", "body");

//  Create some document <meta> tags
$html5->head->meta( ["viewport"=>"width=device-width,initial-scale=1"] )
	->meta( ["name"=>"author","content"=>"Todd Cytra tcytra.gmail.com."] );

//  Create a document stylesheet <link> element
$html5->head->stylesheet("include/default.css");

//  Create a document javascript <script> element
$html5->head->javascript("include/system-0.5.1.js");

//  Add another stylesheet after adding a <script> tag
$html5->head->stylesheet("include/utility.css");

//  Create the document <title> after the external file tags
$html5->head->title("HTML5Dom | 0.6 {$testcase}");

//  Add another <meta> tag after adding the <title> tag
$html5->head->meta( ["name"=>"description","content"=>$describe] );

//  Create a document <body> element
$html5->append("div")->attribute("id", "testing")->attribute("class", "page interface");

$html5->save()->write();
