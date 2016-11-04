<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Test 04";
$describe = "Ensure the ability to wrap a stand-alone Html5Fragment with a constructor argument";

//  Create an instance of the Html5Document
$fragment = new Html5Fragment();
$fragment->create("header.testcase", "<h3>{$testcase}</h3><p>{$describe}</p>");

//  Wrap the fragment with a specified construct
$fragment->wrap("#interface");

$fragment->save()->write();
