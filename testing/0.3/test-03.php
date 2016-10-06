<?php require "../../errors.php"; ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 02
//  Create Document with html and body nodes via instance model

$html5 = new HTML5Document("html");

$html5->save()->write();

?>
