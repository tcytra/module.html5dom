<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 03
//  Move the head specific methods to the HTML5DocumentHead object

$html5 = new HTML5Document("html", "body");
$html5->meta( ["viewport"=>"width=device-width,initial-scale=1"] )->title("0.6 Test 02");

$html5->append("div")->attribute("id", "homepage")->attribute("class", "page interface");

$html5->save()->write();
