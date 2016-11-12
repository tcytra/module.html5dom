<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Test 03";
$describe = "Require the ability to find and argue available methods against element class attributes";

//  Create an instance of the Html5Document
$html5 = new Html5Document();

//  Append some elements to the document <head>
$html5->head->title($testcase)->meta( ["name"=>"description", "content"=>"{$testcase}: {$describe}"] );

//  Define some html markup
$markup = <<<MarkUp
<div id="homepage" class="page interface">
	<header>
		<h1 class="testcase">{$testcase}</h1>
		<h2 class="describe">{$describe}</h2>
	</header>
	<main>
		<div id="content" class="inner wrapper">
			<p>This document is ready for content.</p>
		</div>
	</main>
</div>
<footer>
	<div class="copyright">&copy;2016 Todd Cytra</div>
	<div class="linkback"><a href="http://www.cytra.ca/">www.cytra.ca</a></div>
</footer>
MarkUp;

//  Append the markup to the document <body>
$html5->html($markup);

//  Apply a search to the existing document node tree by node name
$html5->find(".page.interface")->html("<p>The .page.interface element content has been over-written with the find method.</p>");

$html5->save()->write();
