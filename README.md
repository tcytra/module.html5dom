# Html5Dom

Author: Todd Cytra

Created: 2016-09-22

## Description

Current stable: 0.1.0; *This project is currently in development and not intended for production use.*

Html5Dom is a PHP-based project incorporating the concept of selectors and utilizing instances of DOMDocument objects for creating, manipulating, and outputting HTML5 documents or portions of HTML5 markup.

## Objectives

There are several key objectives identified for this system that will be met as development progresses.

* Top-down document rendering: The ability to define an Html5 document and build the internal structure within it
* Bottom-up document rendering: The ability to define an Hhtml5 fragment and build the remaining document upwards around it
* Perform hierarchical searches across multiple indexed instances of the various Html5 objects and argue for deep manipulation
* Chain and/or repeat manipulation methods to create Html5 node tree structures and populate with externally derived content

## Example Use

The following code:

```
<?php
//  Create an instance of the Html5Document object
$html5 = new Html5Document("en");

//  Append some HTML5 <head> elements and attributes
$html5->head->title("Project: Html5Dom")
  ->meta( ["viewport"=>"width=device-width,initial-scale=1"] )
  ->meta( ["name"=>"author", "content"=>"Todd Cytra"] )
  ->stylesheet("/css/default.css")
  ->javascript("/js/init.js")
  ->favicon("/favicon.png");

//  Create an instance of the Html5Fragment object and append it to the <body>
$html5->fragment(".interface.wrapper", "<header><h1>Project: Html5Dom</h1></header>")
  ->append("main.content", "<p>This document is ready for content.</p>")
  ->appendTo($html5->body);

//  Output the document
$html5->save()->write();
```

Will output:

```
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta viewport="width=device-width,initial-scale=1">
<meta name="author" content="Todd Cytra">
<title>Project: Html5Dom</title>
<link rel="icon" href="/favicon.png">
<link rel="stylesheet" type="text/css" href="/css/default.css">
<script type="text/javascript" src="/js/init.js"></script>
</head>
<body><div class="interface wrapper">
<header><h1>Project: Html5Dom</h1></header><main class="content"><p>This document is ready for content.</p></main>
</div></body>
</html>
```

## Documentation

Further information for using the Html5Dom objects may be found in the following documents:

[Html5Construct](Docs/Html5Construct.md)

The Html5Construct object will evaluate a provided HTML element constructor in string format and retrieve the parameters as instance properties.

[Html5Document](Docs/Html5Document.md)

The Html5Document object will create a PHP DOMDocument (via an HTML documentType DOMImplementation) and provide methods for creating and manipulating the internal DOM node tree.

[Html5DocumentHead](Docs/Html5DocumentHead.md)

The Html5DocumentHead object provides methods for adding and manipulating the various child nodes in the DOMDocument &lt;head&gt; node.

[Html5Element](Docs/Html5Element.md)

The Html5Element object provides methods for creating and manipulating a PHP DOMElement in the context of an HTML5 document.

[Html5Fragment](Docs/Html5Fragment.md)

The Html5Fragment object provides methods for creating and manipulating a PHP DOMFragment in the context of an HTML5 document.
