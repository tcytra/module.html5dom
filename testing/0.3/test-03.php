<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 03
//  Create Document with html and body nodes via instance model

$html5 = new HTML5Document("html","body");

$html5->save()->write();

?>
