# Class Html5DocumentHead Extends Html5

## Description

The Html5DocumentHead object provides methods for adding and manipulating the various child nodes in the DOMDocument &lt;head&gt; node.

## Properties

protected object `$objnode`
> *The local instance target PHP DOMElement*

public string `$objtype`
> *The type-name of this object; Value: `documenthead`*

## Methods

public `__construct( [array $config = null] )`
> *Create an instance of the Html5DocumentHead and process the provided $config*

public void `create( [array $config = null] )`
> *Create the document &lt;head&gt; tag and append it to the parent target*

public object `favicon( [string $href = "/favicon.png"] )`
> *Add a document &lt;link&gt; tag and attributes for the icon to the node tree*

public object `javascript( string $src[, string $code = null] )`
> *Add a document &lt;script&gt; tag and attributes to the html5 node tree*

public object `meta( array $attr )`
> *Add a document &lt;meta&gt; tag and attributes to the Html5 node tree*

public object `stylesheet( string $href )`
> *Add a document &lt;link&gt; tag and attributes to the html5 node tree*

public object `title( string $text[, int $amend = 0[, string $join = null]] )`
> *Add the document &lt;title&gt; tag to the html5 node tree, or amend an existing &lt;title&gt; content*

## Example Use

```
<?php
// Create an instance of the Html5Document object
$html5 = new Html5Document();

// Append the various <head> elements to the $html
$html5->head->meta(["viewport"=>"width=device-width,initial-scale=1"])
  ->stylesheet("/css/styles.css")
  ->javascript("/js/script.js")
  ->javascript(null, "(function(){ /* inline script */ })();")
  ->title("Class Html5DocumentHead Extends Html5")
  ->favicon();

// Output the document html
$html5->save()->write();

// Result:
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta viewport="width=device-width,initial-scale=1">
<title>Class Html5DocumentHead Extends Html5</title>
<link rel="icon" href="/favicon.png">
<link rel="stylesheet" type="text/css" href="/css/styles.css">
<script type="text/javascript" src="/js/script.js"></script><script type="text/javascript">
(function(){ /* inline javascript */ })();
</script>
</head>
<body></body>
</html>
```

## Notes

* The title method can append or prepend the provided text to existing &lt;title&gt; content
  * An `$amend` argument of `1` will cause the text to be appended to existing content
  * An `$amend` argument of `-1` will cause the text to be prepended to existing content
  * The $join argument accepts a single character with which to {ap,pre}pend

## Todo

- [ ] Provide the ability to argue for inline styles
