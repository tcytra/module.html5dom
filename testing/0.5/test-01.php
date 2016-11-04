<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 01
//  Create a PHP DOMDocument DOMElement without arguments; default to <div>

$html5 = new HTML5Document("html", "body");

$html5->append();

$html5->save()->write();
