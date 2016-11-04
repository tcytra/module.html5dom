<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 02
//  Create Document with root html node via instance model

$html5 = new HTML5Document("html");

$html5->save()->write();

?>
