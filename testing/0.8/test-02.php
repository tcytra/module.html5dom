<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Test 02";
$describe = "Alter the append method to accept a constructor argument";

//  Create an instance of the Html5Document
$html5 = new Html5Document(['language'=>'en_CA']);

//  Assemble some javascript code to include with the <script> element
$code = <<<JavaScript
(function(){\nwindow.onload = function(){\n\tdocument.getElementById("testing").innerHTML = "<h1>{$testcase}</h1><p>{$describe}.</p>";\n}\n})();
JavaScript;

//  Create the document <head> elements
$html5->head->meta(["name"=>"description","content"=>$describe])->title("Html5Dom | 0.8 {$testcase}")->javascript(null, $code)->favicon("/favicon.png");

//  Create a <div> element in the document <body>
$html5->append("div#testing.page.interface");

$html5->save()->write();
