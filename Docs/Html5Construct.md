# Class Html5Construct

## Description

The Html5Construct object will evaluate a provided HTML element constructor in string format and retrieve the parameters as instance properties.

## Properties

public string `$class`
> *The requested class name(s) in the constructor*

public string `$id`
> *The requested element id in the constructor*

public string `$name`
> *The requested element node name in the constructor; Default value: `div`*

## Methods

public `__construct(  )`
> Create an instance of the Html5Construct object

public bool `able( )`
> Indicates whether a provided constructor is a viable HTML5 element

## Example Use

```
<?php
// Set an instance of Html5Construct with a constructor argument
$construct = Html5Construct::Set("div#interface.wrapper");

// Dump the Html5Construct
var_dump($construct);

//  Result:
object(Html5Construct)#1 (3) {
  ["id"]=>
  string(9) "interface"
  ["class"]=>
  string(7) "wrapper"
  ["name"]=>
  string(3) "div"
}
```

## Todo

- [ ] Rename the Set method to Explode
- [ ] Provide the ability to Implode a constructor
- [ ] Migrate the functionality in Set to a non-static method
- [ ] Verify a valid HTML5 element nodeName
