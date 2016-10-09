<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 03
//  Create a PHP DOMDocument DOMElement with a specified nodeName; argue "section"

$html5 = new HTML5Document("html", "body");

$html5->append("section");

$html5->save()->write();
