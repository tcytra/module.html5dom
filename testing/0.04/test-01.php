<?php ini_set("display_errors","on"); error_reporting(E_ALL); ?>
<?php require "../../load.html5dom.php"; ?>
<?php

//  Test 01
//  Create full HTML5 Document via HTML5Dom static model

HTML5Dom::CreateDocument();

HTML5Dom::Out();

?>
