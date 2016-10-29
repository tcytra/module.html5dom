<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Test 01";
$describe = "Create a DomDocumentFragment via new fragment method in the Html5 object";

//  Create an instance of the Html5Document
$html5 = new Html5Document();

//  Create an instance of the Html5Fragment
$fragment = $html5->fragment("div#testing.interface","<h3>{$testcase}</h3><p>{$describe}</p>");

//  Append the fragment to the Html5Document <body>
$fragment->appendTo($html5->body);

$html5->save()->write();
