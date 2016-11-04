<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 02
//  Create a PHP DOMDocument DOMElement with a specified nodeName; argue "div"

$html5 = new HTML5Document("html", "body");

$html5->append("div");

$html5->save()->write();
