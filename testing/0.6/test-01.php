<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 01
//  Provide the means to create a document meta tag with attributes

$html5 = new HTML5Document("html", "body");

$html5->meta( ["viewport"=>"width=device-width,initial-scale=1"] );

$html5->append("div")->attribute("id", "homepage")->attribute("class", "page interface");

$html5->save()->write();
