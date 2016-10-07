<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 01
//  Create a PHP DOMDocument DOMElement with a specified nodeName

$html5 = new HTML5Document("html", "body");

$html5->append();

$html5->save()->write();
