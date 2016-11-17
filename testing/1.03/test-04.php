<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Html5Dom 1.03: Test 04";
$describe = "Require the ability to save an Html5Fragment into the filesystem";

//  Define some test environment variables
$rootpath = dirname(__FILE__);
$filename = "{$rootpath}/index.html";
$savefile = "{$rootpath}/cache/fragment.test-04.html";

//  Create an instance of the Html5Fragment and create some content
$fragment = new Html5Fragment();
$fragment->create("div.interface", "<h1>Html5Dom Testcases</h1>");

//  Load an external html file into the fragment
$fragment->loadFile($filename);

//  Save the generated html file to a directory location
$fragment->saveFile($savefile);

echo "Look for file:\n{$savefile}\n";
echo ( (file_exists($savefile)) ? "File exists!" : "Boo no file!" );
