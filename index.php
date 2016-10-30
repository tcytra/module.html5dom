<!DOCTYPE html>
<html lang="en-CA">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<meta name="author" content="Todd Cytra tcytra.gmail.com.">
		<title>HTML5Dom</title>
		<style type="text/css">
			body { margin:0; padding:0; font-family:verdana,sans-serif; font-size:16px; }
			h1,h2,h3,h4,h5,h6 { margin:0; padding:1em 0; font-family:arial,sans-serif; }
			header { background-color:steelblue; }
			h1 { width:960px; margin:0 auto; color:white; }
			main { width:960px; margin:0 auto; padding-bottom:2em; }
		</style>
	</head>
	<body>
		<div class="page interface">
			<header>
				<div class="body">
					<h1 class="heading">Html5Dom</h1>
				</div>
			</header>
			<main>
				<div class="body">
					<section class="description">
						<h2>Description</h2>
						<p>Html5Dom is a PHP-based module incorporating the concept of selectors and utilizing instances of DOMDocument objects for creating, manipulating, and outputting HTML5 documents or portions of HTML5 markup.</p>
						<p><strong>This module is currently in development and not yet intended for production use.</strong></p>
					</section>
					<section class="objectives">
						<h2>Objectives</h2>
						<p>There are several key objectives identified for this system that will be met as development progresses.</p>
						<ul>
							<li>Top-down document rendering: The ability to define an Html5 document and build the internal structure within it</li>
							<li>Bottom-up document rendering: The ability to define an Hhtml5 fragment and build the remaining document upwards around it</li>
							<li>Perform hierarchical searches across multiple indexed instances of the various Html5 objects and argue for deep manipulation</li>
							<li>Chain and/or repeat manipulation methods to create Html5 node tree structures and populate with externally derived content</li>
						</ul>
					</section>
					<!--<section class="benefits">
						<h2>Benefits</h2>
						<ul>
							<li>Ability to completely suspend further user-requested content generation and derive a separate document, ie: an error report</li>
						</ul>
					</section>-->
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
							<li>
								<strike>Shorten the element append and attributes "id" and "class" to a constructor argument</strike>
								<ul>
									<li>The Html5Constructor is creating self-instances through a static method, but the functionality it performs should exist in the non-static methods</li>
								</ul>
							</li>
							<li>
								<strike>Argue the charset and language to the Html5Document __construct and call implement with node tags separately</strike>
								<ul>
									<li>The charset and language arguments are passed through the $config to the Html5 constructor</li>
								</ul>
							</li>
							<li><strike>Require the ability to create, manipulate, and output a PHP DomFragment</strike></li>
							<li>Require the ability to populate an Html5 Document, Fragment, or Element from a text or data source</li>
							<li>
								<span>Require the ability to specify environment behavior through a configuration system (Which could chain up a parent system)</span>
								<ul>
									<li>Option to search and report element id collisions (on/off)</li>
								</ul>
							</li>
							<li>Require the ability to search the domdocument node tree for a matching construct definition</li>
							<li>Require an error detection and stop process system</li>
							<li>Require the ability to output text/plain</li>
							<li>Require the ability to identify and index an element for further reference (recall, indexAs ?)</li>
						</ul>
					</section>
					<section class="considerations">
						<h2>Considerations</h2>
						<ul>
							<li>Consider the possibility of introducing an Html5DocumentBody object to manage the concept of interface pages, dialogues, and toolbars</li>
							<li>Consider the option of creating all extended objects from the Html5 object</li>
							<li>Consider utilizing a namespace for this module</li>
							<li>Consider a cleaner (better readability) means of referencing domobj, domnode, objnode, parent, and target</li>
						</ul>
					</section>
				</div>
			</main>
		</div>
	</body>
</html>
