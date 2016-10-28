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
				<h1 class="heading">Html5Dom</h1>
			</header>
			<div class="body">
				<main>
					<section class="description">
						<h2>Description</h2>
						<p>The Html5 system is intended to be an interface for HTML5 dom-node creation and manipulation via string-format nodename and element id selectors.</p>
					</section>
					<section class="objectives">
						<h2>Objectives</h2>
						<p>There are several key objectives identified for this system that have must be met.</p>
						<ul>
							<li>Top-down HTML5 rendering: The ability to define an HTML5 document and build the internal structure within it.</li>
							<li>Bottom-up HTML5 rendering: The ability to define an HTML5 fragment and build the remaining document upwards around it.</li>
							<li>Detached simultaneous fragments: The ability to have several HTML5 fragments detached from the document structure indexed and accessible for further work.</li>
							<li>Chain and/or repeat element manipulation methods to create HTML5 node treet structures and populate with externally derived content.</li>
						</ul>
					</section>
					<section class="requirements">
						<h2>Requirements</h2>
						<ul>
							<li><strike>Require the ability to append an element with an argument for content</strike></li>
							<li>
								<strike>Require an isvalid object to test element names and attributes, document title, etc</strike>
								<ul>
									<li>isValid has been added as a static method to the Html5 object</li>
								</ul>
							</li>
							<li>Shorten the element append and attributes "id" and "class" to a constructor argument</li>
							<li>
								<strike>Argue the charset and language to the Html5Document __construct and call implement with node tags separately</strike>
								<ul>
									<li>The charset and language arguments are passed through the $config to the Html5 constructor</li>
									<li>The implement method is still automatic, but could be renamed as the create method, which is consistent with sibling objects</li>
								</ul>
							</li>
							<li>Require the ability to create, manipulate, and output a PHP DomFragment</li>
							<li>Require the ability to populate an Html5 Document, Fragment, or Element from a text or data source</li>
							<li>Require the ability to specify environment behavior through a configuration system (Which could chain up a parent system)</li>
							<li>Utilize the Html5 namespace to contain this module</li>
							<li>Consider the possibility of introducing an Html5DocumentBody object to manage the concept of interface pages, dialogues, and toolbars</li>
							<li>Require an error detection and stop process system</li>
							<li>Consider the option of creating all extended objects from the Html5 object</li>
						</ul>
					</section>
				</main>
			</div>
		</div>
	</body>
</html>
