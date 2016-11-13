# Class Html5Search Extends Html5

## Description

This object provides the ability to search for dom nodes matching a provided constructor argument and manipulate the list of nodes.

**Note:** Unlike other classes that extend Html5, this class has a dynamic objnode as it is often the case it must cycle the list of available nodes when a method is invoked upon the search results.

## Properties

public int `$length = 0`
> *The number of matching nodes in the instance $list*

public array `$list = []`
> *An array containing the list of matching nodes*

public string `$objtype = "fragment"`
> *The type-name of this object; Value: `fragment`*

## Methods

public `__construct( [array $config = null] )`
> *Create an instance of the Html5Search and process the provided $config*

public object `find( string $constructor )`
> *Create an instance $list of nodes that match the provided $constructor argument*

public object `item( [int $index = 0] )`
> *Return an item from the $list of matching nodes by index*



## Example Use

The following code:

```php
<?php
// Create an instance of the Html5Document object
$html5 = new Html5Document();

//  Append some elements to the document <head>
$html5->head->title("Html5Search")->meta( ["name"=>"description", "content"=>"Example usage of the Html5Search object"] );

//  Define some html markup
$markup = <<<MarkUp
<div id="homepage" class="page wrapper">
  <header>
    <h1 class="testcase">Html5Search</h1>
    <h2 class="describe">Example usage of the Html5Search object</h2>
  </header>
  <main>
    <div id="content" class="inner wrapper">
      <p>This document is ready for content.</p>
    </div>
    <div id="sidebar" class="floatright">
      <p>This sidebar is ready for content.</p>
    </div>
  </main>
</div>
MarkUp;

//  Append the markup to the document <body>
$html5->html($markup);

//  Apply a search to the existing document node tree by node name
$html5->find("#homepage")
  ->find("div")
  ->not(".wrapper")
  ->classAdd("sidebar")
  ->append("p", "The div elements not #content has been appended to with the find method.");

$html5->save()->write();
```

Will output:

```html
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="description" content="Example usage of the Html5Search object">
<title>Html5Search</title>
</head>
<body>
<div id="homepage" class="page wrapper">
  <header>
    <h1 class="testcase">Html5Search</h1>
    <h2 class="describe">Example usage of the Html5Search object</h2>
  </header>
  <main>
    <div id="content" class="inner wrapper">
      <p>This document is ready for content.</p>
    </div>
    <div id="sidebar" class="floatright sidebar">
      <p>This sidebar is ready for content.</p>
      <p>The div elements not #content has been appended to with the find method.</p>
    </div>
  </main>
</div>
</body>
</html>
```