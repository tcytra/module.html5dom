<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "1.02 | Test 07";
$describe = "Ensure the Html5Search functionality works with an Html5Fragment";

//  Create an instance of the Html5Document
$html5 = new Html5Document();

//  Append some elements to the document <head>
$html5->head->title($testcase)->meta( ["name"=>"description", "content"=>"{$testcase}: {$describe}"] );

//  Define some html markup
$markup = <<<MarkUp
<header>
	<h1 class="testcase">{$testcase}</h1>
	<h2 class="describe">{$describe}</h2>
</header>
<main>
	<div id="content" class="inner wrapper">
		<p>This document is ready for content.</p>
	</div>
</main>
<footer>
	<div class="copyright">&copy;2016 Todd Cytra</div>
	<div class="linkback"><a href="http://www.cytra.ca/">www.cytra.ca</a></div>
</footer>
MarkUp;

//  Append the markup to an instance of Html5Fragment
$home = $html5->fragment("div#homepage.page.interface", $markup);

//  Apply a search to the existing document node tree by node name
$home->find("#content")->classAdd("interface")->classRemove("wrapper");

//  Append the fragment to the document <body>
$home->appendTo($html5->body);

$html5->save()->write();
