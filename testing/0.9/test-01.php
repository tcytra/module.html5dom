<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Test 01";
$describe = "Create a DomDocumentFragment via new fragment method in the Html5 object";

//  Create an instance of the Html5Document
$html5 = new Html5Document(['language'=>'en_CA']);

//  Create the document <head> elements
$html5->head->meta(["name"=>"description","content"=>$describe])->title("Html5Dom | 0.9 {$testcase}")->favicon("/favicon.png");

//  Create a <div> element in the document <body>
$html5->append("div#testing.page.interface", $describe);

$html5->save()->write();
