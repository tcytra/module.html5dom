<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Test 03";
$describe = "Alter the append method to accept an argument to create the element with text content or html structure";

//  Create an instance of the Html5Document
$html5 = new Html5Document(['language'=>'en-CA']);

//  Create the document <head> elements
$html5->head->meta(["name"=>"description","content"=>$describe])->title("Html5Dom | 0.8 {$testcase}")->favicon("/favicon.png");

//  Assemble some HTML markup to include with the <div> element
$with = <<<MarkUp
<h2>{$testcase}</h2>
<p>{$describe}</p>
MarkUp;

//  Create a <div> element in the document <body>
$html5->append("div#testing.page.interface", $with)->append("div#copyright", "&copy;2016 Raige Technologies");

$html5->save()->write();
