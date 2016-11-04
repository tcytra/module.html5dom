<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Test 06";
$describe = "Ensure the previous append method works following a stand-alone fragment wrap";

//  Create an instance of the Html5Document
$fragment = new Html5Fragment();
$fragment->create("header.testcase", "<h3>{$testcase}</h3><p>{$describe}</p>");

$content = <<<MainContent
<h4 class="subtitle">Main Content</h4>
<p class="reason">Testing the ability to add further structure and content to the Html5Fragment with the prexisting append method...</p>
<p class="result">Seems to work.</p>
MainContent;

//  Wrap the fragment with a specified construct
$fragment->wrap("#interface")
	->append("main#content", $content)
	->append("footer","&copy;2016 Todd Cytra");

$fragment->save()->write();
