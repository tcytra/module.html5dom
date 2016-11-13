# Class Html5Fragment Extends Html5Document

## Description

The Html5Fragment object provides methods for creating and manipulating a PHP DOMFragment in the context of an HTML5 document.

**Note:** The Html5Fragment can be created and outputted independantly of the Html5Document object, in which case it will execute its own DOMImplementation/DOMDocument, or from the fragment method of the Html5Document object, and will operate in the context of its DOMImplementation/DOMDocument.

## Properties

protected object `$objnode`
> *The local instance target PHP DOMElement*

public string `$objtype = "fragment"`
> *The type-name of this object; Value: `fragment`*

## Methods

public `__construct( [array $config = null] )`
> *Create an instance of the Html5Fragment and process the provided $config*

public void `create( string $construct[, string $with = null] )`
> *Create the document fragment with a provided constructor*

public object `appendTo( object $node )`
> *Append this Html5Fragment to the specified target node*

public object `cloneFragment( )`
> *Create and return a copy of a new instance of this Html5Fragment*

public string `getOutput( [bool $stripnewlines = false] )`
> *Return the HTML output from this instance of the Html5Fragment object*

public object `save( )`
> *Perform a PHP DomDocument saveHTML into the instance $output variable*

public void `write( )`
> *Write the Html5Document DomDocument contents*

## Example Use

The following code:

```php
<?php
// Create an instance of the Html5Document object
$html5 = new Html5Document();

// Define some HTML markup
$header = <<<Header
<header>
  <h1 class="pagetitle">Class Html5Fragment</h1>
  <h2 class="description">This object will facilitate management of a DOMFragment</h2>
</header>
Header;

// Create an instance of the Html5Fragment
$fragment = $html5->fragment("div.interface.wrapper", $header);

// Perform some manipulation of the Html5Fragment
$fragment->cloneFragment()
  ->append("main.main.content", "This document is ready for content.")
  ->append("footer", "&copy;2016 Todd Cytra")
  ->wrap("div.page")
  ->appendTo($html5->body);

// Output the document html
$html5->save()->write();
```

Will output:

```html
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
</head>
<body>
<div class="page"><div class="interface wrapper">
<header>
<h1 class="pagetitle">Class Html5Fragment</h1>
<h2 class="description">This object will facilitate management of a DOMFragment</h2>
</header>
<main class="main content">This document is ready for content.</main>
<footer>&copy;2016 Owner Name</footer>
</div></div>
</body>
</html>
```
