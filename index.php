<!DOCTYPE html>
<html lang="en-CA">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<title>HTML5Dom</title>
	</head>
	<body>
		<div class="page interface">
			<header class="head">
				<h1 class="heading">HTML5Dom</h1>
			</header>
			<div class="body">
				<main>
					<section class="description">
						<h2>Description</h2>
						<p>The HTML5Dom system is intended to be an interface for HTML5 dom-node creation and manipulation via string-format nodename and element id selectors.</p>
					</section>
					<section class="objectives">
						<h2>Objectives</h2>
						<p>There are several key objectives identified for this system that have must be met.</p>
						<ul>
							<li>Top-down HTML5 rendering: The ability to define an HTML5 document and build the internal structure within it.</li>
							<li>Bottom-up HTML5 rendering: The ability to define an HTML5 fragment and build the remaining document upwards around it.</li>
							<li>Detached simultaneous fragments: The ability to have several HTML5 fragments detached from the document structure indexed and accessible for further work.</li>
						</ul>
					</section>
					<section class="requirements">
						<h2>Requirements</h2>
						<ul>
							<li>Require the ability to append an element with an argument for content</li>
							<li>Require an isvalid object to test element names and attributes, document title, etc</li>
							<li>Shorten the element append and attributes "id" and "class" to a constructor argument</li>
							<li>Argue the charset and language to the HTML5Document __construct and call implement with node tags separately</li>
							<li>Require the ability to create, manipulate, and output a PHP DomFragment</li>
							<li>Require the ability to populate an Html5 Document, Fragment, or Element from a text or data source</li>
							<li>Require the ability to specify environment behavior through a configuration system (Which could chain up a parent system)</li>
							<li>Utilize the Html5 namespace to contain this module</li>
						</ul>
					</section>
				</main>
			</div>
		</div>
	</body>
</html>
