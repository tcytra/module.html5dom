<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Html5Dom 1.03; Test 01";
$describe = "Require the ability to load a file into the Html5Document";
$rootpath = dirname(__FILE__);

//  Create an instance of the Html5Document
$html5 = new Html5Document();

//  Append some elements to the document <head>
$html5->head->title($testcase)->meta( ["name"=>"description", "content"=>"{$testcase}: {$describe}"] );

//  Load the target html file into the document body
$html5->loadFile( "{$rootpath}/index.html" );

$html5->save()->write();
