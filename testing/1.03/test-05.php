<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Html5Dom 1.03: Test 05";
$describe = "Require the ability to load a full html document via the config";

//  Define some test environment variables
$rootpath = dirname(__FILE__);
$filename = "{$rootpath}/cache/html5dom.test-cases.html";

//  Create an instance of the Html5Document
$html5 = new Html5Document( ["loadfile"=>$filename] );

$html5->save()->write();
