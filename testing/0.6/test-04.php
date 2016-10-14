<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 04
//  Require the ability to append, prepend, or rewrite the document title tag text

$html5 = new HTML5Document("html", "body");

$html5->meta( ["viewport"=>"width=device-width,initial-scale=1"] );

//  1. Must set title to "Test 04"
$html5->title("Test 04");

//  2. Must set title to "0.6 Test 04"
$html5->title("0.6", true, " ");

//  3. Must set title to "HTML5Dom | 0.6 Test 04"
$html5->title("HTML5Dom", -1, "|");

$html5->append("div")->attribute("id", "homepage")->attribute("class", "page interface");

$html5->save()->write();
