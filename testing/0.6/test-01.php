<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 01
//  Create the Html5Document head and body as Html5Element objects

$html5 = new HTML5Document("html", "body");

$html5->append("section")->attribute("class", "interface");

$html5->save()->write();
