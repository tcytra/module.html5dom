<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Test 03";
$describe = "Provide the ability to wrap an Html5Fragment with a constructor argument";

//  Create an instance of the Html5Document
$html5 = new Html5Document("en_CA");

//  Create an instance of the Html5Fragment
$fragment = $html5->fragment("header.testcase", "<h3>{$testcase}</h3><p>{$describe}</p>");

$content = <<<MainContent
<h4 class="subtitle">Main Content</h4>
<p class="reason">Testing the ability to add further structure and content to the Html5Fragment with the prexisting append method...</p>
<p class="result">Seems to work.</p>
MainContent;

//  Wrap the fragment with a specified construct
$fragment->wrap("#interface")
		->append("main#content", $content)
		->append("footer","&copy;2016 Todd Cytra");

//  Append the fragment to the Html5Document <body>
$fragment->appendTo($html5->body);

$html5->save()->write();
