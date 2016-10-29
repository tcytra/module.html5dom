<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Test 02";
$describe = "Create and output a DomDocumentFragment directly via new instance of the Html5Fragment object";

//  Create an instance of the Html5Document
$fragment = new Html5Fragment();
$fragment->create("div.testcase","<h3>{$testcase}</h3><p>{$describe}</p>");

$fragment->save()->write();
