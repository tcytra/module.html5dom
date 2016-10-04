<?php

?>
<article id="test-0-3">
	<header class="header">
		<h2>0.3</h2>
		<p>Create an instance of the PHP DOMDocument via the DOMImplementation</p>
	</header>
	<section class="tests">
		<div id="test-0-3-01">
			<h3>01</h3>
			<p>Executed Code:</p>
			<code>$html5 = new HTML5Document();<br>$html5->save()->write();</code>
			<p>Expected Result:</p>
			<code>&lt;!DOCTYPE html&gt;<br></code>
		</div>
		<div id="test-0-3-02">
			<h3>02</h3>
			<p>Executed Code:</p>
			<code>$html5 = new HTML5Document("html");<br>$html5->save()->write();</code>
			<p>Expected Result:</p>
			<code>&lt;!DOCTYPE html&gt;<br>&lt;html&gt;<br></code>
		</div>
		
	</section>
	<section class="notes">
		<h2>Notes</h2>
		<ul>
			<li>Target: The ability to combine the test notes, the test scripts, and the root index with the HTML5 system</li>
			<li>Target: The ability to create the DOMDocument with/out the HTML tag, serve or wrap </li>
		</ul>
	</section>
</article>
