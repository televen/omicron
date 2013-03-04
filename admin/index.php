<?php

include $_SERVER['DOCUMENT_ROOT'] . '/omicron/lib/admin/framework.class.php';

$fw = new framework();
$fw->initShow($_GET["show_name"]);

?>