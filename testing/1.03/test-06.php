<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Html5Dom 1.03: Test 06";
$describe = "Require the ability to load a partial fragment via the config";

//  Define some test environment variables
$rootpath = dirname(__FILE__);
$filename = "{$rootpath}/cache/fragment.test-04.html";

//  Create an instance of the Html5Fragment and load a file via the config
$fragment = new Html5Fragment( ["loadfile"=>$filename] );

$fragment->save()->write();
