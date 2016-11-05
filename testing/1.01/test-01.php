<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Test 01";
$describe = "Declare the Html5 object as abstract, move the config evaluation to the Html5Document";

//  Create an instance of the Html5Document
$html5 = new Html5Document();

//  Create an instance of the Html5Fragment
$fragment = $html5->fragment("div#testing.interface","<h3>{$testcase}</h3><p>{$describe}</p>");

//  Append the fragment to the Html5Document <body>
$fragment->appendTo($html5->body);

$html5->save()->write();
