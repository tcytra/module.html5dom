<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Test 03";
$describe = "Provide the ability to wrap an Html5Fragment with a constructor argument";

//  Create an instance of the Html5Document
$html5 = new Html5Document();

//  Create an instance of the Html5Fragment
$fragment = $html5->fragment("header.testcase", "<h3>{$testcase}</h3><p>{$describe}</p>");

//  Wrap the fragment with a specified construct
$fragment->wrap("#interface");

//  Append the fragment to the Html5Document <body>
$fragment->appendTo($html5->body);

$html5->save()->write();
