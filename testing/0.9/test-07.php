<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Title and describe this testcase
$testcase = "Test 07";
$describe = "Create a clone of the Html5Fragment and work with it separately";

//  Create an instance of the Html5Document
$html5 = new Html5Document("en_CA");

$webpage = <<<MainContent
<header>
	<h1 class="pagetitle"></h1>
	<h2 class="description"></h2>
</header>
MainContent;

//  Create an instance of the Html5Fragment
$fragment = $html5->fragment("div.interface.wrapper", $webpage);

//  Attempt to create copies of the Html5Fragment
$fragment->cloneFragment()
	->append("main.main.content", "This is the #overview clone")
	->wrap("div#overview.page.wrapper")
	->appendTo($html5->body);

$fragment->cloneFragment()
	->append("main.main.content", "This is the #versions clone")
	->wrap("div#versions.page.wrapper")
	->appendTo($html5->body);

$html5->save()->write();
