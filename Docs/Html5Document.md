# Class Html5Document Extends Html5

## Description

The Html5Document object will create a PHP DOMDocument (via an HTML documentType DOMImplementation) and provide methods for creating and manipulating the internal DOM node tree.

## Properties

public object `$body`
> *The HTML document <body> element DOMNode*

public object `$head`
> *The instance of the Html5DocumentHead object*

public string `$objtype`
> *The type-name of this object; Value: `document`*

public string `$output`
> *The saveHTML string returned from PHP DOMDocument*

## Methods

public `__construct( [array $config = null] )`
> *Create an instance of the Html5Document and process the provided $config*

public object `fragment( string $construct[, string $with = null] )`
> *Create and return an instance of the Html5Fragment object*

public void `save( )`
> *Perform a PHP DOMDocument saveHTML into the instance $output variable*

public void `write( )`
> *Write the Html5Document $output string content*

## Example Use

```
//  Create and output an instance of the Html5Document object
$html5 = new Html5Document();
$html5->save()->write();

//  Result:
<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"></head>
<body></body>
</html>
```

##  Notes

* The document $config will default to some sensible values
  * The character set will default to `utf-8`
  * The language will default to `en`
* The $config should be provided in the following format:
  * `['charset'=>'utf-8', 'language'=>'en']`, but
  * The $config can also be argued with just the language

##  Todo

- [ ] Provide the ability to suppress the DOCTYPE declaration
- [ ] Provide the ability to output as text/plain
