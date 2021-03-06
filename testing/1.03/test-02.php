<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Html5Dom 1.03: Test 02";
$describe = "Require the ability to load a file into the Html5Fragment";
$rootpath = dirname(__FILE__);
$filename = "{$rootpath}/index.html";

//  Create an instance of the Html5Document
$html5 = new Html5Document();

//  Append some elements to the document <head>
$html5->head->title($testcase)->meta( ["name"=>"description", "content"=>"{$testcase}: {$describe}"] );

//  Create an instance of the Html5Fragment and load multiple files
$html5->fragment("div.interface", "<h1>Html5Dom Testcases</h1>")
	->loadFile(str_replace("1.03","1.01", $filename))
	->loadFile(str_replace("1.03","1.02", $filename))
	->loadFile($filename)
	->appendTo($html5->body);

$html5->save()->write();
