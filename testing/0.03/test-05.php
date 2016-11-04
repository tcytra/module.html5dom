<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 04
//  Create Document with html and body nodes via boolen arguments to the
//  + instance constructor. Result should be the same as test-03

$html5 = new HTML5Document("html", "body", false);

$html5->save()->write();

?>
