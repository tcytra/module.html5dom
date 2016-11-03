# Class Html5Element Extends Html5Element

## Description

The Html5Element object provides methods for creating and manipulating a PHP DOMElement in the context of an HTML5 document.

**Note:** Although the Html5Element object can be utilized independant of a parent object, a developer may execute the __construct and create methods through a single call to the Html5 append method, which is available to all classes that extend it.

## Properties

protected object `$objnode`
> *The local instance target PHP DOMElement*

public string `$objtype = "element"`
> *The type-name of this object; Value: `element`*

## Methods

public `__construct( [array $config = null] )`
> *Create an instance of the Html5Element and process the provided $config*

public void `create( string $construct[, string $with = null] )`
> *Create the document element with a provided constructor and append it to the parent target*

## Example Use

```
// Create an instance of the Html5Document object
$html5 = new Html5Document();

// Create an instance of the Html5Element object
$element = new Html5Element( ["parent"=>$html5, "target"=>$html5->body] );

// Create the element with a constructor and provide some inner text
$element->create("div#interface.wrapper", "This document is ready for content.");

// Output the document html
$html5->save()->write();

// Result:
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
</head>
<body><div class="wrapper" id="interface">This document is ready for content</div></body>.
</html>
```
