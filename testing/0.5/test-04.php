<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 04
//  Create a PHP DOMDocument DOMElement with attribute

$html5 = new HTML5Document("html", "body");

$html5->append("div")->attribute("class", "interface");

$html5->save()->write();
